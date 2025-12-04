<?php
/* Template Name:Online Gyroscope*/
get_header();?>
<style media="screen">
@media all and (max-width: 1024px) {
    #sAs-menu-responsive span {
        background-image: url(<?php echo get_stylesheet_directory_uri();
        ?>/assets/images/toggle.png);
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
    /* 		max-width: 454px !important; */
}

.btn-style {
    position: absolute;
    top: 48%;
    left: 52%;
    transform: translate(-49%, -48%);
    /* 		width: 20%; */
}

#reset-btn {
    display: none;
}
</style>

<div class="container-fluid">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-lg-7 col-xl-7 col-12">
            <model-viewer alt="" src="<?=get_stylesheet_directory_uri();?>/assets/glbs/fainter2.glb" camera-controls
                touch-action="pan-y" camera-orbit="20deg 70deg" id="model"></model-viewer>
            <div class="btn-style row" id="btn-div">
                <img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/StartGyros.svg"
                    alt="" id="test-btn">
                <img class="img-fluid skip-lazy"
                    src="<?=get_stylesheet_directory_uri();?>/assets/images/Reset-Gyros.svg" alt="" id="reset-btn">
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
                            <div id='<?php the_sub_field('list_item'); ?>'>
                                <p><?php the_sub_field('list_value'); ?></p>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <!-- 					<div class="col-6 flex-column">
					<?php
						$measurements = get_field('measurements_info');
						
						if($measurements) {
							$last_three = array_slice($measurements, -3);
							
							foreach ($last_three as $item) {
								echo '<div id="' . htmlspecialchars($item['list_item']) . '"><p>';
								echo $item['list_item'];
								echo ': ';
								echo $item['list_value'];
								echo '</p></div>';
							}
						}
					?>
					</div> -->
                </div>
            </div>
            <br />
            <div class="note-message d-none d-lg-block d-xl-block">
                <?php the_field('note');?>
            </div>
        </div>
    </div>
    <div class="read-more-section">
        <div class="ct-row dis-flex">
            <div class="width-50 wid-xs-100">
                <div class="read-more-text-secction">
                    <div class="read-more-title clearfix">
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
                    <img class="img-fluid skip-lazy" src="<?php echo esc_url($image_url); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>" title="<?php echo esc_attr($image_title); ?>">
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
    // state
    let isTesting = false;
    let deviceOrientationHandler = null;
    let gyroSensor = null; // optional if available
    const smoothingFactor = 0.15; // 0..1 (higher = faster response, lower = smoother)
    let smoothYaw = 0, smoothPitch = 90, smoothRoll = 0;

    // DOM refs (will be assigned on DOMContentLoaded)
    let testBtn, resetBtn, model, pitchEl, rollEl, yawEl, btnDiv;

    // safe access helper for sub-elements (some HTML may not exist)
    function q(id) { return document.getElementById(id); }

    // Map deviceorientation values to yaw/pitch/roll:
    // alpha = yaw (0..360) ; beta = pitch (-180..180) ; gamma = roll (-90..90)
    function handleDeviceOrientation(e) {
        // Some browsers may produce nulls; guard them
        const rawYaw = (typeof e.alpha === 'number') ? e.alpha : 0;
        const rawPitch = (typeof e.beta === 'number') ? e.beta : 0;
        const rawRoll = (typeof e.gamma === 'number') ? e.gamma : 0;

        // simple low-pass smoothing
        smoothYaw = smoothYaw * (1 - smoothingFactor) + rawYaw * smoothingFactor;
        smoothPitch = smoothPitch * (1 - smoothingFactor) + rawPitch * smoothingFactor;
        smoothRoll = smoothRoll * (1 - smoothingFactor) + rawRoll * smoothingFactor;

        // update UI (if elements exist)
        if (pitchEl) pitchEl.innerHTML = smoothPitch.toFixed(2);
        if (rollEl) rollEl.innerHTML = smoothRoll.toFixed(2);
        if (yawEl) yawEl.innerHTML = (smoothYaw % 360).toFixed(2);

        // update model-viewer camera/orientation
        // cameraOrbit expects "azimuth elevation [radius]" — we use azimuth = 360 - yaw, elevation = 180 - pitch
        // clamp pitch to avoid singularities if needed
        const az = 360 - (smoothYaw % 360);
        const el = 180 - smoothPitch;

        // Assign attributes — model-viewer will respond; call requestUpdate() to be safe
        try {
            // Ensure values are finite
            const azStr = isFinite(az) ? `${az}deg` : '0deg';
            const elStr = isFinite(el) ? `${el}deg` : '90deg';
            model.cameraOrbit = `${azStr} ${elStr}`;
            // orientation accepts a quaternion; you're using "x y z w" earlier — here we approximate by placing roll into x-angle quaternion-like string
            // Keep existing pattern but convert roll degrees to radians for a small rotation vector
            model.orientation = `${(smoothRoll * Math.PI / 180).toFixed(5)} 0 0 0`;
            // model.orientation = `0deg 0deg ${(smoothRoll * Math.PI / 180).toFixed(5)}deg`;
            if (typeof model.requestUpdate === 'function') model.requestUpdate();
        } catch (err) {
            // Non-fatal; ignore
            console.warn('Model update error', err);
        }
    }

    // Optional: Generic Sensor API fallback (non-Safari). We'll use it only if available and only for extra responsiveness.
    function startGyroscopeSensor() {
        if ('Gyroscope' in window) {
            try {
                gyroSensor = new Gyroscope({ frequency: 60 });
                gyroSensor.addEventListener('reading', () => {
                    // Note: Gyroscope provides angular velocity, not absolute yaw/roll.
                    // We can integrate small changes to complement deviceorientation if desired.
                    // For simplicity we won't integrate here (keeps behavior consistent).
                });
                gyroSensor.start();
            } catch (err) {
                console.warn('Gyroscope start failed', err);
                gyroSensor = null;
            }
        }
    }

    function stopGyroscopeSensor() {
        if (gyroSensor) {
            try {
                gyroSensor.removeEventListener('reading', () => {});
                gyroSensor.stop();
            } catch (e) { /* ignore */ }
            gyroSensor = null;
        }
    }

    // request iOS motion permission (must be called in user gesture)
    async function requestIOSMotionPermission() {
        if (typeof DeviceMotionEvent !== 'undefined' && typeof DeviceMotionEvent.requestPermission === 'function') {
            // iOS 13+ requires this call
            try {
                const perm = await DeviceMotionEvent.requestPermission();
                return perm === 'granted';
            } catch (err) {
                console.error('DeviceMotion permission error', err);
                return false;
            }
        }
        // non-iOS or already permitted
        return true;
    }

    // Start listening to sensors (assumes permission already granted if required)
    function startSensors() {
        // add deviceorientation (works in Safari iOS and Android Chrome)
        deviceOrientationHandler = handleDeviceOrientation;
        window.addEventListener('deviceorientation', deviceOrientationHandler, true);

        // optionally start Gyroscope sensor on supporting browsers (not iOS)
        startGyroscopeSensor();
    }

    function stopSensors() {
        if (deviceOrientationHandler) {
            window.removeEventListener('deviceorientation', deviceOrientationHandler, true);
            deviceOrientationHandler = null;
        }
        stopGyroscopeSensor();
    }

    // UI toggles when start/stop clicked
    async function onTestBtnClick() {
        isTesting = !isTesting;

        if (isTesting) {
            // Request permission for iOS (must be done inside user gesture)
            const ok = await requestIOSMotionPermission();
            if (!ok) {
                alert('Motion permission was not granted. Please enable Motion & Orientation access in Safari settings.');
                // revert toggle
                isTesting = false;
                return;
            }

            // Start sensors and switch model
            startSensors();

            // swap model source and visuals
            model.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/phone2.glb";
            model.cameraControls = false;

            // change start button to pause image if available
            if (testBtn) testBtn.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Pause-Gyros.svg";
            if (resetBtn) resetBtn.style.display = "flex";

            // reposition btnDiv
            if (btnDiv) {
                btnDiv.style.top = "90%";
                btnDiv.style.left = "80%";
                btnDiv.style.transform = ""; // clear transform to allow absolute placement
            }
        } else {
            // stop sensors and revert
            stopSensors();

            model.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/fainter2.glb";
            model.cameraControls = true;

            if (testBtn) testBtn.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/StartGyros.svg";
            if (resetBtn) resetBtn.style.display = "none";

            if (btnDiv) {
                btnDiv.style.top = "48%";
                btnDiv.style.left = "52%";
                btnDiv.style.transform = "translate(-49%, -48%)";
            }

            // reset displayed values
            if (pitchEl) pitchEl.innerHTML = "-";
            if (rollEl) rollEl.innerHTML = "-";
            if (yawEl) yawEl.innerHTML = "-";

            // reset smoothing baselines to comfortable defaults
            smoothPitch = 90;
            smoothYaw = 0;
            smoothRoll = 0;

            // ensure model reflects baseline
            try {
                model.cameraOrbit = `360deg ${180 - smoothPitch}deg`;
                model.orientation = `0 0 0 0`;
                if (typeof model.requestUpdate === 'function') model.requestUpdate();
            } catch (err) { /* ignore */ }
        }
    }

    function onResetClick() {
        smoothYaw = 0;
        smoothPitch = 90;
        smoothRoll = 0;
        // Immediately apply baseline
        try {
            model.cameraOrbit = `360deg ${180 - smoothPitch}deg`;
            model.orientation = `0 0 0 0`;
            if (typeof model.requestUpdate === 'function') model.requestUpdate();
        } catch (e) {}
    }

    // DOM ready
    window.addEventListener('DOMContentLoaded', function() {
        // assign DOM references (like your original code)
        testBtn = q('test-btn');
        resetBtn = q('reset-btn');
        model = q('model');

        // the measurement fields exist by ID in your template (Pitch, Roll, Yaw)
        // guard if not present
        const pitchWrap = q('Pitch');
        const rollWrap = q('Roll');
        const yawWrap = q('Yaw');

        pitchEl = pitchWrap ? pitchWrap.querySelector('p') : null;
        rollEl  = rollWrap  ? rollWrap.querySelector('p') : null;
        yawEl   = yawWrap   ? yawWrap.querySelector('p') : null;

        btnDiv = q('btn-div');

        // init display
        if (pitchEl) pitchEl.innerHTML = "-";
        if (rollEl) rollEl.innerHTML = "-";
        if (yawEl) yawEl.innerHTML = "-";

        // wire buttons
        if (testBtn) {
            // If the image is inside an <img> and user taps it, we want the click on the element, not its parent.
            testBtn.addEventListener('click', onTestBtnClick);
        }
        if (resetBtn) {
            resetBtn.addEventListener('click', onResetClick);
        }

        // set sensible initial model state
        smoothPitch = 90;
        smoothYaw = 0;
        smoothRoll = 0;
    });
})();
</script>

<?php get_footer();