<?php
/* Template Name:Stuck Pixel Fixer */
get_header(); ?>
<style media="screen">
	@media all and (max-width: 1024px) {
		#sAs-menu-responsive span {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/toggle.png);
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

	.test-btn {
		color: #ffffff;
		background-color: #e25d26;
		border: 1px solid #e25d26;
		border-radius: 5px;
		padding: 6px;
		width: 180px;
		height: 50px;
		font-size: 24px;
	}

	.test-btn:hover {
		background-color: #e25d26dd;
	}

	#fullscreenBtn {
		position: absolute;
		width: 40px;
		height: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
		font-size: 1.5rem;
		cursor: pointer;
		user-select: none;
		transition: opacity 0.3s ease;
		z-index: 2147483646;
	}

	#exitBtn {
		position: absolute;
		background: #e25d26;
		border: 1px solid #e25d26;
		border-radius: 50%;
		width: 40px;
		height: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
		color: #ffffff;
		font-size: 1.5rem;
		cursor: pointer;
		user-select: none;
		transition: opacity 0.3s ease;
		z-index: 2147483646;
	}

	#fixHint {
		position: absolute;
		top: 0;
		left: 0;
		font-size: clamp(16px, 2vw, 18px);
		font-weight: 600;
		user-select: none;
		color: #0c2f57;
		background: #ffffff;
		border-radius: 10px;
		box-shadow: 0 8px 26px rgba(0, 0, 0, 0.35);
		text-align: left;
		max-width: min(440px, calc(100vw - 30px));
		white-space: normal;
		line-height: 1.25;
		padding: 20px 24px;
		pointer-events: none;
		opacity: 0;
		visibility: hidden;
		transform: translateY(10px);
		transition: opacity 0.55s ease, transform 0.55s ease, visibility 0s linear 0.55s;
		z-index: 2147483646;
	}

	#fixHint::before {
		content: '';
		position: absolute;
		top: 50%;
		left: -14px;
		width: 0;
		height: 0;
		transform: translateY(-50%);
		border-top: 12px solid transparent;
		border-bottom: 12px solid transparent;
		border-right: 14px solid #ffffff;
	}

	#fixHint.arrow-right::before {
		left: auto;
		right: -14px;
		border-right: 0;
		border-left: 14px solid #ffffff;
	}

	#fixHint.is-visible {
		opacity: 1;
		visibility: visible;
		transform: translateY(0);
		transition: opacity 0.35s ease, transform 0.35s ease;
	}

	#fixHint.is-faded {
		opacity: 0;
		transform: translateY(10px);
		visibility: hidden;
	}

	#exitBtn {
		top: 15px;
		right: 15px;
		left: auto;
	}

	#fullscreenBtn {
		top: 15px;
		left: 15px;
	}

	#fix-screen.controls-bottom #fullscreenBtn,
	#fix-screen.controls-bottom #exitBtn {
		top: auto;
		bottom: 15px;
	}

	#fix-screen.controls-bottom #exitBtn {
		right: 15px;
		left: auto;
	}

	.hidden {
		opacity: 0;
		pointer-events: none;
	}

	#fix-screen {
		position: fixed;
		display: none;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		max-height: 100vh;
		margin: 0;
		background: #000;
		overflow: hidden;
		touch-action: none;
		border-radius: 0;
		z-index: 2147483645;
	}

	#fix-patch {
		position: absolute;
		width: 220px;
		height: 220px;
		left: 50%;
		top: 50%;
		margin-left: -110px;
		margin-top: -110px;
		padding: 10px;
		background: #436f8e;
		border-radius: 4px;
		border: 1px solid #436f8e;
		box-shadow: 0 0 16px #436f8e, 0 0 14px #436f8e;
		cursor: grab;
		touch-action: none;
		z-index: 2147483646;
		box-sizing: border-box;
	}

	#fix-patch.dragging {
		cursor: grabbing;
	}

	#fix-patch canvas {
		display: block;
		width: 100%;
		height: 100%;
		background: #000000;
		filter: none;
		image-rendering: pixelated;
		image-rendering: crisp-edges;
	}

	html, body {
		margin: 0;
		padding: 0;
	}

	.ios-fullscreen-fix,
	.ios-fullscreen-fix body,
	.ios-fullscreen-fix #fix-screen {
		position: fixed !important;
		top: 0 !important;
		left: 0 !important;
		width: 100vw !important;
		height: 100vh !important;
		max-height: 100vh !important;
		margin: 0 !important;
		border-radius: 0 !important;
		overflow: hidden !important;
		background: #000;
	}
</style>

<div class="container-fluid">
	<div style="justify-content: center; display: flex">
		<button class="test-btn" id="test-btn">
			<?php the_field("start_btn"); ?>
		</button>
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
					if (have_rows('get_easily_started_steps')):
						while (have_rows('get_easily_started_steps')): the_row(); ?>
							<li>
								<span><?php the_sub_field('numbers'); ?></span>
								<div>
									<strong><?php the_sub_field('title'); ?></strong>
								</div>
							</li>
						<?php endwhile;
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
			<div class="wid-100 wid-md-100 wid-xs-100">
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

	<div id="fix-screen">
		<div id="fixHint"></div>
		<img id="fullscreenBtn" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Expand1.svg" alt="Fullscreen">
		<div id="exitBtn">✕</div>
		<div id="fix-patch" aria-label="Drag over stuck pixel">
            <!-- Fix Patch Canvas -->
			<canvas id="fix-canvas" width="64" height="64"></canvas>
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
		var a = function () {};
		a.__name__ = !0;

		a.main = function () {
			window.addEventListener('DOMContentLoaded', function () {
				a.startBtn = document.getElementById('test-btn');
				a.fixScreen = document.getElementById('fix-screen');
				a.exitBtn = document.getElementById('exitBtn');
				a.fullscreenBtn = document.getElementById('fullscreenBtn');
				a.fixHint = document.getElementById('fixHint');
				a.patch = document.getElementById('fix-patch');
				a.canvas = document.getElementById('fix-canvas');
				a.ctx = a.canvas.getContext('2d', { alpha: false });

				var hideTimer = null;
				var hintFadeTimer = null;
				var isHoveringControl = false;
				var controls = [a.exitBtn, a.fullscreenBtn];
				var rafId = null;
				var dragging = false;
				var dragOffsetX = 0;
				var dragOffsetY = 0;
				var lastRelativePos = { x: 0.5, y: 0.5 };
				var hasMovedPatch = false;
				var noiseRenderScale = 1;

				var hintDefault = '<?php the_field('pixel_fixer_instructions'); ?>';
				if (a.fixHint) {
					a.fixHint.textContent = hintDefault;
				}

				function clearHintFadeTimer() {
					if (hintFadeTimer) {
						clearTimeout(hintFadeTimer);
						hintFadeTimer = null;
					}
				}

				function positionHint() {
					if (!a.fixHint || !a.patch || a.fixScreen.style.display !== 'block') return;
					var patchRect = a.patch.getBoundingClientRect();
					var screenRect = a.fixScreen.getBoundingClientRect();
					var gap = 32;
					var hintWidth = a.fixHint.offsetWidth || 320;
					var hintHeight = a.fixHint.offsetHeight || 120;
					var left = patchRect.right - screenRect.left + gap;
					var top = patchRect.top - screenRect.top + ((patchRect.height - hintHeight) / 2);
					var maxLeft = screenRect.width - hintWidth - 15;
					var maxTop = screenRect.height - hintHeight - 15;
					if (left > maxLeft) {
						left = Math.max(15, patchRect.left - screenRect.left - hintWidth - gap);
						a.fixHint.classList.add('arrow-right');
					} else {
						a.fixHint.classList.remove('arrow-right');
					}
					a.fixHint.style.left = Math.max(15, Math.min(maxLeft, left)) + 'px';
					a.fixHint.style.top = Math.max(15, Math.min(maxTop, top)) + 'px';
				}

				function showHintTemporarily() {
					if (!a.fixHint) return;
					clearHintFadeTimer();
					a.fixHint.classList.remove('is-faded');
					a.fixHint.classList.add('is-visible');
					positionHint();
					hintFadeTimer = setTimeout(function () {
						a.fixHint.classList.add('is-faded');
					}, 10000);
				}

				function patchSize() {
					return Math.min(280, Math.max(180, Math.floor(window.innerWidth * 0.30)));
				}

				function layoutPatch() {
					var s = patchSize();
					a.patch.style.width = s + 'px';
					a.patch.style.height = s + 'px';
					a.patch.style.marginLeft = (-s / 2) + 'px';
					a.patch.style.marginTop = (-s / 2) + 'px';
					var inner = Math.max(120, s - 2);
					a.canvas.width = Math.round(inner * noiseRenderScale);
					a.canvas.height = Math.round(inner * noiseRenderScale);
					a.ctx.imageSmoothingEnabled = false;
				}

				function captureRelativePosition() {
					var parent = a.fixScreen.getBoundingClientRect();
					var rect = a.patch.getBoundingClientRect();
					if (!parent.width || !parent.height) {
						lastRelativePos = { x: 0.5, y: 0.5 };
						return;
					}
					var centerX = rect.left - parent.left + (rect.width / 2);
					var centerY = rect.top - parent.top + (rect.height / 2);
					lastRelativePos = {
						x: Math.max(0, Math.min(1, centerX / parent.width)),
						y: Math.max(0, Math.min(1, centerY / parent.height))
					};
				}

				function clampPatchPosition(parentRect, pw, ph, x, y) {
					var minX = -(pw / 2);
					var minY = -(ph / 2);
					var maxX = parentRect.width - (pw / 2);
					var maxY = parentRect.height - (ph / 2);
					return {
						x: Math.max(minX, Math.min(x, maxX)),
						y: Math.max(minY, Math.min(y, maxY))
					};
				}

				function fitPatchToScreen(useRelativeCenter) {
					var parent = a.fixScreen.getBoundingClientRect();
					var pw = a.patch.offsetWidth;
					var ph = a.patch.offsetHeight;
					if (!parent.width || !parent.height || !pw || !ph) return;

					var x;
					var y;
					if (useRelativeCenter) {
						x = (parent.width * lastRelativePos.x) - (pw / 2);
						y = (parent.height * lastRelativePos.y) - (ph / 2);
					} else {
						var left = parseFloat(a.patch.style.left);
						var top = parseFloat(a.patch.style.top);
						if (isNaN(left) || isNaN(top)) {
							x = (parent.width - pw) / 2;
							y = (parent.height - ph) / 2;
						} else {
							x = left;
							y = top;
						}
					}

					var clamped = clampPatchPosition(parent, pw, ph, x, y);
					a.patch.style.left = clamped.x + 'px';
					a.patch.style.top = clamped.y + 'px';
					a.patch.style.marginLeft = '0';
					a.patch.style.marginTop = '0';
					a.patch.style.transform = 'none';
					updateControlPlacement();
					positionHint();
				}

				function updateControlPlacement() {
					var parent = a.fixScreen.getBoundingClientRect();
					var rect = a.patch.getBoundingClientRect();
					if (!parent.width || !parent.height || !rect.width || !rect.height) return;

					var currentBottom = a.fixScreen.classList.contains('controls-bottom');
					var edgeOffset = 15; // Matches the fixed button edge offset in CSS.
					var proximityPadding = 24; // Extra area around controls before switching sides.
					var controlWidth = (a.exitBtn && a.exitBtn.offsetWidth) || 40;
					var controlHeight = (a.exitBtn && a.exitBtn.offsetHeight) || 40;
					var patchRect = {
						left: rect.left - parent.left,
						top: rect.top - parent.top,
						right: rect.left - parent.left + rect.width,
						bottom: rect.top - parent.top + rect.height
					};

					function intersectsExpandedRect(patch, area) {
						var expanded = {
							left: area.left - proximityPadding,
							top: area.top - proximityPadding,
							right: area.right + proximityPadding,
							bottom: area.bottom + proximityPadding
						};
						return patch.left < expanded.right &&
							patch.right > expanded.left &&
							patch.top < expanded.bottom &&
							patch.bottom > expanded.top;
					}

					function createControlArea(left, top) {
						return {
							left: left,
							top: top,
							right: left + controlWidth,
							bottom: top + controlHeight
						};
					}

					var rightX = parent.width - edgeOffset - controlWidth;
					var bottomY = parent.height - edgeOffset - controlHeight;

					var topLeftArea = createControlArea(edgeOffset, edgeOffset);
					var topRightArea = createControlArea(rightX, edgeOffset);
					var bottomLeftArea = createControlArea(edgeOffset, bottomY);
					var bottomRightArea = createControlArea(rightX, bottomY);

					var nearTopButtons = intersectsExpandedRect(patchRect, topLeftArea) ||
						intersectsExpandedRect(patchRect, topRightArea);
					var nearBottomButtons = intersectsExpandedRect(patchRect, bottomLeftArea) ||
						intersectsExpandedRect(patchRect, bottomRightArea);

					// Only switch when the patch is close to control zones.
					// Keep current side while patch is in the middle area.
					var moveButtonsToBottom = currentBottom;
					if (nearTopButtons && !nearBottomButtons) {
						moveButtonsToBottom = true;
					} else if (nearBottomButtons && !nearTopButtons) {
						moveButtonsToBottom = false;
					}

					a.fixScreen.classList.toggle('controls-bottom', moveButtonsToBottom);
				}

				function refreshPatchAfterViewportChange(useRelativeCenter) {
					window.requestAnimationFrame(function () {
						window.requestAnimationFrame(function () {
							layoutPatch();
							fitPatchToScreen(useRelativeCenter);
							updateControlPlacement();
						});
					});
				}

				function drawFlashFrame() {
					var w = a.canvas.width;
					var h = a.canvas.height;
					var img = a.ctx.createImageData(w, h);
					var d = img.data;
					for (var i = 0; i < d.length; i += 4) {
						var mask = 1 + ((Math.random() * 7) | 0); // 1..7 => RGB bitmask
						d[i] = (mask & 1) ? 255 : 0;
						d[i + 1] = (mask & 2) ? 255 : 0;
						d[i + 2] = (mask & 4) ? 255 : 0;
						d[i + 3] = 255;
					}
					a.ctx.putImageData(img, 0, 0);
				}

				function loopFlash() {
					drawFlashFrame();
					rafId = requestAnimationFrame(loopFlash);
				}

				function stopFlash() {
					if (rafId) {
						cancelAnimationFrame(rafId);
						rafId = null;
					}
				}

				async function enterFullscreen() {
					var el = a.fixScreen;
					var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent)
						|| (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

					if (!isIOS) {
						if (el.requestFullscreen) {
							await el.requestFullscreen();
						} else if (el.webkitRequestFullscreen) {
							await el.webkitRequestFullscreen();
						}
						return;
					}

					document.documentElement.classList.add('ios-fullscreen-fix');
					window.scrollTo(0, 1);
				}

				function closeFixTool() {
					stopFlash();
					clearHintFadeTimer();
					if (document.exitFullscreen) {
						document.exitFullscreen();
					} else if (document.webkitExitFullscreen) {
						document.webkitExitFullscreen();
					}
					document.documentElement.classList.remove('ios-fullscreen-fix');
					document.body.style.overflow = '';
					a.fixScreen.classList.remove('controls-bottom');
					a.fixScreen.style.display = 'none';
					a.startBtn.style.display = 'block';
					a.patch.classList.remove('dragging');
					dragging = false;
					a.patch.style.left = '50%';
					a.patch.style.top = '50%';
					a.patch.style.marginLeft = '';
					a.patch.style.marginTop = '';
					if (a.fixHint) {
						a.fixHint.classList.remove('is-visible', 'is-faded', 'arrow-right');
					}
					layoutPatch();
				}

				function showControls() {
					controls.forEach(function (el) {
						if (el) el.classList.remove('hidden');
					});
				}

				function hideControls() {
					if (!isHoveringControl) {
						controls.forEach(function (el) {
							if (el) el.classList.add('hidden');
						});
					}
				}

				function resetHideTimer() {
					showControls();
					if (hideTimer) clearTimeout(hideTimer);
					hideTimer = setTimeout(hideControls, 500);
				}

				function clientPoint(e) {
					if (e.touches && e.touches.length) {
						return { x: e.touches[0].clientX, y: e.touches[0].clientY };
					}
					return { x: e.clientX, y: e.clientY };
				}

				function startDrag(e) {
					if (e.target === a.exitBtn || (a.exitBtn && a.exitBtn.contains(e.target))) {
						return;
					}
					e.preventDefault();
					dragging = true;
					a.patch.classList.add('dragging');
					var p = clientPoint(e);
					var rect = a.patch.getBoundingClientRect();
					var parent = a.fixScreen.getBoundingClientRect();
					var pw = rect.width || a.patch.offsetWidth;
					var ph = rect.height || a.patch.offsetHeight;
					dragOffsetX = p.x - rect.left;
					dragOffsetY = p.y - rect.top;
					var relLeft = rect.left - parent.left;
					var relTop = rect.top - parent.top;
					var clamped = clampPatchPosition(parent, pw, ph, relLeft, relTop);
					a.patch.style.left = clamped.x + 'px';
					a.patch.style.top = clamped.y + 'px';
					a.patch.style.marginLeft = '0';
					a.patch.style.marginTop = '0';
					a.patch.style.transform = 'none';
				}

				function moveDrag(e) {
					if (!dragging) return;
					e.preventDefault();
					var p = clientPoint(e);
					var parent = a.fixScreen.getBoundingClientRect();
					var rect = a.patch.getBoundingClientRect();
					var pw = rect.width || a.patch.offsetWidth;
					var ph = rect.height || a.patch.offsetHeight;
					var x = p.x - dragOffsetX - parent.left;
					var y = p.y - dragOffsetY - parent.top;
					var clamped = clampPatchPosition(parent, pw, ph, x, y);
					a.patch.style.left = clamped.x + 'px';
					a.patch.style.top = clamped.y + 'px';
					if (!hasMovedPatch) hasMovedPatch = true;
					updateControlPlacement();
					positionHint();
				}

				function endDrag() {
					dragging = false;
					a.patch.classList.remove('dragging');
				}

				function startFix() {
					a.startBtn.style.display = 'none';
					a.fixScreen.style.display = 'block';
					document.body.style.overflow = 'hidden';
					hasMovedPatch = false;
					layoutPatch();
					a.patch.style.left = '50%';
					a.patch.style.top = '50%';
					a.patch.style.marginLeft = (-patchSize() / 2) + 'px';
					a.patch.style.marginTop = (-patchSize() / 2) + 'px';
					loopFlash();
					updateControlPlacement();
					showHintTemporarily();
					resetHideTimer();
				}

				a.exitBtn.addEventListener('click', closeFixTool);
				a.fullscreenBtn.addEventListener('click', function () {
					captureRelativePosition();
					if (document.fullscreenElement) {
						if (document.exitFullscreen) {
							document.exitFullscreen();
						} else if (document.webkitExitFullscreen) {
							document.webkitExitFullscreen();
						}
					} else {
						enterFullscreen().then(function () {
							refreshPatchAfterViewportChange(true);
							resetHideTimer();
						});
					}
				});

				document.addEventListener('keydown', function (e) {
					if (a.fixScreen.style.display !== 'block' || e.key !== 'Escape') return;
					if (document.fullscreenElement) {
						if (document.exitFullscreen) {
							document.exitFullscreen();
						} else if (document.webkitExitFullscreen) {
							document.webkitExitFullscreen();
						}
						return;
					}
					if (document.documentElement.classList.contains('ios-fullscreen-fix')) {
						document.documentElement.classList.remove('ios-fullscreen-fix');
						if (a.fullscreenBtn) {
							a.fullscreenBtn.src = '<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Expand1.svg';
						}
						refreshPatchAfterViewportChange(true);
						return;
					}
					e.preventDefault();
					closeFixTool();
				});

				a.fixScreen.addEventListener('mousemove', resetHideTimer);
				a.fixScreen.addEventListener('touchstart', resetHideTimer, { passive: true });

				controls.forEach(function (el) {
					if (!el) return;
					el.addEventListener('mouseenter', function () {
						isHoveringControl = true;
						showControls();
						if (hideTimer) clearTimeout(hideTimer);
					});
					el.addEventListener('mouseleave', function () {
						isHoveringControl = false;
						resetHideTimer();
					});
				});

				a.patch.addEventListener('mousedown', startDrag);
				document.addEventListener('mousemove', moveDrag);
				document.addEventListener('mouseup', endDrag);
				a.patch.addEventListener('touchstart', startDrag, { passive: false });
				document.addEventListener('touchmove', moveDrag, { passive: false });
				document.addEventListener('touchend', endDrag);
				document.addEventListener('touchcancel', endDrag);

				a.startBtn.addEventListener('click', startFix);

				window.addEventListener('resize', function () {
					if (a.fixScreen.style.display === 'block') {
						captureRelativePosition();
						refreshPatchAfterViewportChange(true);
					}
				});

				document.addEventListener('fullscreenchange', function () {
					if (!document.fullscreenElement) {
						document.documentElement.classList.remove('ios-fullscreen-fix');
						if (a.fullscreenBtn) {
							a.fullscreenBtn.src = '<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Expand1.svg';
						}
						if (a.fixScreen.style.display !== 'block') {
							document.body.style.overflow = '';
						}
					} else if (a.fullscreenBtn) {
						a.fullscreenBtn.src = '<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Expand2.svg';
					}
					if (a.fixScreen.style.display === 'block') {
						refreshPatchAfterViewportChange(true);
					}
				});
			});
		};

		a.main();
	})();
</script>

<?php get_footer();
