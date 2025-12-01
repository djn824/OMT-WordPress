<?php
/* Template Name:Online Gyroscope*/
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
		let isTesting = false;
		let pitchHandler, yawRollHandler;
		let smoothYaw = 0, smoothPitch = 90, smoothRoll = 0;
		let gyroscope = new Gyroscope({ frequency: 60 });
		let phoneObject;
		
		var a = function(){};
		a__name__=!0;
		a.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				a.testBtn = window.document.getElementById("test-btn");
				a.resetBtn = window.document.getElementById("reset-btn");
				a.model = window.document.getElementById("model");
				a.pitch = window.document.getElementById("Pitch").querySelector('p');
				a.roll = window.document.getElementById("Roll").querySelector('p');
				a.yaw = window.document.getElementById("Yaw").querySelector('p');
// 				a.axisX = window.document.getElementById("X axis").querySelector('p');
// 				a.axisY = window.document.getElementById("Y axis").querySelector('p');
// 				a.axisZ = window.document.getElementById("Z axis").querySelector('p');
				
//       			a.model.addEventListener('load', () => {
// 		  			console.log(a.model);
					
// 					const threeScene = a.model[Object.getOwnPropertySymbols(a.model).find(sym => sym.description === 'scene')];
// 					console.log(threeScene);

// 					if (!threeScene) {
//     					console.error('Cannot find internal Three.js scene.');
// 					    return;
//   					}
					
// 					phoneObject = threeScene.getObjectByName('Phone');
// 					console.log(phoneObject);

// //   					if (phoneObject) {
// //     					phoneObject.position.set(1, 2, 3); // example position
// // 						// phoneObject.rotation.set(0, Math.PI / 2, 0); // example rotation
// //   					} else {
// //     					console.error('Unable to find object named "Phone" in threeScene.');
// //   					}
//       			});
				
				a.resetBtn.addEventListener("click", function() {
					smoothYaw = 0;
					smoothPitch = 90;
					smoothRoll = 0;
				});
				
				a.testBtn.addEventListener("click", function() {
					isTesting = !isTesting;
					let model = a.model;
					let testBtn = a.testBtn;
					let btnDiv = window.document.getElementById("btn-div");
					
// 					let lastX = 0, lastY = 0, lastZ = 0;
// 					let distanceX = 0, distanceY = 0, distanceZ = 0;
// 					let velocityX = 0, velocityY = 0, velocityZ = 0;
// 					let positionX = 0, positionY = 0, positionZ = 0;
// 					let filterAccX = 0, filterAccY = 0, filterAccZ = 0;
// 					let alpha = 0.8;
// 					let accThreashold = 0.2;
// 					const velThreshold = 0.07;
					
// 					let lastMoveTime = 0;
// 					let firstReading = true;
					
					function detectPitch(event) {
						const pitch = event.beta.toFixed(2);
// 						const roll = event.gamma.toFixed(2);
// 						const yaw = event.alpha.toFixed(2);
						a.pitch.innerHTML = pitch;
											
// 						smoothYaw = smoothYaw * 0.8 + (event.alpha+(event.beta>= 90 && event.beta<91 ? 135 : 90) ?? 0) * 0.2;
      					smoothPitch = smoothPitch * 0.8 + ((event.beta ?? 0)) * 0.2;
//         				const phi = Math.min(Math.max(smoothPitch, 0.1), 179.9);
// 						let yaw = Math.min(Math.max(smoothYaw, 0.1), 359.9);
// 						if(smooth)
// 						const ya = smoothYaw > 359.9 ? smoothYaw - 360 : smoothYaw;
// 						a.axisY.innerHTML = (smoothYaw%360).toFixed(2);
        				a.model.cameraOrbit = `${360-smoothYaw % 360}deg ${180-smoothPitch}deg`;
//         				a.model.cameraOrbit = `360deg ${180-smoothPitch}deg`;
					}
					
					function detectYawRoll(event) {
						smoothYaw += Number(gyroscope.y.toFixed(2));
						smoothRoll += Number(gyroscope.z);
						a.yaw.innerHTML = Number(-smoothYaw % 360).toFixed(2);
						a.roll.innerHTML = Number(smoothRoll).toFixed(2);
						
						a.model.cameraOrbit = `${360-smoothYaw % 360}deg ${180-smoothPitch}deg`;
						a.model.orientation = `${3.14*smoothRoll/180} 0 0 0`;
					}
					
// 					function detectMove(event) {
// // 						a.model.cameraOrbit = `360deg ${180-smoothPitch}deg`;
// 						const now = Date.now();
//   						const acceleration = event.acceleration;
  
//   						if (firstReading) {
//     						lastX = acceleration.x;
//     						lastY = acceleration.y;
//     						lastZ = acceleration.z;
// 							lastMoveTime = now;
//     						firstReading = false;
//     						return;
//   						}
  													
// 						const deltaTime = (now - lastMoveTime) / 1000;
						
// 						filterAccX = alpha * filterAccX + (1 - alpha) * acceleration.x;
// 						filterAccY = alpha * filterAccY + (1 - alpha) * acceleration.y;
// 						filterAccZ = alpha * filterAccZ + (1 - alpha) * acceleration.z;
    
// //     						const accelX = Number(acceleration.x - lastX)*10;
// //     						const accelY = Number(acceleration.y - lastY);
// //     						const accelZ = Number(acceleration.z - lastZ); // Subtract gravity on Z-axis
// // 							const t = acceleration.x - lastX;
// // 														a.pitch.innerHTML = parseInt((acceleration.x-lastX)*1000)/1000;
// // 							a.pitch.innerHTML = acceleration.x.toFixed(1) +' : ' + acceleration.y.toFixed(1);
    					
// // 							if((lastX < 0 && acceleration.x < 0) || (lastX > 0 && acceleration.x > 0)) {
// // 								velocityX += acceleration.x * deltaTime;
// // 								a.pitch.innerHTML = acceleration.x.toFixed(2);
// // 							}
// // 							velocityX += acceleration.x * deltaTime;
// // 							velocityX = Math.abs(velocityX) < 0.1 ? 0 : velocityX;
// 						velocityX += filterAccX * deltaTime;
// 						if(velocityX > 0.3)		velocityX = 0.3;
// 						if(velocityX < -0.3)	velocityX = -0.3;
						
// 						if(Math.abs(filterAccX) < accThreashold && Math.abs(velocityX) < velThreshold){
// // 							a.pitch.innerHTML = "abcde";
// 							velocityX = 0;
// 						}
						
// 						velocityY += filterAccY * deltaTime;
// 						if(velocityY > 0.3)		velocityY = 0.3;
// 						if(velocityY < -0.3)	velocityY = -0.3;
						
// 						if(Math.abs(filterAccY) < accThreashold && Math.abs(velocityY) < velThreshold)	velocityY = 0;
						
// 						velocityZ += filterAccZ * deltaTime;
// 						if(velocityZ > 0.3)		velocityZ = 0.3;
// 						if(velocityZ < -0.3)	velocityZ = -0.3;
						
// 						if(Math.abs(filterAccZ) < accThreashold && Math.abs(velocityZ) < velThreshold)	velocityZ = 0;
							
    						
// // 							velocityY += acceleration.y * deltaTime;
// // 							if(velocityY > 0.3) 	velocityY = 0.3;
// // 							if(velocityY < -0.3) 	velocityY = -0.3;
    						
// // 							velocityZ += acceleration.z * deltaTime;
// // 							if(velocityZ > 0.3)		velocityZ = 0.3;
// // 							if(velocityZ < -0.3)	velocityZ = -0.3;
						
// // 							velocityX += parseInt((acceleration.x-lastX)*1000)/1000 * deltaTime;
// //     						velocityY += parseInt((acceleration.y-lastY)*1000)/1000 * deltaTime;
// //     						velocityZ += parseInt((acceleration.z-lastZ)*1000)/1000 * deltaTime;
							    
//     						if(acceleration.x != lastX){
// 								positionX += velocityX * deltaTime;
// 								if(positionX > 0.1)
// 									positionX = 0.1;
// 								if(positionX < -0.2)
// 									positionX = -0.2;
// 							}
// 							if(acceleration.y != lastY) {
// 	    						positionY += velocityY * deltaTime;
// 								if(positionY > 0.1)
// 									positionY = 0.1;
// 								if(positionY < -0.2)
// 									positionY = -0.2;
// 							}
// 							if(acceleration.z != lastZ) {
// 	    						positionZ += velocityZ * deltaTime;
// 								if(positionZ > 0.1)
// 									positionZ = 0.1;
// 								if(positionZ < -0.1)
// 									positionZ = -0.1;
// 							}
    
// 						    lastX = acceleration.x;
//     						lastY = acceleration.y;
//     						lastZ = acceleration.z;
													
//     						lastMoveTime = now;
						
// 							a.axisX.innerHTML = 'X axis: ' + positionX.toFixed(2);
// 							a.axisY.innerHTML = 'Y axis: ' + positionY.toFixed(2);
// 							a.axisZ.innerHTML = 'Z axis: ' + positionZ.toFixed(2);
						
// 							phoneObject.position.set(4+positionX*100, 7.8+positionY*100, positionZ*100);
// 						a.model.cameraOrbit = '360deg 90deg';
// 						a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						
// 						a.model.requestUpdate();
// // 						phoneObject.position.set(8, 12, 5);
// 					}
					
					if(isTesting) {
						model.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/phone2.glb";
						model.cameraControls = false;
						
						testBtn.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Pause-Gyros.svg";
						a.resetBtn.style.display = "flex";

						btnDiv.style.top = "90%";
						btnDiv.style.left = "80%";
						
// 						a.model.orientation = '45 0 0 0';

						yawRollHandler = (event) => detectYawRoll(event);
						gyroscope.addEventListener('reading', yawRollHandler);
						
						gyroscope.start();
// 								a.model.cameraOrbit = '360deg 90deg';
						pitchHandler = (event) => detectPitch(event);
						window.addEventListener('deviceorientation', pitchHandler);
// 						a.model.cameraOrbit = `360deg 90deg`;
// 						moveHandler = (event) => detectMove(event);
// 						window.addEventListener('devicemotion', moveHandler);
					} else {
// 						moveLayer();
						model.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/fainter2.glb";
						model.cameraControls = true;
						
						testBtn.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/StartGyros.svg";
						a.resetBtn.style.display = "none";

						btnDiv.style.top = "48%";
						btnDiv.style.left = "52%";
						btnDiv.style.transform = "translate(-49%, -48%)";
						
						gyroscope.removeEventListener('reading', yawRollHandler);
						gyroscope.stop();
						window.removeEventListener('deviceorientation', pitchHandler);
// 						window.removeEventListener('devicemotion', moveHandler);
// 						phoneObject.position.set(4, 7.8, 0);
						a.pitch.innerHTML = "-";
						a.roll.innerHTML = "-";
						a.yaw.innerHTML = "-";
// 						a.axisX.innerHTML = "X axis: -";
// 						a.axisY.innerHTML = "Y axis: -";
// 						a.axisZ.innerHTML = "Z axis: -";
						smoothPitch = 90;
						smoothYaw = 0;
						smoothRoll = 0;
					}
				});
			});
		}
		
		a.main();
	})();
</script>
<?php get_footer();