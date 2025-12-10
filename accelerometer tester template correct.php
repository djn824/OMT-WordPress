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
	(function() {
		let isTesting = false;
		let moveHandler;
		let phoneObject;
		
		let lastX = 0, lastY = 0, lastZ = 0;
		let velocityX = 0, velocityY = 0, velocityZ = 0;
		let positionX = 0, positionY = 0, positionZ = 0;
		let filterAccX = 0, filterAccY = 0, filterAccZ = 0;
		let alpha = 0.7;
		let accThreashold = 0.2;
		const velThreshold = 0.05;
		
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
				
// 				document.addEventListener('keydown', function(event) {
// 					if (event.key === 's') {
// 						console.log('aefw');
// 						phoneObject.position.set(4, 6, 7.8);
// 							a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						
// 						a.model.requestUpdate();
// // 						phoneObject.position.y = 3;
// 					}
					
// 					if (event.key === 'b') {
// 						phoneObject.position.set(4, 3, 7.8);
// 							a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						
// 						a.model.requestUpdate();
// 					}
					
// 				});
				
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
					
					lastX = 0, lastY = 0, lastZ = 0;
					velocityX = 0, velocityY = 0, velocityZ = 0;
					positionX = 0, positionY = 0, positionZ = 0;
					filterAccX = 0, filterAccY = 0, filterAccZ = 0;
					
					lastMoveTime = 0;
					firstReading = true;
					
					const damping = 0.85; // Velocity damping factor (0.85 = 15% reduction per frame)
					const maxVelocity = 0.3; // Reduced max velocity for smoother movement
					const deadZone = 0.01; // Minimum velocity threshold
					
					function detectMove(event) {						
						const now = Date.now();
  						const acceleration = event.acceleration;
						return;
  						if (firstReading) {
    						lastX = acceleration.x;
    						lastY = acceleration.y;
    						lastZ = acceleration.z;
							lastMoveTime = now;
    						firstReading = false;
    						return;
  						}
						const deltaTime = (now - lastMoveTime) / 1000;
						
						filterAccX = alpha * filterAccX + (1 - alpha) * acceleration.x;
						
						if (Math.abs(filterAccX) > accThreashold) {
							velocityX += filterAccX * deltaTime;
						}
						
						velocityX *= damping;
						
						if (Math.abs(velocityX) < deadZone) velocityX = 0;
   						velocityX = Math.max(-maxVelocity, Math.min(maxVelocity, velocityX));
												
// 						if((Math.abs(filterAccX) < accThreashold && Math.abs(velocityX) < velThreshold)){// || acceleration.x == 0){
// 							velocityX = 0;
// 						}
						
// 						if(Math.abs(velocityX) > 0.3 && acceleration.x == 0) {
// 							velocityX = 0;
// 							filterAccX = 0;
// 						}
						
						filterAccY = alpha * filterAccY + (1 - alpha) * acceleration.y;
// 						velocityY += filterAccY * deltaTime;
						if(Math.abs(filterAccY) > accThreashold) {
							velocityY += filterAccY * deltaTime;
						}
						
						velocityY *= damping;
						
						if(Math.abs(velocityY) < deadZone)	velocityY = 0;
						velocityY = Math.max(-maxVelocity, Math.min(maxVelocity, velocityY));
// 						if((Math.abs(filterAccY) < accThreashold && Math.abs(velocityY) < velThreshold))	velocityY = 0;
						
						filterAccZ = alpha * filterAccZ + (1 - alpha) * acceleration.z;
						if(Math.abs(filterAccZ) > accThreashold) {
							velocityZ += filterAccZ * deltaTime;
						}
						
						velocityZ *= damping;
						
						if(Math.abs(velocityZ) < deadZone)	velocityZ = 0;
						velocityZ = Math.max(-maxVelocity, Math.min(maxVelocity, velocityZ));
// 						velocityZ += filterAccZ * deltaTime;
						
// 						if((Math.abs(filterAccZ) < accThreashold && Math.abs(velocityZ) < velThreshold))	velocityZ = 0;
							    
//     					if(acceleration.x != lastX && acceleration.x != 0){
    					if (Math.abs(velocityX) > deadZone) {
							positionX += velocityX * deltaTime;
							positionX = Math.max(-0.25, Math.min(0.15, positionX));
						}
						
// 						if(acceleration.y != lastY && acceleration.y != 0) {
						if (Math.abs(velocityY) > deadZone) {
	    					positionY += velocityY * deltaTime;
							positionY = Math.max(-0.25, Math.min(0.15, positionY));
						}
						
// 						if(acceleration.z != lastZ && acceleration.z != 0) {
						if (Math.abs(velocityZ) > deadZone) {
	    					positionZ += velocityZ * deltaTime;
							positionZ = Math.max(-0.15, Math.min(0.15, positionZ));
						}
    
					    lastX = acceleration.x;
    					lastY = acceleration.y;
    					lastZ = acceleration.z;
													
    					lastMoveTime = now;
						
						a.axisX.innerHTML = positionX.toFixed(2);
						a.axisY.innerHTML = positionY.toFixed(2);
						a.axisZ.innerHTML = positionZ.toFixed(2);
						
						phoneObject.position.set(4+velocityX*100, 7.8+velocityY*100, velocityZ*100);
						a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						
// 						a.model.requestUpdate();
					}
					
					if(isTesting) {
						model.src = "<?=get_stylesheet_directory_uri();?>/assets/glbs/phone2.glb";
						
						testBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/Pause-Gyros.svg";
						a.resetBtn.style.display = "flex";

						btnDiv.style.top = "90%";
						btnDiv.style.left = "80%";
                        model.cameraControls = false;

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