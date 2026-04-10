<?php 
/* Template Name:Screen Refresh Rate Test */
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
	
	.card {
		background-color: #f3f3f3;
		border: 2px solid #f3f3f3;
		border-radius: 10px;
		box-shadow: 0 5px 6px #d9d9d9;
		padding: 15px 20px 15px 20px !important;
		position: relative;
		margin: 0 auto;
		text-align: center;
  	}
	
	.fps-value {
		align-items: end;
		justify-content: center;
  	}
	
	.fps-number {
		font-size: 45px;
		font-weight: 700;
		color: #e35d26;
		text-align: left;
	}
	
	.fps-unit {
		font-size: 17px;
		color: black;
		text-align: left;
	}
	
	.test-btn {
		color: #ffffff;
		background-color: #e25d26;
		border: 1px solid #e25d26;
		border-radius: 5px;
		padding: 6px;
  	}
	
	.test-btn:focus {
		outline: none;
	}
	
	.video-container {
        position: relative;
        width: 40vw;
        height: auto;
		aspect-ratio: 16 / 9; /* keeps video ratio */
    	margin: 0px auto;
    }
	
	.video-container video {
		position: absolute;
		top: 0;
		height: 100%;
		object-fit: cover;
	}
	
	.video-controls button {
		min-width: 44px;
		font-size: 18px;
		padding: 4px 10px;
	}

	.side-view #video-left {
		left: -50%;
		width: 100%;
		clip-path: none;
	}

	.side-view #video-right {
		left: 50%;
		width: 100%;
		clip-path: none;
	}

	.split-view #video-left,
	.split-view #video-right {
		left: 0;
		width: 100%;
	}

	.video-divider {
		position: absolute;
		top: 0;
		left: 50%;
		width: 2px;
		height: 100%;
		background: rgba(255,255,255,0.9);
		transform: translateX(-50%);
		z-index: 30;
		cursor: ew-resize;
	}
	
	.divider-handle {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%) rotate(0deg) !important;

		width: 30px;
		height: 30px;
		border-radius: 50%;
		background: rgba(255,255,255,0.8);

		display: grid;
		grid-auto-flow: column;
		place-items: center;
		column-gap: 6px;

		z-index: 9999;
		box-shadow: 0 6px 18px rgba(0,0,0,0.25);
		pointer-events: auto;
		cursor: ew-resize;
	}
	
	.divider-handle .arrow {
		display: grid;
		place-items: center;

		width: 10px;
		height: 16px;

		font-size: 22px;
		font-weight: 900;
		line-height: 1;

		color: #000;
		font-family: Arial, Helvetica, sans-serif;

		transform: translateY(-4px) translateX(-5%);
		user-select: none;
	}
	
	.divider-handle .arrow::before,
	.divider-handle .arrow::after {
		content: none !important;
	}

	.side-view .video-divider {
		display: none;
	}

	.split-view .video-divider {
		display: block;
	}
	
	.view-tabs {
		display: flex;
		justify-content: center;
		gap: 0; 
	}

	.view-tab {
		flex: 1;
		margin: 0;
		border-radius: 0;
		border-color: #f0f0f0;
		transition: background 0.15s ease, color 0.15s ease;
	}

	.view-tab:first-child {
		border-top-left-radius: 4px;
		border-bottom-left-radius: 4px;
	}

	.view-tab:last-child {
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		border-left: none; /* merge borders */
	}

	.view-tab.active {
		background: #e25d26;
		color: #fff;
		border-color: #e25d26;
	}
	
	.view-tab:focus {
		outline: none;
	}

	.view-tab:focus-visible {
		outline: none;
	}
	
	.view-tab-group {
		display: inline-flex;
		width: min(90vw, 320px);
	}
	
	
	.container::after {
		content: "";
		position: absolute;
		top: 0;
		left: 50%;
		width: 2px;
		height: 100%;
		background: red;
		pointer-events: none;
	}
	
	.fps-label {
		position: absolute;
		top: 10px;
		padding: 4px 10px;
		font-size: 14px;
		font-weight: 700;
		color: #fff;
		background: rgba(0, 0, 0, 0.6);
		border-radius: 4px;
		z-index: 60;
		pointer-events: none;
		user-select: none;
		letter-spacing: 0.5px;
	}

	.fps-left {
		left: 10px;
	}

	.fps-right {
		right: 10px;
	}
	
	.fps-selectors {
		display: flex;
		justify-content: center;
		gap: 20px;
		margin-bottom: 12px;
	}

	.fps-select {
		display: flex;
		flex-direction: column;
		font-size: 14px;
		z-index: 50;
	}

	.fps-select label {
		margin-bottom: 4px;
		font-weight: 600;
	}

	.fps-select select {
		padding: 4px 8px;
		border-radius: 4px;
		border: 1px solid #ccc;
	}
	
	video {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
	
	#video-left {
		clip-path: inset(0 50% 0 0);
	}
	
	#video-right {
		clip-path: inset(0 0 0 50%);
	}
	
	#video-box {
		display: none;
	}
	
	@media all and (max-width: 768px) {
		.video-container.side-view video + video {
			margin-top: 10px;
		}
		
		.split-view {
			width: 60vw;
		}
		
		.fps-selectors {
			margin-bottom: 0px;
		}
		
		.video-container.side-view {
			display: flex;
			flex-direction: column;
			position: relative;
			width: 60vw;
		}
		
		.video-slot {
/* 			position: relative; */
		}
		
		.video-slot .fps-select {
		/*   position: absolute;
		  top: 8px;
		  left: 8px;
		  z-index: 60; */
		}
		
		.video-container.side-view video {
			position: relative;
			width: 100%;
			height: auto;
			left: 0 !important;
		}

		#video-left,
		#video-right {
			object-fit: contain;
		}
		
		.video-container.side-view .fps-select {
			position: absolute;
			z-index: 50;
			padding: 4px 6px;
			border-radius: 4px;
		}

		.video-container.side-view .fps-select select {
			border: none;
			font-size: 12px;
		}

		.video-container.side-view .fps-select.fps-left {
			top: 0px;
			left: 8px;
		}

		.video-container.side-view .fps-select.fps-right {
			top: calc(50%);
			left: 8px;
			right: auto;
		}
		
	}
	
	@media all and (max-width: 850px) and (min-width: 769px) {
		.side-view {
			width: 45vw;
		}
		
		.split-view {
			width: 80vw;
		}
	}
	
	@media all and (max-width: 1023px) and (min-width: 851px) {
		.side-view {
			width: 45vw;
		}
		
		.split-view {
			width: 60vw;
		}
	}
	
	@media all and (max-width: 1200px) and (min-width: 1024px) {
		.side-view {
			width: 35vw;
		}
		
		.split-view {
			width: 60vw;
		}
	}
	
	@media all and (max-width: 1400px) and (min-width: 1201px) {
		.side-view {
			width: 37vw;
		}
	}
</style>

<div class="container-fluid">
	<div class="d-flew justify-content-center align-items-center">
		<div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-7" style="margin: 0px auto;">
			<div class="card">
				<div class="fps-value">
					<span class="fps-number" id="fps-value">0</span>
					<span class="fps-unit">Hz</span>
				</div>
				<br/>
				<button class="test-btn" id="test-btn">
					<?php the_field("test_btn");?>
				</button>
				<br/>
				<span id="status"><?php the_field("measuring_label");?></span>
			</div>
			<br/>
		</div>
		
		<div id="video-box">
			<div class="view-tabs" style="text-align:center; margin-bottom:10px;">
				<div class="view-tab-group">
				<button class="view-tab active" data-view="side">Side by Side</button>
				<button class="view-tab" data-view="split">Split View</button>
				</div>
			</div>
			
			<div class="fps-selectors fps-global">
				<div class="fps-select fps-left">
<!-- 						<label>Left Video FPS</label> -->
					<select id="fps-left">
						<option value="12">12 FPS</option>
						<option value="24">24 FPS</option>
						<option value="30">30 FPS</option>
						<option value="60">60 FPS</option>
						<option value="120">120 FPS</option>
					</select>
				</div>

				<div class="fps-select fps-right">
<!-- 						<label>Right Video FPS</label> -->
					<select id="fps-right">
						<option value="12">12 FPS</option>
						<option value="24">24 FPS</option>
						<option value="30">30 FPS</option>
						<option value="60">60 FPS</option>
						<option value="120">120 FPS</option>
					</select>
				</div>
			</div>
						
			<div class="video-container side-view" id="video-wrapper">
				<div class="video-slot video-slot-left">
					<video id="video-left" muted preload="auto">
				  		<source id="video-left-source" src="" type="video/mp4">
					</video>
				</div>

				<div class="video-slot video-slot-right">
    				<video id="video-right" muted preload="auto">
      					<source id="video-right-source" src="" type="video/mp4">
    				</video>
  				</div>

				<div class="video-divider" id="video-divider">
    				<div class="divider-handle">
      					<span class="arrow arrow-left" style="padding-left: 0px">&lt;</span>
      					<span class="arrow arrow-right" style="padding-left: 0px">&gt;</span>
    				</div>
  				</div>
			</div>

			<div class="video-controls" style="margin-top:15px; display:flex; align-items:center; gap:10px; justify-content:center;">
				<button class="test-btn" id="play-toggle">▶</button>
				<input
				  type="range"
				  id="video-slider"
				  min="0"
				  max="1000"
				  value="0"
				  step="1"
				  style="width:300px;"
				>
			</div>
		</div>
	</div>
	
	<br/><br/>
	<div class="wid-sm-100 wid-xs-100">
		<div class="ct-row mar-bot-15 dis-flex">
			<img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('icon'); ?>" width="64" height="64">
			<div class="webcam-1-text_">
				<div class="icon-text-1">
					<h3 class="ct-bold-text"><?php the_field('get_easily_started_title'); ?></h3>
				</div>
			</div>
		</div>
		<div class="ct-row">
			<div class="new-webcam-desc">
				<ul>
					<?php

                        // check if the repeater field has rows of data
                        if (have_rows('get_easily_started_steps')):

                            // loop through the rows of data
                        while (have_rows('get_easily_started_steps')): the_row(); ?>
											<li>
												<span><?php the_sub_field('numbers'); ?></span>
												<div>
													<strong><?php the_sub_field('title'); ?></strong>
												</div>
											</li>
										<?php endwhile;
                                            else:
                                            endif;
                                        ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="wid-sm-100 wid-xs-100">
		<div class="ct-row mar-bot-15 dis-flex">
			<img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('red_icon'); ?>" width="64" height="64">
			<div class="webcam-1-text_">
				<div class="icon-text-1">
					<h3 class="ct-bold-text" style="color: rgb(226, 92, 27)"><?php the_field('trouble-shooting_title'); ?></h3>
				</div>
			</div>
		</div>

		<div class="trouble-shooting-2 dis-flex">
			<div class="width-33_3 wid-md-50 wid-xs-100">
				<div class="trouble-shooting-text-1 pd-1">
					<ul>
						<?php

                            // check if the repeater field has rows of data
                            if (have_rows('leftside_guide_list')):

                                // loop through the rows of data
                            while (have_rows('leftside_guide_list')): the_row(); ?>
												<li>
													<span class="fw-bold color-link">
														<?php the_sub_field('left_side_list_title'); ?>
													</span>
												</li>

											<?php endwhile;
                                                else:
                                                endif;
                                            ?>
					</ul>
				</div>

				<div align="center">
					<style>
						.OMT_MOINSBD_Middle { width: 300px; height: 250px; }
						@media(min-width: 500px) { .OMT_MOINSBD_Middle { width: 300px; height: 250px; } }
						@media(min-width: 800px) { .OMT_MOINSBD_Middle { width: 300px; height: 250px; } }
					</style>
				</div>

			</div>
			<?php
                $right_side_guide_list = get_field('rightside_guide_list');
            if ($right_side_guide_list) {?>
				<div class="width-33_3 wid-md-50  wid-xs-100">
					<div class="trouble-shooting-text-1 pd-1">
						<ul>
							<li>
								<span class="fw-bold">
									<?php echo $right_side_guide_list ?>
								</span>
							</li>
						</ul>
					</div>
				</div>
				<?php
                }?>
			<div class="width-33_3 md-hidden">
			</div>
		</div>
	</div>

	<div class="other-section">
			<div class="read-more-section">
				<div class="ct-row dis-flex">
					<div class="width-50 wid-xs-100">
						<div class="read-more-text-secction">
							<div class="read-more-title clearfix" >
								<h2><strong><?php the_field('more_about_title'); ?></strong></h2>
							</div>
							<?php

                                // check if the repeater field has rows of data
                                if (have_rows('test_content')):

                                    // loop through the rows of data
                                while (have_rows('test_content')): the_row(); ?>
													<div class="read-more-1">


														<div class="read-more-subtitle clearfix">
															<h3 class="mar-bot-20"><?php the_sub_field('heading'); ?></h3>
														</div>

														<div class="read-more-text">
															<p><?php the_sub_field('descp'); ?>
														</p>
													</div>
												</div>
											<?php endwhile;
                                                else:
                                                endif;
                                            ?>
					</div>
				</div>

				<div class="width-50">
					<div class="img-section pad-left-15">
						<img class="lazyload" src="<?php the_field('rightside_lazy_gif'); ?>" data-src="<?php the_field('rightside_image'); ?>"/>
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
	(function () {
		let testing = false;
		
		var a = function(){};
		a__name__=!0;
		
		a.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				a.testBtn = window.document.getElementById('test-btn');
				a.fpsValue = window.document.getElementById('fps-value');
				a.status = window.document.getElementById('status');
				a.videoLeft = window.document.getElementById('video-left');
				a.videoRight = window.document.getElementById('video-right');
				a.videoLeftSource = window.document.getElementById('video-left-source');
				a.videoRightSource = window.document.getElementById('video-right-source');
				a.startBtn = window.document.getElementById("start-videos");
				a.slider = window.document.getElementById("video-slider");
				a.tabs = window.document.querySelectorAll(".view-tab");
				a.wrapper = window.document.getElementById("video-wrapper");
				a.playBtn = window.document.getElementById("play-toggle");
				a.videoBox = window.document.getElementById("video-box");
				a.videoLeftText = window.document.getElementById("video-left-text");
				a.videoRightText = window.document.getElementById("video-right-text");
				a.fpsLeftSelect = window.document.getElementById('fps-left');
				a.fpsRightSelect = window.document.getElementById('fps-right');
				
				const FPS_TO_VIDEO = {
					12: "horse-12.mp4",
					24: "horse-24.mp4",
					30: "horse-30.mp4",
					60: "horse-60.mp4",
					120: "horse-120.mp4"
				};
				
				let frameCount = 0;
				let startTime = 0;
				let animationFrameId = null;
				let testing = false;
				let retryCount = 0;
				const maxRetries = 1;
				const testDuration = 3000; // Run test for 3 seconds
				const minFramesForReliableResult = 30;
				let lastUpdateTime = 0;
				const updateThrottle = 250; // Throttle DOM updates
				let duration = 0;
				let isSeeking = false;
				const divider = a.wrapper.querySelector(".video-divider");
				let isDraggingDivider = false;
				let splitPercent = 50;
				
				function applySplit(percent) {
					splitPercent = Math.max(0, Math.min(100, percent));

					divider.style.left = splitPercent + "%";

					a.videoLeft.style.clipPath = `inset(0 ${100 - splitPercent}% 0 0)`;
					a.videoRight.style.clipPath = `inset(0 0 0 ${splitPercent}%)`;
				}
				
				function clearSplit() {
					a.videoLeft.style.clipPath = "none";
					a.videoRight.style.clipPath = "none";
				}

				divider.addEventListener("pointerdown", e => {
					if (!a.wrapper.classList.contains("split-view")) return;
					isDraggingDivider = true;
					divider.setPointerCapture(e.pointerId);
				});

				window.addEventListener("pointermove", e => {
					if (!isDraggingDivider) return;

					const rect = a.wrapper.getBoundingClientRect();
					const x = e.clientX - rect.left;
					const percent = (x / rect.width) * 100;

					applySplit(percent);
				});

				window.addEventListener("pointerup", () => {
					isDraggingDivider = false;
				});
				
				function updateFPSSelectorPlacement() {
					const isMobile = window.innerWidth < 768;
				  	const isSideView = a.wrapper.classList.contains("side-view");

				  	const leftSlot = document.querySelector(".video-slot-left");
				  	const rightSlot = document.querySelector(".video-slot-right");
				  	const fpsGlobal = document.querySelector(".fps-global");

				  	if (isMobile && isSideView) {
						leftSlot.appendChild(a.fpsLeftSelect.parentElement);
						rightSlot.appendChild(a.fpsRightSelect.parentElement);
				  	} else {
						fpsGlobal.appendChild(a.fpsLeftSelect.parentElement);
						fpsGlobal.appendChild(a.fpsRightSelect.parentElement);
				  	}
				}

				window.addEventListener("resize", updateFPSSelectorPlacement);
				
				a.tabs.forEach(tab => {
					tab.addEventListener("click", () => {
						setTimeout(updateFPSSelectorPlacement, 0);
						
						a.tabs.forEach(t => t.classList.remove("active"));
						tab.classList.add("active");

						a.wrapper.classList.remove("side-view", "split-view");
						a.wrapper.classList.add(tab.dataset.view + "-view");
						
						if (tab.dataset.view === "split") {
							applySplit(splitPercent);
						} else {
							clearSplit();
						}
					});
				});
				
				updateFPSSelectorPlacement();

				function updateDisplay(fps) {
					a.fpsValue.innerHTML = fps;
				}
				
				function waitForCanPlayThrough(video) {
					return new Promise(resolve => {
						if (video.readyState >= 4) {
							resolve();
						} else {
							video.addEventListener("canplaythrough", resolve, { once: true });
						}
					});
				}
				
				function getVideoFPS (value) {
					if (value > 70)	return [60,120];
					if (value > 45)	return [30, 60];
					if (value > 26)	return [12, 30];
					if (value > 15)	return [12, 24];
					return [12, 12];
				}
				
				async function loadVideosFromDropdown() {
					const leftFPS = a.fpsLeftSelect.value;
					const rightFPS = a.fpsRightSelect.value;

					a.videoLeft.pause();
					a.videoRight.pause();
					
					a.playBtn.textContent = "▶";

					a.videoLeftSource.src =
						"<?=get_stylesheet_directory_uri();?>/assets/video/" + FPS_TO_VIDEO[leftFPS];
					a.videoRightSource.src =
						"<?=get_stylesheet_directory_uri();?>/assets/video/" + FPS_TO_VIDEO[rightFPS];

					a.videoLeft.load();
					a.videoRight.load();

					await Promise.all([
						waitForCanPlayThrough(a.videoLeft),
						waitForCanPlayThrough(a.videoRight)
					]);

					// Sync start
					a.videoLeft.currentTime = 0;
					a.videoRight.currentTime = 0;

					// Sync slider
					duration = Math.min(a.videoLeft.duration, a.videoRight.duration);
					a.slider.max = Math.floor(duration * 1000);
					a.slider.value = 0;
				}
				
				a.fpsLeftSelect.addEventListener("change", loadVideosFromDropdown);
				a.fpsRightSelect.addEventListener("change", loadVideosFromDropdown);


				async function animationLoop(timestamp) {
					if (!startTime) startTime = timestamp;
					frameCount++;
					const elapsedTime = timestamp - startTime;

					if (elapsedTime - lastUpdateTime > updateThrottle) {
						const instantFPS = Math.round((frameCount / elapsedTime) * 1000);
						updateDisplay(instantFPS);
						lastUpdateTime = elapsedTime;
					}

					if (elapsedTime < testDuration) {
						animationFrameId = requestAnimationFrame(animationLoop);
					} else {
						const fps = Math.round((frameCount / elapsedTime) * 1000);
						if (frameCount < minFramesForReliableResult && retryCount < maxRetries) {
							retryCount++;
							updateDisplay("--");
							console.log("Low frame count detected. Retrying...");
							setTimeout(startFPSCheck, 500);
						} else {
							updateDisplay(fps);
							a.testBtn.style.background = '#e35d26';
							a.testBtn.style.borderColor = '#e35d26';
							a.testBtn.disabled = false;
							a.status.innerHTML = "<?php the_field('fps_label'); ?>" + fps + "Hz";
							testing = false;
							retryCount = 0;
							
							const videoFPS = getVideoFPS(fps);
							a.fpsLeftSelect.value = videoFPS[0];
							a.fpsRightSelect.value = videoFPS[1];
							a.videoLeftSource.src = `<?=get_stylesheet_directory_uri();?>/assets/video/horse-${videoFPS[0]}.mp4`;
							a.videoRightSource.src = `<?=get_stylesheet_directory_uri();?>/assets/video/horse-${videoFPS[1]}.mp4`;
							
							a.videoLeft.pause();
							a.videoRight.pause();
							
							a.videoLeft.currentTime = 0;
							a.videoRight.currentTime = 0;
							
							a.videoLeft.load();
							a.videoRight.load();
							
							await Promise.all([
								waitForCanPlayThrough(a.videoLeft),
								waitForCanPlayThrough(a.videoRight)
							]);
							
							a.videoLeft.currentTime = 0;
							a.videoRight.currentTime = 0;
							
							a.videoBox.style.display = "block";
							playVideos();
						}
					}
				}

				function startFPSCheck() {
					if (testing) return;
					testing = true;
					
					a.videoBox.style.display = 'none';

					a.testBtn.style.background = '#cccccc';
					a.testBtn.style.borderColor = '#cccccc';
					a.testBtn.disabled = true;
					updateDisplay("...");
					a.status.innerHTML = "<?php the_field('measuring_label'); ?>";

					frameCount = 0;
					startTime = 0;
					lastUpdateTime = 0;

					if (animationFrameId) cancelAnimationFrame(animationFrameId);
					animationFrameId = requestAnimationFrame(animationLoop);
				}

				a.testBtn.addEventListener("click", () => startFPSCheck());
				a.testBtn.addEventListener("mouseenter", () => {
					if (!testing) a.testBtn.style.background = "#e35d26dd";
				});
				a.testBtn.addEventListener("mouseleave", () => {
					if (!testing) a.testBtn.style.background = "#e35d36";
				});

				document.addEventListener('visibilitychange', () => {
					if (document.hidden && testing) {
						cancelAnimationFrame(animationFrameId);
						console.log("Test paused - tab not visible");
					} else if (!document.hidden && testing) {
						animationFrameId = requestAnimationFrame(animationLoop);
						console.log("Resuming test...");
					}
				});

				setTimeout(() => {
					startFPSCheck();
				}, 1000);

				let isScrubbing = false;
				let rafSeek = null;
				
				a.videoLeft.addEventListener("timeupdate", () => {
					if (isScrubbing || duration === 0) return;
					a.slider.value = Math.floor((a.videoLeft.currentTime / duration) * a.slider.max);
				});

				function waitForMetadata(video) {
					return new Promise(resolve => {
						if (video.readyState >= 1 && video.duration) {
							resolve();
						} else {
							video.addEventListener("loadedmetadata", resolve, { once: true });
						}
					});
				}

				Promise.all([
					waitForMetadata(a.videoLeft),
					waitForMetadata(a.videoRight)
				]).then(() => {
					duration = Math.min(a.videoLeft.duration, a.videoRight.duration);
					a.slider.max = Math.floor(duration * 1000);
				});

				a.slider.addEventListener("pointerdown", () => {
					isScrubbing = true;
					wasPlaying = !a.videoLeft.paused;
					pauseVideos();
				});

				a.slider.addEventListener("input", () => {
				  if (!isScrubbing) return;

				  const targetTime = (a.slider.value / a.slider.max) * duration;

				  if (rafSeek) cancelAnimationFrame(rafSeek);

				  rafSeek = requestAnimationFrame(() => {
					a.videoLeft.currentTime = targetTime;
					a.videoRight.currentTime = targetTime;
				  });
				});

				a.slider.addEventListener("pointerup", () => {
// 				  isScrubbing = false;
// 	if (wasPlaying) playVideos();
				});
				
				function playVideos() {
					a.videoLeft.play();
					a.videoRight.play();
					a.playBtn.textContent = "⏸";
					isScrubbing = false;
				}

				function pauseVideos() {
					a.videoLeft.pause();
					a.videoRight.pause();
					a.playBtn.textContent = "▶";
				}

				a.playBtn.addEventListener("click", () => {
					if (a.videoLeft.paused) {
						playVideos();
					} else {
						pauseVideos();
					}
				});
				
				[a.videoLeft, a.videoRight].forEach(video => {
					video.addEventListener("play", () => {
						a.playBtn.textContent = "⏸";
					});

					video.addEventListener("pause", () => {
						a.playBtn.textContent = "▶";
					});

					video.addEventListener("ended", () => {
						a.playBtn.textContent = "▶";
					});
				});
			});
		}
		
		a.main();
	})();
</script>

<?php get_footer();