<?php
/* Template Name: Online Gyroscope (Fixed) */
get_header();?>
<style media="screen">
	@media all and (max-width: 1024px) {
		#sAs-menu-responsive span {
			background-image: url(<?php echo get_stylesheet_directory_uri();?>/assets/images/toggle.png);
			background-repeat: no-repeat;
			background-size: contain;
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
	}

	model-viewer {
		width: auto;
		height: 45vh;
		margin-top: -2vh;
	}

	.measurements {
		font-family: Raleway;
		font-weight: bold;
		font-size: 16px;
		color: #3A617C;
	}

	.measurements-info {
		max-width: 250px !important;
		color: #436f8e;
		border: 2px solid #436f8e;
		border-radius: 10px;
		padding: 15px 10px 15px 10px !important;
		position: relative;
		margin: 0 auto;
		text-align: center;
	}

	.note-message {
        display: none;
        padding: 10px;
        background-color: #E35D26;
        color: #EEEEEE;
        border: 1px solid #E35D26;
        border-radius: 2px;
		font-family: Raleway;
		font-weight: bold;
		font-size: 18px;
	}

	.btn-style {
    	position: absolute;
		top: 48%;
        left: 52%;
        transform: translate(-49%, -48%);
	}

	#reset-btn {
		display: none;
	}
</style>

<div class="container-fluid">
	<div class="row d-flex justify-content-between align-items-center">
		<div class="col-lg-7 col-xl-7 col-12">
			<model-viewer alt="" src="<?=get_stylesheet_directory_uri();?>/assets/glbs/fainter2.glb" camera-controls touch-action="pan-y" camera-orbit="20deg 70deg" id="model"></model-viewer>
			<div class="btn-style row" id="btn-div">
				<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/StartGyros.svg" alt="" id="test-btn">
 				<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/Reset-Gyros.svg" alt="" id="reset-btn">
			</div>
		</div>
		<div class="col-lg-5 col-xl-5 col-12">
			<div class="measurements-info">
				<div>
					<p class="measurements"><strong><?php the_field("measurements");?></strong></p>
				</div>
				<div class="row d-flex justify-content-between">
					<div class="col-12">
					<?php if(have_rows('measurements_info')): ?>
						<?php
						$count = 0;
						while(have_rows('measurements_info')): the_row();
							if($count > 2) {
								break;
							}
							$count++;
							?> 
							<div class="row d-flew align-items-center justify-content-between px-3">
								<p><?php the_sub_field('list_item'); ?>:</p>
								<div id='<?php the_sub_field('list_item'); ?>'><p><?php the_sub_field('list_value'); ?></p></div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
					</div>
				</div>
			</div>
			<br/>
			<div class="note-message d-none d-lg-block d-xl-block">
				<?php the_field('note');?>
			</div>
		</div>
	</div>
	<div class="read-more-section">
		<div class="ct-row dis-flex">
			<div class="width-50 wid-xs-100">
				<div class="read-more-text-secction">
					<div class="read-more-title clearfix" >
						<h2><strong><?php the_field('more_about_title');?></strong></h2>
					</div>
					<?php
					if( have_rows('test_content') ):
						$row_number = 0;
						while ( have_rows('test_content') ) : the_row();
							$row_number++;
				?>
						<div class="read-more-1">
							<div class="read-more-subtitle clearfix">
								<h3 class="mar-bot-20"><?php the_sub_field('heading');?></h3>
							</div>

							<div class="read-more-text">
								<p><?php the_sub_field('descp');?>
								</p>
							</div>
						</div>
						<?php if($row_number==2): ?>
							<?php
								$image = get_field('gyroscope_image'); // Retrieve the field

								if ($image) {
									// Check if the field returned an array (image object) or an image ID
									if (is_array($image)) {
										// If it's an array, fetch URL, alt, and title directly
										$image_url = $image['url'];
										$image_alt = $image['alt'];
										$image_title = $image['title'];
									} elseif (is_numeric($image)) {
										// If it's an image ID, use WordPress functions to get URL, alt, and title
										$image_url = wp_get_attachment_url($image);
										$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
										$image_title = get_the_title($image);
									} else {
										// If it's a plain string (e.g., a URL), just use it
										$image_url = $image;
										$image_alt = '';
										$image_title = '';
									}
							?>
								<img class="img-fluid skip-lazy" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" title="<?php echo esc_attr($image_title); ?>">
							<?php
							} else {
								// Optional: Handle cases where no image is returned
								echo '<p>No image found.</p>';
							}
							?>
						<?php endif; ?>
					<?php endwhile;
					else :
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</article>
</div>
</div>

<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>

<script>
(function() {
	// Robust, cross-browser handling for device orientation/gyroscope
	// Major fixes:
	//  - request permission on iOS
	//  - prefer DeviceOrientationEvent (absolute) for fused orientation
	//  - consistent low-pass smoothing for yaw/pitch/roll
	//  - baseline offsets and proper reset handling
	//  - wait for model load before enabling sensors

	let isTesting = false;
	let usingDeviceOrientation = false;
	let usingGyroscopeFallback = false;
	let orientationHandler = null;
	let gyro = null;
	let lastGyroTimestamp = null;

	// Smoothed angles (degrees)
	let smoothYaw = 0, smoothPitch = 0, smoothRoll = 0;
	let baselineYaw = 0, baselinePitch = 0, baselineRoll = 0;
	const SMOOTH_ALPHA = 0.15; // smoothing factor (0..1) - higher is more responsive

	window.addEventListener('DOMContentLoaded', () => {
		a.testBtn = document.getElementById('test-btn');
		a.resetBtn = document.getElementById('reset-btn');
		a.model = document.getElementById('model');

		// The measurement fields may or may not exist depending on ACF content
		a.pitch = document.getElementById('Pitch') ? document.getElementById('Pitch').querySelector('p') : null;
		a.roll = document.getElementById('Roll') ? document.getElementById('Roll').querySelector('p') : null;
		a.yaw = document.getElementById('Yaw') ? document.getElementById('Yaw').querySelector('p') : null;

		// Ensure camera controls are enabled initially
		a.model.cameraControls = true;

		// Ensure model has sensible initial cameraOrbit
		a.model.cameraOrbit = a.model.cameraOrbit || '360deg 90deg';

		// Wait for model to load before allowing sensor mode to start
		a.model.addEventListener('load', () => {
			// If user is already in testing mode (rare), reapply settings
			if(isTesting) {
				a.model.cameraControls = false;
			}
		});

		// Reset sets current device orientation as baseline, and resets smoothing
		a.resetBtn.addEventListener('click', () => {
			baselineYaw = smoothYaw;
			baselinePitch = smoothPitch;
			baselineRoll = smoothRoll;
			// when user hits reset we keep the displayed angles at zero relative to baseline
			smoothYaw = 0;
			smoothPitch = 0;
			smoothRoll = 0;
			updateUI();
		});

		a.testBtn.addEventListener('click', async () => {
			isTesting = !isTesting;
			const model = a.model;
			const testBtn = a.testBtn;
			const btnDiv = document.getElementById('btn-div');

			if(isTesting) {
				// user gesture: request permissions where necessary
				const granted = await requestSensorPermissions();
				if(!granted) {
					alert('Sensor permissions not granted or sensors unavailable on this device.');
					isTesting = false;
					return;
				}

				// switch model to phone (we'll wait for load before applying settings)
				model.src = "<?=get_stylesheet_directory_uri();?>/assets/glbs/phone2.glb";
				// disable built-in camera controls so we can control cameraOrbit programmatically
				model.cameraControls = false;

				testBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/Pause-Gyros.svg";
				a.resetBtn.style.display = 'flex';

				btnDiv.style.top = '90%';
				btnDiv.style.left = '80%';

				// Attach the best available orientation source
				attachOrientationSource();

			} else {
				// stopping
				model.src = "<?=get_stylesheet_directory_uri();?>/assets/glbs/fainter2.glb";
				model.cameraControls = true;

				testBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/StartGyros.svg";
				a.resetBtn.style.display = 'none';

				btnDiv.style.top = '48%';
				btnDiv.style.left = '52%';
				btnDiv.style.transform = 'translate(-49%, -48%)';

				detachOrientationSource();

				// restore UI placeholders
				if(a.pitch) a.pitch.innerHTML = '-';
				if(a.roll) a.roll.innerHTML = '-';
				if(a.yaw) a.yaw.innerHTML = '-';

				// reset internal smoothing to sensible defaults
				smoothPitch = 90;
				smoothYaw = 0;
				smoothRoll = 0;
			}
		});

	}); // DOMContentLoaded

	async function requestSensorPermissions() {
		// iOS requires explicit permission calls for DeviceOrientation
		let ok = true;

		try {
			// If running on iOS 13+ Safari
			if (typeof DeviceOrientationEvent !== 'undefined' && typeof DeviceOrientationEvent.requestPermission === 'function') {
				const response = await DeviceOrientationEvent.requestPermission();
				if (response !== 'granted') ok = false;
			}

			// Some platforms may require MotionEvent permission (DeviceMotionEvent)
			if (typeof DeviceMotionEvent !== 'undefined' && typeof DeviceMotionEvent.requestPermission === 'function') {
				const r = await DeviceMotionEvent.requestPermission().catch(() => 'denied');
				if (r !== 'granted') ok = false;
			}

			// Try Permissions API for gyroscope (Chrome/Android)
			if (navigator.permissions && navigator.permissions.query) {
				try {
					const perm = await navigator.permissions.query({ name: 'gyroscope' });
					if (perm.state === 'denied') ok = false;
				} catch (e) {
					// not supported / ignore
				}
			}
		} catch (e) {
			console.warn('Permission request failed or was blocked', e);
			ok = ok && false;
		}

		return ok;
	}

	function attachOrientationSource(){
		// Prefer DeviceOrientationEvent (fused sensor) if available
		if (typeof DeviceOrientationEvent !== 'undefined' && 'ondeviceorientation' in window) {
			usingDeviceOrientation = true;
			orientationHandler = function(e){
				// alpha: z (yaw), beta: x (pitch), gamma: y (roll)
				const alpha = (e.alpha !== null && e.alpha !== undefined) ? e.alpha : 0; // 0..360
				const beta = (e.beta !== null && e.beta !== undefined) ? e.beta : 0;   // -180..180
				const gamma = (e.gamma !== null && e.gamma !== undefined) ? e.gamma : 0; // -90..90

				// Normalize ranges if needed
				// We want: yaw (0..360), pitch (0..180), roll (-180..180)
				let yaw = alpha; // compass heading
				let pitch = beta + 90; // convert -90..90 to 0..180 (align with camera polar)
				let roll = gamma; // keep as-is

				// On first run set baseline offsets so reset works
				if (baselineYaw === null) baselineYaw = yaw;

				// Compute relative angles (subtract baseline if set)
				yaw = normalizeAngle(yaw - baselineYaw);
				pitch = pitch - baselinePitch;
				roll = roll - baselineRoll;

				// Apply smoothing - keep consistent across axes
				smoothYaw = smoothValue(smoothYaw, yaw);
				smoothPitch = smoothValue(smoothPitch, pitch);
				smoothRoll = smoothValue(smoothRoll, roll);

				applyOrientationToModel(smoothYaw, smoothPitch, smoothRoll);
				updateUI();
			};
			window.addEventListener('deviceorientation', orientationHandler, true);
			return;
		}

		// Fallback: try GenericSensor Gyroscope integration (integrate angular velocity)
		if ('Gyroscope' in window) {
			try {
				usingGyroscopeFallback = true;
				gyro = new Gyroscope({frequency: 60});
				gyro.addEventListener('reading', () => {
					const now = performance.now();
					if (lastGyroTimestamp == null) lastGyroTimestamp = now;
					const dt = (now - lastGyroTimestamp) / 1000; // seconds
					lastGyroTimestamp = now;

					// gyroscope axes: x,y,z are angular velocities in rad/s
					// we'll convert to deg/s and integrate - but keep a small decay to avoid drift
					const vx = gyro.x || 0;
					const vy = gyro.y || 0;
					const vz = gyro.z || 0;

					// integrate (rad -> deg)
					smoothPitch += (vx * 180/Math.PI) * dt;
					smoothYaw += (vy * 180/Math.PI) * dt;
					smoothRoll += (vz * 180/Math.PI) * dt;

					// small damping to counteract drift
					smoothPitch *= 0.999;
					smoothYaw *= 0.999;
					smoothRoll *= 0.999;

					applyOrientationToModel(smoothYaw, smoothPitch, smoothRoll);
					updateUI();
				});
				gyro.start();
				return;
			} catch (e) {
				console.warn('Gyroscope fallback failed', e);
			}
		}

		// If nothing is available, notify user and revert testing mode
		alert('No orientation sensors available on this device.');
		isTesting = false;
		// ensure UI restored by caller
	}

	function detachOrientationSource(){
		if (usingDeviceOrientation && orientationHandler) {
			window.removeEventListener('deviceorientation', orientationHandler, true);
			orientationHandler = null;
			usingDeviceOrientation = false;
		}
		if (usingGyroscopeFallback && gyro) {
			try { gyro.stop(); } catch(e){}
			gyro = null;
			usingGyroscopeFallback = false;
			lastGyroTimestamp = null;
		}
	}

	function smoothValue(current, target) {
		return current * (1 - SMOOTH_ALPHA) + target * SMOOTH_ALPHA;
	}

	function normalizeAngle(a) {
		// normalize to -180..180
		a = ((a + 180) % 360 + 360) % 360 - 180;
		return a;
	}

	function applyOrientationToModel(yaw, pitch, roll) {
		// cameraOrbit expects: "azimuth deg polar deg"
		// azimuth maps to yaw, polar maps to (180 - pitch) to center correctly
		try {
			// clamp polar to avoid model-viewer polar singularities (0.1..179.9)
			let polar = 180 - pitch;
			if (polar <= 0.1) polar = 0.1;
			if (polar >= 179.9) polar = 179.9;

			let azimuth = (360 - yaw) % 360;
			a.model.cameraOrbit = `${azimuth}deg ${polar}deg`;

			// For roll, model-viewer doesn't provide a simple roll attribute; rotate the element slightly
			// We rotate the element's inner canvas via CSS transform. This rotates the whole viewer (visual roll).
			// Keep rotation small to avoid moving UI overlays.
			a.model.style.transform = `translate(-0px, 0px) rotate(${roll}deg)`;
			// request update so model-viewer re-renders with new cameraOrbit
			a.model.requestUpdate();
		} catch (e) {
			console.warn('applyOrientationToModel failed', e);
		}
	}

	function updateUI() {
		if(a.pitch) a.pitch.innerHTML = (smoothPitch).toFixed(2);
		if(a.roll) a.roll.innerHTML = (smoothRoll).toFixed(2);
		if(a.yaw) a.yaw.innerHTML = (smoothYaw % 360).toFixed(2);
	}

})();
</script>
<?php get_footer();
