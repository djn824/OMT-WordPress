<?php
/* Template Name:Online Accelerometer*/
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

					if( have_rows('text_content') ):

					while ( have_rows('text_content') ) : the_row();?>
					<div class="read-more-1">


						<div class="read-more-subtitle clearfix">
							<h3 class="mar-bot-20"><?php the_sub_field('heading');?></h3>
						</div>

						<div class="read-more-text">
							<p><?php the_sub_field('descp');?>
							</p>
						</div>
					</div>
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
	const markArr = [
		{x: -1, y: -1, z: 1},
		{x: -1, y: -1, z: 1},
	]
	const alphaArr = [		
		{ x: 0.5, y: 0.5, z: 0.5 },
		{ x: 0.6, y: 0.6, z: 0.6 },
	];
	const accThreasholdArr = [
		{ x: 0.3, y: 0.7, z: 0.4 },
		{ x: 0.3, y: 0.5, z: 0.3 },
	];
	const incAccArr = [
		{ x: 1.1, y: 1.1, z: 1.1 }, //1.1, 1.1,1.1
		{ x: 1.3, y: 1.3, z: 1.3 }, // 1.05,1.05,1.05
	];
	const decAccArr = [
		{ x: 0.8, y: 0.8, z: 0.8 },
		{ x: 0.84, y: 0.84, z: 0.84 },
	];
	const decValArr = [
		{ x: 0.01, y: 0.01, z: 0.01 },
		{ x: 0.01, y: 0.01, z: 0.01 },
	];
	const cntAccArr = [
		{ x: 0, y: 0, z: 0 },
		{ x: 0, y: 0, z: 0 },
	];
	const minDeltaTimeArr = [0.05, 0.05]; // Minimum time between updates in seconds
	const maxCountArr = [3, 3];
	const reductionRateArr = [
		{ x: 4, y: 4, z: 4 },
		{ x: 4, y: 4, z: 4 },
	];

	const dampingArr = [
		{ x: 0.85, y: 0.85, z: 0.85 },
		{ x: 0.85, y: 0.85, z: 0.85 },
	]; // Velocity damping factor (0.85 = 15% reduction per frame)
	const maxVelocityArr = [
		{ x: 0.3, y: 0.3, z: 0.3 },
		{ x: 0.3, y: 0.3, z: 0.3 },
	]; // Reduced max velocity for smoother movement
	const deadZoneArr = [
		{ x: 0.04, y: 0.04, z: 0.04 },
		{ x: 0.04, y: 0.04, z: 0.04 },
	]; // Minimum velocity threshold

	const maxAccArr = [
		{ x: 8.7, y: 8.7, z: 8.7 }, // 7,7,7
		{ x: 9, y: 9, z: 9 }, // 7,7,7
	]; // Reduced max velocity for smoother movement


	(function() {
		
		const isIOS = Number(/iPad|iPhone|iPod/.test(navigator.userAgent));
		console.log('ios', isIOS);

		let limitValue = 0.12;
		let amplifiedValue = isIOS == 0 ? 150 : 100;
		let isTesting = false;
		let moveHandler;
		let phoneObject;
		
		let lastX = 0, lastY = 0, lastZ = 0;
		let velocityX = 0, velocityY = 0, velocityZ = 0;
		let positionX = 0, positionY = 0, positionZ = 0;
		let filterAccX = 0, filterAccY = 0, filterAccZ = 0;
		const velThreshold = 0.05;
		
		let mark = markArr[isIOS];
		let alpha = isIOS == 0 ? 0.8 : alphaArr[isIOS];
		let accThreashold = isIOS == 0 ? 0.2 : accThreasholdArr[isIOS];
		let incAcc = incAccArr[isIOS];
		let decAcc = decAccArr[isIOS];
		let decVal = decValArr[isIOS];
		let cntAcc = cntAccArr[isIOS];
		let minDeltaTime = minDeltaTimeArr[isIOS];
		let maxCount = maxCountArr[isIOS];
		let reductionRate = reductionRateArr[isIOS];
					
		let damping = isIOS == 0 ? 0.85 : dampingArr[isIOS];
		let maxVelocity = isIOS == 0 ? 0.3 : maxVelocityArr[isIOS];
		let deadZone = isIOS == 0 ? 0.01 : deadZoneArr[isIOS];
		
		let lastMoveTime = 0;
		let firstReading = true;
		
		var a = function(){};
		a__name__=!0;
		a.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				a.testBtn = window.document.getElementById("test-btn");
				a.resetBtn = window.document.getElementById("reset-btn");
				a.model = window.document.getElementById("model");
				a.axisX = window.document.getElementById("X axis").querySelector('p');
				a.axisY = window.document.getElementById("Y axis").querySelector('p');
				a.axisZ = window.document.getElementById("Z axis").querySelector('p');
				
      			a.model.addEventListener('load', () => {
		  			console.log(a.model);
					
					const threeScene = a.model[Object.getOwnPropertySymbols(a.model).find(sym => sym.description === 'scene')];

					if (!threeScene) {
    					console.error('Cannot find internal Three.js scene.');
					    return;
  					}
					
					phoneObject = threeScene.getObjectByName('Phone');
      			});
				
				a.resetBtn.addEventListener("click", function() {
					lastX = 0, lastY = 0, lastZ = 0;
					velocityX = 0, velocityY = 0, velocityZ = 0;
					positionX = 0, positionY = 0, positionZ = 0;
					filterAccX = 0, filterAccY = 0, filterAccZ = 0;
					
					lastMoveTime = 0;
					firstReading = true;
					
					a.model.cameraOrbit = '20deg 70deg';
					phoneObject.position.set(4, 7.8, 0);
				});
				
				a.testBtn.addEventListener("click", function() {
					isTesting = !isTesting;
					let model = a.model;
					let testBtn = a.testBtn;
					let btnDiv = window.document.getElementById("btn-div");
					let maxAcc = maxAccArr[isIOS]; // Reduced max velocity for smoother movement

					cntAcc = {x: 0, y: 0, z: 0};	
					lastX = 0, lastY = 0, lastZ = 0;
					velocityX = 0, velocityY = 0, velocityZ = 0;
					positionX = 0, positionY = 0, positionZ = 0;
					filterAccX = 0, filterAccY = 0, filterAccZ = 0;
					
					lastMoveTime = 0;
					firstReading = true;

					function detectMove(event) {						
						const now = Date.now();
  						const acceleration = event.acceleration;

  						if (firstReading) {
    						lastX = acceleration.x;
    						lastY = acceleration.y;
    						lastZ = acceleration.z;
							lastMoveTime = now;
    						firstReading = false;
    						return;
  						}
	
						const deltaTime = (now - lastMoveTime) / 1000;
						
						if (isIOS == 1) {
							if (deltaTime < minDeltaTime) {
								return; // Skip this update if it's too soon
							}

							// X axis
							if (Math.abs(acceleration.x) > accThreashold.x) {
								filterAccX = incAcc.x * filterAccX + acceleration.x * (1 - alpha.x);
								filterAxcX = Math.max(-maxAcc.x, Math.min(maxAcc.x, filterAccX));
								cntAcc.x = 0;
							}								
							else {
								filterAccX = Math.max(0.1, decAcc.x - cntAcc.x * decVal.x) * filterAccX;								
								if(cntAcc.x > maxCount) {
									velocityX = 0;
								} else cntAcc.x++;
							} 
							filterAccX = Math.max(-maxAcc.x, Math.min(maxAcc.x, filterAccX));							
							velocityX += filterAccX * deltaTime * mark.x;
							velocityX *= damping.x;						
							if (Math.abs(velocityX) < deadZone.x) velocityX = 0;
							velocityX = Math.max(-maxVelocity.x, Math.min(maxVelocity.x, velocityX));

							// Y axis
							if (Math.abs(acceleration.y) > accThreashold.y) {
								filterAccY = incAcc.y * filterAccY + acceleration.y * (1 - alpha.y);	
								filterAccy = Math.max(-maxAcc.y, Math.min(maxAcc.y, filterAccY));
								cntAcc.y = 0;
							}								
							else {
								filterAccY = Math.max(0.1, decAcc.y - cntAcc.y * decVal.y) * filterAccY;							
								if(cntAcc.y > maxCount) {
									velocityY = 0;
								} else cntAcc.y++;
							}
							filterAccY = Math.max(-maxAcc.y, Math.min(maxAcc.y, filterAccY));
							velocityY += filterAccY * deltaTime * mark.y;	
							velocityY *= damping.y;						
							if(Math.abs(velocityY) < deadZone.y) velocityY = 0;
							velocityY = Math.max(-maxVelocity.y, Math.min(maxVelocity.y, velocityY));

							// Z axis
							if (Math.abs(acceleration.z) > accThreashold.z) {
								filterAccZ = incAcc.z * filterAccZ + acceleration.z * (1 - alpha.z);	
								filterAccZ = Math.max(-maxAcc.z, Math.min(maxAcc.z, filterAccZ));
								cntAcc.z = 0;
							}								
							else {
								filterAccZ = Math.max(0.1, decAcc.z - cntAcc.z * decVal.z) * filterAccZ;							
								if(cntAcc.z > maxCount) {
									velocityZ = 0;
								} else cntAcc.z++;
							}
							filterAccZ = Math.max(-maxAcc.z, Math.min(maxAcc.z, filterAccZ));
							velocityZ += filterAccZ * deltaTime * mark.z;				
							velocityZ *= damping.z;						
							if(Math.abs(velocityZ) < deadZone.z) velocityZ = 0;
							velocityZ = Math.max(-maxVelocity.z, Math.min(maxVelocity.z, velocityZ));

							if (Math.abs(velocityX) > deadZone.x) {
								positionX += velocityX * deltaTime / reductionRate.x;
								positionX = Math.max(-limitValue - 4 / amplifiedValue - 0.05, Math.min(limitValue, positionX));
							}

							if (Math.abs(velocityY) > deadZone.y) {
								positionY += velocityY * deltaTime / reductionRate.y;
								positionY = Math.max(-limitValue - 7.8 / amplifiedValue, Math.min(limitValue, positionY));
							}

							if (Math.abs(velocityZ) > deadZone.z) {
								positionZ += velocityZ * deltaTime / reductionRate.z;
								positionZ = Math.max(-limitValue+0.02, Math.min(limitValue-0.02, positionZ));
							}
						} else if (isIOS == 0) {
							filterAccX = alpha * filterAccX + (1 - alpha) * acceleration.x;
						
							if (Math.abs(filterAccX) > accThreashold) {
							velocityX += filterAccX * deltaTime;
							}

							velocityX *= damping;

							if (Math.abs(velocityX) < deadZone) velocityX = 0;
							velocityX = Math.max(-maxVelocity, Math.min(maxVelocity, velocityX));

							filterAccY = alpha * filterAccY + (1 - alpha) * acceleration.y;
							if(Math.abs(filterAccY) > accThreashold) {
								velocityY += filterAccY * deltaTime;
							}

							velocityY *= damping;

							if(Math.abs(velocityY) < deadZone)	velocityY = 0;
							velocityY = Math.max(-maxVelocity, Math.min(maxVelocity, velocityY));

							filterAccZ = alpha * filterAccZ + (1 - alpha) * acceleration.z;
							if(Math.abs(filterAccZ) > accThreashold) {
								velocityZ += filterAccZ * deltaTime;
							}

							velocityZ *= damping;

							if(Math.abs(velocityZ) < deadZone)	velocityZ = 0;
							velocityZ = Math.max(-maxVelocity, Math.min(maxVelocity, velocityZ));

							if (Math.abs(velocityX) > deadZone) {
								positionX += velocityX * deltaTime;
								positionX = Math.max(-0.25, Math.min(0.15, positionX));
							}

							if (Math.abs(velocityY) > deadZone) {
								positionY += velocityY * deltaTime;
								positionY = Math.max(-0.25, Math.min(0.15, positionY));
							}

							if (Math.abs(velocityZ) > deadZone) {
								positionZ += velocityZ * deltaTime;
								positionZ = Math.max(-0.15, Math.min(0.15, positionZ));
							}
						}
    
					    lastX = acceleration.x;
    					lastY = acceleration.y;
    					lastZ = acceleration.z;
													
    					lastMoveTime = now;
						
						a.axisX.innerHTML = positionX.toFixed(2);
						a.axisY.innerHTML = positionY.toFixed(2);
						a.axisZ.innerHTML = positionZ.toFixed(2);
						
						phoneObject.position.set(4+positionX*amplifiedValue, 7.8+positionY*amplifiedValue, positionZ*amplifiedValue);
						a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						
// 						a.model.requestUpdate();
					}
					
					if(isTesting) {
						model.src = "<?=get_stylesheet_directory_uri();?>/assets/glbs/phone2.glb";
						
						testBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/Pause-Gyros.svg";
						a.resetBtn.style.display = "flex";

						btnDiv.style.top = "90%";
						btnDiv.style.left = "80%";

						model.onload = () => {
							moveHandler = (event) => detectMove(event);
							if (typeof DeviceMotionEvent.requestPermission === 'function') {
								DeviceMotionEvent.requestPermission()
									.then(response => {
										if (response === 'granted') {
											window.addEventListener('devicemotion', moveHandler);
										} else {
											alert("Motion permission was denied.");
										}
									})
									.catch(console.error);
							} else {
								// Android or other devices
								window.addEventListener('devicemotion', moveHandler);
							}
						}

						model.onerror = () => {
							alert("Failed to load 3D model. Please try again.");
						}

						
					} else {
						model.src = "<?=get_stylesheet_directory_uri();?>/assets/glbs/fainter2.glb";
						
						testBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/StartGyros.svg";
						a.resetBtn.style.display = "none";

						btnDiv.style.top = "48%";
						btnDiv.style.left = "52%";
						btnDiv.style.transform = "translate(-49%, -48%)";
                        model.cameraControls = true;
						
						window.removeEventListener('devicemotion' , moveHandler);
						phoneObject.position.set(4, 7.8, 0);

						a.axisX.innerHTML = "-";
						a.axisY.innerHTML = "-";
						a.axisZ.innerHTML = "-";
					}
				});
			});
		}
		
		a.main();
	})();
</script>
<?php get_footer();