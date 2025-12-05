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
    let isTesting = false;
    let pitchHandler, yawRollHandler;
    let gyroscope;

    //let phoneObject;

    var a = function() {};
    a__name__ = !0;

    a.main = function() {

        let yaw = 0;
        let lastTime = null;
        let smooth = 0.1;

        let angle = {
            pitch: 0,
            roll: 0,
            yaw: 0
        };

        // Start permissions on iPhone
        async function startSensors() {
            if (typeof DeviceMotionEvent.requestPermission === "function") {
                const res = await DeviceMotionEvent.requestPermission();
                if (res !== "granted") return;
            }
            startDeviceMotion();

            // Try Gyroscope() — will fail on iPhone
            tryStartGyroscope();
        }

        function tryStartGyroscope() {
            try {
                gyroscope = new Gyroscope({
                    frequency: 60
                });
                gyroscope.addEventListener("reading", handleGyroscope);
                gyroscope.start();
                console.log("Gyroscope API enabled");
            } catch {
                console.log("Gyroscope API not supported — using DeviceMotion rotationRate");
            }
        }

        function handleDeviceMotion(event) {
            const gX = event.accelerationIncludingGravity.x;
            const gY = event.accelerationIncludingGravity.y;
            const gZ = event.accelerationIncludingGravity.z;

            let pitch = Math.atan2(gY, gZ) * 57.2958;
            let roll = Math.atan2(-gX, Math.sqrt(gY * gY + gZ * gZ)) * 57.2958;

            // Smooth
            angle.pitch = angle.pitch * (1 - smooth) + pitch * smooth;
            angle.roll = angle.roll * (1 - smooth) + roll * smooth;

            // iPhone fallback: rotationRate (deg/sec)
            if (!window.Gyroscope) handleRotationRate(event.rotationRate);

            updateModel();
        }

        function stopSensors() {
            window.removeEventListener("devicemotion", handleDeviceMotion);
            try {
                gyroscope.removeEventListener("reading", handleGyroscope);
            } catch {
                console.log("Gyroscope API not supported — using DeviceMotion rotationRate");
            }
        }

        /* ----------------------------------------
           1) Fallback pitching & rolling via gravity
        ----------------------------------------- */
        function startDeviceMotion() {
            window.addEventListener("devicemotion", handleDeviceMotion);
        }

        /* ----------------------------------------
           2) Gyroscope API (Android)
        ----------------------------------------- */
        function handleGyroscope(event) {
            const now = performance.now();

            if (lastTime) {
                const dt = (now - lastTime) / 1000;
                yaw += gyroscope.z * dt * 57.2958;
            }
            lastTime = now;

            angle.yaw = angle.yaw * (1 - smooth) + yaw * smooth;
        }

        /* ----------------------------------------
           3) iPhone fallback: rotationRate
        ----------------------------------------- */
        function handleRotationRate(rr) {
            if (!rr) return;

            const now = performance.now();
            if (lastTime) {
                const dt = (now - lastTime) / 1000;
                yaw += (rr.alpha ?? 0) * dt; // already in deg/sec
            }
            lastTime = now;

            angle.yaw = angle.yaw * (1 - smooth) + yaw * smooth;
        }

        /* ----------------------------------------
           4) Apply to model-viewer
        ----------------------------------------- */
        function updateModel() {
            a.pitch.innerHTML = angle.pitch.toFixed(2);

            a.roll.innerHTML = angle.roll.toFixed(2);

            a.yaw.innerHTML = angle.yaw.toFixed(2);

            model.orientation =
                `${angle.pitch.toFixed(1)}deg ${angle.yaw.toFixed(1)}deg ${angle.roll.toFixed(1)}deg`;

            model.cameraOrbit =
                `${angle.yaw.toFixed(1)}deg ${(90 - angle.pitch).toFixed(1)}deg auto`;
        }


        window.addEventListener("DOMContentLoaded", function() {
            a.testBtn = window.document.getElementById("test-btn");
            a.resetBtn = window.document.getElementById("reset-btn");
            a.model = window.document.getElementById("model");
            a.pitch = window.document.getElementById("Pitch").querySelector('p');
            a.roll = window.document.getElementById("Roll").querySelector('p');
            a.yaw = window.document.getElementById("Yaw").querySelector('p');

            a.resetBtn.addEventListener("click", function() {
                angle = {
                    pitch: 90,
                    roll: 0,
                    yaw: 0
                };
            });

            a.testBtn.addEventListener("click", async function() {
                isTesting = !isTesting;
                let model = a.model;
                let testBtn = a.testBtn;
                let btnDiv = window.document.getElementById("btn-div");

                if (isTesting) {
                    model.src =
                        "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/phone2.glb";
                    model.cameraControls = false;

                    testBtn.src =
                        "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Pause-Gyros.svg";
                    a.resetBtn.style.display = "flex";

                    btnDiv.style.top = "90%";
                    btnDiv.style.left = "80%";

                    startSensors();
                } else {
                    // 						moveLayer();
                    model.src =
                        "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/fainter2.glb";
                    model.cameraControls = true;

                    testBtn.src =
                        "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/StartGyros.svg";
                    a.resetBtn.style.display = "none";

                    btnDiv.style.top = "48%";
                    btnDiv.style.left = "52%";
                    btnDiv.style.transform = "translate(-49%, -48%)";

                    stopSensors();

                    a.pitch.innerHTML = "-";
                    a.roll.innerHTML = "-";
                    a.yaw.innerHTML = "-";
                }
            });
        });
    }

    a.main();
})();
</script>
<?php get_footer();