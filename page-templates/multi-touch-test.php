<?php /* Template Name:Multi-touch Test*/
get_header();?>
<style media="screen">	
	body.no-scroll {
		overflow: hidden !important;
	}
	
	.touch-point {
		position: absolute;
		width: 80px;
		height: 80px;
		background-color: #E35D2680;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		pointer-events: none;
		z-index: 10;
	}
	
	.touch-point::after {
		content: "";
		position: absolute;
		top: 50%;
		left: 50%;
		width: 40px;
		height: 40px;
		background-color: #E35D26;
		border-radius: 50%;
		transform: translate(-50%, -50%);
	}
	
	.touch-point-out {
		position: absolute;
		width: 80px;
		height: 80px;
		background-color: #A8634540;
		border-radius: 50%;
		transform: translate(-50%, -50%);
		pointer-events: none;
		z-index: 10;
	}
	
	.touch-point-out::after {
		content: "";
		position: absolute;
		top: 50%;
		left: 50%;
		width: 40px;
		height: 40px;
		background-color: #A8634580;
		border-radius: 50%;
		transform: translate(-50%, -50%);
	}
	
	.container-fluid {
		min-height: 60vh;
		display: flex;
		flex-direction: column;
	}
	
	.desktop-container {
		flex: 1;
		display: flex;
	}
	
	.test-container {
		display: flex;
		flex-direction: column;
		height: 100%;
	}
	
	.test-box {
		border-radius: 10px;
		border: 2px solid #436f8e;
		position: relative;
		flex: 1;
		min-height: 60vh;
	}
	
	.status-box {
		position: absolute;
		top: 0;
		padding: 5px 10px;
		color: white;
		font-size: 16px;
		font-family: 'Raleway';
		width: 45%;
		text-align: center;
		white-space: nowrap;
	    overflow: hidden;
    	text-overflow: ellipsis;
	}
	
	.current {
		left: 0;
        background-color: #E35D26;
        border-top-left-radius: 8px;
        border-bottom-right-radius: 5px;
	}

    .maximum {
    	right: 0;
        background-color: #436F8E;
        border-top-right-radius: 8px;
        border-bottom-left-radius: 5px;
	}
	
	.begin-label {
		position: absolute;
        background-color: #E35D26;
		color: white;
        padding: 16px 20px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 20px;
        text-align: left;
        line-height: 1.4;
		top: 48%;
		top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
	}
	
	.expand-icon {
		position: absolute;
        bottom: 16px;
        right: 16px;
        cursor: pointer;
	}
	
	.note-container {
		display: flex !important;
        flex-direction: column;
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
		height: fit-content;
	}
		
	.fullscreen-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		background-color: #f5f5f5;
		z-index: 9999;
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 20px;
		overflow: hidden;
	}

	.test-box.fullscreen {
		width: calc(100vw - 40px) !important;
		height: calc(100vh - 120px) !important;
		max-width: none !important;
		max-height: none !important;
		margin: 0 !important;
		z-index: 10000;
		box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
		position: fixed !important;
		top: 40 !important;  
		background-color: #fff;
		border-radius: 10px !important;
		border: 2px solid #436f8e !important;
		overflow: hidden; 
	}

	.fullscreen .expand-icon {
		transform: rotate(180deg);
		transition: transform 0.3s ease;
	}

	.fullscreen-active .note-container,
	.fullscreen-active .read-more-section {
		display: none !important;
	}

	.fullscreen-active .desktop-container {
		position: relative;
	}
		
	@media all and (max-width: 715px) {
		.begin-label {
			width: 80%;
		}
	}
	
	
	@media all and (min-width: 991px) {	
		.more-about {
			padding-left: 30px;
		}
	}
</style>

<div class="container-fluid">
	<div class="row desktop-container">
		<div class="col-lg-6 col-xl-6 col-12">
			<div class="test-container">
				<div class="test-box" id="test-box">
					<div class="status-box current"><p style="margin-bottom: 5px;"><strong><?php the_field("current_label");?> 0</strong></p></div>
					<div class="status-box maximum"><p style="margin-bottom: 5px;"><strong><?php the_field("maximum_label");?> 0</strong></p></div>
			
					<div class="begin-label" id="begin-label"><p><?php the_field("begin_label");?></p></div>
			
					<div class="expand-icon">
						<img id="expand" class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/Expand1.svg" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-xl-6 col-12 note-container">
			<div class="note-message d-none d-lg-block d-xl-block">
				<?php the_field('note');?>
			</div>
			<div class="read-more-section">
				<div class="ct-row dis-flex">
					<div class="more-about">
						<div class="read-more-text-secction">
							<div class="read-more-title clearfix" >
								<h2><strong><?php the_field('more_about_title');?></strong></h2>
							</div>
							<?php
							if( have_rows('test_content') ):
							while ( have_rows('test_content') ) : the_row();?>
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
</div>
</div>
</article>
</div>
</div>

<script>
	(function() {
		var a = function(){};
		a__name__=!0;
		a.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				a.testBox = window.document.getElementById("test-box");
				a.beginLabel = window.document.getElementById("begin-label");
				a.expandIcon = window.document.getElementById("expand");
				a.containerFluid = window.document.querySelector('.container-fluid');
				a.noteContainer = window.document.querySelector('.note-container');
				
				let scrollPosition = 0;
				let maxTouchCount = 0;
				let fullscreenActiveTouches = {};
				let isFullscreen = false;
				let fullscreenTestBox = null;
				const activeTouches = {};

				function createTouchPoint(touch, targetBox) {
					const testBox = targetBox || a.testBox;
					
					if(testBox.querySelector('#begin-label') && testBox.querySelector('#begin-label').style.display != 'none') {
						testBox.querySelector('#begin-label').style.display = 'none';
					}
					const touchPoint = document.createElement('div');
					touchPoint.classList.add('touch-point');
					touchPoint.style.left = `${touch.clientX - testBox.getBoundingClientRect().left}px`;
					touchPoint.style.top = `${touch.clientY - testBox.getBoundingClientRect().top}px`;
					touchPoint.id = `touch-${touch.identifier}${isFullscreen ? '-fs' : ''}`;
					testBox.appendChild(touchPoint);
				}

				function updateTouchPoint(touch, targetBox) {
					const testBox = targetBox || a.testBox;
					const suffix = targetBox === fullscreenTestBox ? '-fs' : '';
					
					const touchPoint = document.getElementById(`touch-${touch.identifier}${suffix}`);
					if (touchPoint) {						
						const touchLeft = touch.clientX - testBox.getBoundingClientRect().left;
						const touchTop = touch.clientY - testBox.getBoundingClientRect().top;
						
						touchPoint.style.left = `${touchLeft}px`;
						touchPoint.style.top = `${touchTop}px`;
						
						if(testBox == a.testBox) {
							if(touchLeft < 0 || touchLeft > testBox.getBoundingClientRect().width || touchTop < 0 || touchTop > testBox.getBoundingClientRect().height) {
								touchPoint.classList.remove('touch-point');
								touchPoint.classList.add('touch-point-out');
							} else {
								touchPoint.classList.remove('touch-point-out');
								touchPoint.classList.add('touch-point');
							}
						}
					}
				}

				function removeTouchPoint(touch, targetBox) {
					const suffix = targetBox === fullscreenTestBox ? '-fs' : '';
					
					const touchPoint = document.getElementById(`touch-${touch.identifier}${suffix}`);
					if (touchPoint) {
						touchPoint.remove();
					}
				}

				function updateCurrentTouchCount(targetBox, touchCollection) {
					const box = targetBox || a.testBox;
                	const touches = touchCollection || activeTouches;
					
					const currentLabel = box.querySelector('.current p strong');
					const touchCount = Object.keys(touches).length;
					const currentLabelText = '<?php the_field("current_label");?>';
					currentLabel.textContent = `${currentLabelText} ${touchCount}`;

					updateMaximumTouchCount(touchCount, box);
				}

				function updateMaximumTouchCount(currentCount, targetBox) {
					const box = targetBox || a.testBox;

					if (currentCount > maxTouchCount) {
						maxTouchCount = currentCount;
						const maximumLabel = box.querySelector('.maximum p strong');
						const maximumLabelText = '<?php the_field("maximum_label");?>';
						maximumLabel.textContent = `${maximumLabelText} ${maxTouchCount}`;
					}
				}
				
				function addTouchHandlers(testBox, touchesCollection) {
					const touches = touchesCollection || activeTouches;

					testBox.addEventListener('touchstart', function (event) {
						event.preventDefault();
						for (let touch of event.changedTouches) {
							touches[touch.identifier] = touch;
							createTouchPoint(touch, testBox);
						}
						updateCurrentTouchCount(testBox, touches);
					});

					testBox.addEventListener('touchmove', function (event) {
						event.preventDefault();
						for (let touch of event.changedTouches) {
							touches[touch.identifier] = touch;
							updateTouchPoint(touch, testBox);
						}
					});

					testBox.addEventListener('touchend', function (event) {
						event.preventDefault();
						for (let touch of event.changedTouches) {
							delete touches[touch.identifier];
							removeTouchPoint(touch, testBox);
						}
						updateCurrentTouchCount(testBox, touches);
					});

					testBox.addEventListener('touchcancel', function (event) {
						event.preventDefault();
						for (let touch of event.changedTouches) {
							delete touches[touch.identifier];
							removeTouchPoint(touch, testBox);
						}
						updateCurrentTouchCount(testBox, touches);
					});
				};
				
				addTouchHandlers(a.testBox, activeTouches);
				
				a.expandIcon.addEventListener('touchstart', function (e) {
					e.preventDefault();
                	e.stopPropagation();
					
					if (isFullscreen) {
						exitFullscreen();
					} else {
						enterFullscreen();
					}
				});
				
				function enterFullscreen() {
					isFullscreen = true;
					scrollPosition = window.pageYOffset;
					document.body.classList.add('no-scroll');
        			document.body.style.top = `-${scrollPosition}px`;
					
					const overlay = document.createElement('div');
					overlay.className = 'fullscreen-overlay';
					overlay.id = 'fullscreen-overlay';

					fullscreenTestBox = a.testBox.cloneNode(true);
					fullscreenTestBox.classList.add('fullscreen');
					fullscreenTestBox.id = 'fullscreen-test-box';
					
					const existingTouchPoints = fullscreenTestBox.querySelectorAll('.touch-point');
                	existingTouchPoints.forEach(point => point.remove());

					overlay.appendChild(fullscreenTestBox);
					document.body.appendChild(overlay);

					a.containerFluid.classList.add('fullscreen-active');

					const cloneExpandIcon = fullscreenTestBox.querySelector('.img-fluid');
					cloneExpandIcon.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Expand2.svg";
					cloneExpandIcon.addEventListener('touchstart', function(e) {
						e.preventDefault();
						e.stopPropagation();
						exitFullscreen();
					});
					
					fullscreenActiveTouches = {};
					
					addTouchHandlers(fullscreenTestBox, fullscreenActiveTouches);

					const originalCurrent = a.testBox.querySelector('.current p strong');
					const fullscreenCurrent = fullscreenTestBox.querySelector('.current p strong');
					if (originalCurrent && fullscreenCurrent) {
						fullscreenCurrent.textContent = originalCurrent.textContent;
					}

					const originalMaximum = a.testBox.querySelector('.maximum p strong');
					const fullscreenMaximum = fullscreenTestBox.querySelector('.maximum p strong');
					if (originalMaximum && fullscreenMaximum) {
						fullscreenMaximum.textContent = originalMaximum.textContent;
					}

					overlay.addEventListener('touchstart', function(e) {
						if (e.target === overlay) {
							exitFullscreen();
						}
					});
				}
				
				function exitFullscreen() {
					isFullscreen = false;
					const overlay = document.getElementById('fullscreen-overlay');
					if (overlay) {
						if (fullscreenTestBox) {
							const fullscreenCurrent = fullscreenTestBox.querySelector('.current p strong');
							const originalCurrent = a.testBox.querySelector('.current p strong');
							if (fullscreenCurrent && originalCurrent) {
								originalCurrent.textContent = fullscreenCurrent.textContent;
							}
							
							const fullscreenMaximum = fullscreenTestBox.querySelector('.maximum p strong');
							const originalMaximum = a.testBox.querySelector('.maximum p strong');
							if (fullscreenMaximum && originalMaximum) {
								originalMaximum.textContent = fullscreenMaximum.textContent;

								const maxParts = fullscreenMaximum.textContent.split(' ');
								maxTouchCount = parseInt(maxParts[maxParts.length - 1]) || 0;
							}

							const fullscreenLabel = fullscreenTestBox.querySelector('#begin-label');
							const originalLabel = a.testBox.querySelector('#begin-label');
							if (fullscreenLabel && originalLabel) {
								originalLabel.style.display = fullscreenLabel.style.display;
							}
						}
						
						overlay.remove();
					}

					document.body.classList.remove('no-scroll');
					document.body.style.position = '';
					document.body.style.top = '';
					window.scrollTo(0, scrollPosition);

					a.containerFluid.classList.remove('fullscreen-active');
					
					fullscreenTestBox = null;
                	fullscreenActiveTouches = {};
					
					if (a.noteContainer) {
						a.noteContainer.style.display = '';

						const noteMessage = a.noteContainer.querySelector('.note-message');
						if (noteMessage && window.innerWidth >= 992) {
							noteMessage.classList.remove('d-none');
							noteMessage.classList.add('d-lg-block', 'd-xl-block');
						}
					}        
				}
			});
		}
		
		a.main();
	})();
</script>
<?php get_footer();