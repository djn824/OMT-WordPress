<?php
    /* Template Name:Dead Pixel Test */
get_header();

$test_btn_width = '180px';
if (function_exists('pll_current_language')) {
	$lang = pll_current_language();
	if ($lang === 'fr' || $lang === 'vi') {
		$test_btn_width = '300px';
	}
}
?>
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
		padding: 6px 16px;
		width: <?php echo esc_attr($test_btn_width); ?>;
		height: 50px;
		white-space: nowrap;
		font-size: 24px;
  	}

	.test-btn:hover {
		background-color: #e25d26dd;
	}

	.control {
		position: absolute;
      	background: rgba(255, 255, 255, 0.8);
      	border-radius: 50%;
      	width: 40px;
      	height: 40px;
      	display: flex;
      	justify-content: center;
      	align-items: center;
      	font-size: 1.5rem;
      	cursor: pointer;
      	user-select: none;
		transition: opacity 0.3s ease;
    }

	#colorName {
		white-space: nowrap;
		top: 70px;
		left: 50%;
		transform: translateX(-50%);
		font-size: 32px;
		font-weight: 700;
		position: absolute;
      	display: flex;
      	justify-content: center;
      	align-items: center;
      	user-select: none;
		color: #ffffff;
/* 		background: #ffffff;
		border-radius: 5px;
		padding: 5px; */
	}

    #exitBtn {
      	top: 15px;
      	right: 15px;
    }

    #prevBtn {
      	left: 15px;
      	top: 50%;
      	transform: translateY(-50%);
    }

    #nextBtn {
      	right: 15px;
      	top: 50%;
      	transform: translateY(-50%);
    }

    #colorPalette {
      	position: absolute;
      	bottom: 20px;
      	left: 50%;
      	transform: translateX(-50%);
      	display: flex;
      	gap: 10px;
      	background: rgba(255, 255, 255, 0.1);
      	padding: 10px 15px;
      	border-radius: 10px;
		transition: opacity 0.3s ease;
		max-width: 90vw;          /* prevents overflow on mobile */
		overflow-x: auto;         /* enables scrolling */
		overflow-y: hidden;
		white-space: nowrap;
		scrollbar-width: none;    /* Firefox: hide scrollbar */
    }

	/* Chrome/Safari: hide scrollbar */
	#colorPalette::-webkit-scrollbar {
		display: none;
	}

    .color-btn {
      	width: 40px;
      	height: 40px;
      	border: 2px solid white;
      	border-radius: 5px;
      	cursor: pointer;
		flex: 0 0 auto;       /* prevent shrinking */
    }

    .color-btn.active {
      	box-shadow: 0 0 10px 3px white;
    }

	.hidden {
		opacity: 0;
		pointer-events: none;
	}

	#test-screen {
		position: relative;
		display: none;
		width: 100vw;
		height: 100vw;
	}

html, body {
    margin: 0;
    padding: 0;
}

.ios-fullscreen-fix,
.ios-fullscreen-fix body,
.ios-fullscreen-fix #test-screen {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    overflow: hidden !important;
    background: black;
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

	<div id="test-screen">
		<div id='colorName'></div>
		<div id="exitBtn" class="control">✕</div>
		<div id="prevBtn" class="control">❮</div>
		<div id="nextBtn" class="control">❯</div>
		<div id="colorPalette"></div>
	</div>
</div>
</div>
</div>
</article>
</div>
</div>

<script>
	(function () {
		<?php
		$colors_arr = [];
		$color_names_arr = [];
		$font_colors_arr = [];
		if (have_rows('color_values')):
			while (have_rows('color_values')): the_row();
				$colors_arr[] = get_sub_field('color');
				$color_names_arr[] = get_sub_field('label');
				$font_colors_arr[] = get_sub_field('font_color');
			endwhile;
		endif;
		?>
		let colors = <?php echo wp_json_encode($colors_arr); ?>;
		let colorNames = <?php echo wp_json_encode($color_names_arr); ?>;
		let fontColors = <?php echo wp_json_encode($font_colors_arr); ?>;
		let index = 0;
		let hideTimer = null;
		let isHoveringControl = false;

		var a = function(){};
		a__name__=!0;

		a.main = function() {
			window.addEventListener('DOMContentLoaded', function() {
				a.startBtn = window.document.getElementById('test-btn');
				a.testScreen = window.document.getElementById('test-screen');
				a.exitBtn = window.document.getElementById("exitBtn");
				a.prevBtn = window.document.getElementById('prevBtn');
				a.nextBtn = window.document.getElementById('nextBtn');
				a.colorPalette = window.document.getElementById('colorPalette');
				a.colorNames = window.document.getElementById('colorName');

				const controls = [a.exitBtn, a.prevBtn, a.nextBtn, a.colorPalette, a.colorNames];

				colors.forEach((color, i) => {
					const btn = document.createElement("div");
				  	btn.classList.add("color-btn");
				  	btn.style.backgroundColor = color;
				  	btn.addEventListener("click", () => {
						index = i-1;
						showColor();
				  	});
				  	a.colorPalette.appendChild(btn);
				});

				a.colorBtns = window.document.querySelectorAll(".color-btn");

				// async function enterFullscreen() {
				// 	if(a.testScreen.requestFullscreen) {
				// 		await a.testScreen.requestFullscreen();
				// 	} else if (a.testScreen.webkitRequestFullscreen) {
				// 		await a.testScreen.webkitRequestFullscreen();
				// 	}
				// }
                
				async function enterFullscreen() {
					const el = a.testScreen;

					// Detect iPhone / iOS Safari
					const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) 
								|| (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

					if (!isIOS) {
						// ANDROID or Desktop → Fullscreen API works
						if (el.requestFullscreen) {
							await el.requestFullscreen();
						} else if (el.webkitRequestFullscreen) {
							await el.webkitRequestFullscreen();
						}
						return;
					}

					// iPHONE FALLBACK → forced CSS fullscreen
					document.documentElement.classList.add('ios-fullscreen-fix');
					window.scrollTo(0, 1);
				}

				function scrollToSelectedColor(id) {
					const selected = a.colorBtns[id];
					const palette = a.colorPalette;

					if (!selected) return;

					// Scroll so the selected color is centered
				  	const offset = selected.offsetLeft - palette.clientWidth / 2 + selected.clientWidth / 2;

					palette.scrollTo({
						left: offset,
						behavior: "smooth",
					});
				}

				function showColor() {
// 					if (index < 0) index = colors.length - 1;
					if (index >= colors.length) index = 0;
					if (index == -2) index = colors.length - 2;
					if (index == -1) index = colors.length - 1;
      				a.testScreen.style.backgroundColor = colors[index];
					a.colorNames.innerHTML = colorNames[index];
      				a.colorBtns.forEach((btn, i) => {
        				btn.classList.toggle("active", i === index);
      				});
					a.colorNames.style.color = fontColors[index];

					scrollToSelectedColor(index);
// 					if(index >= colors.length) {
// 						exitFullscreen();
// 						return;
// 					}
// 					a.testScreen.style.backgroundColor = colors[index];
// 					index++;
				}

				function startTest() {
					a.startBtn.style.display = 'none';
					a.testScreen.style.display = 'block';
					index = 0;
					enterFullscreen().then(() => {
						showColor();
						resetHideTimer();
					});
				}

				function exitFullscreen() {
					if(window.document.exitFullscreen) {
						window.document.exitFullscreen();
					} else if (window.document.webkitExitFullscreen) {
						window.document.webkitExitFullscreen();
					}
					a.testScreen.style.display = 'none';
					a.startBtn.style.display = 'block';
				}

				a.prevBtn.addEventListener("click", () => {
      				index-=2;
      				showColor();
    			});

    			a.nextBtn.addEventListener("click", () => {
//       				index++;
//       				showColor();
    			});

    			a.exitBtn.addEventListener("click", exitFullscreen);

				// Keyboard shortcuts
				window.document.addEventListener("keydown", (e) => {
					if (e.key === "ArrowLeft") index--;
				  	else if (e.key === "ArrowRight") index++;
				  	else if (e.key === "Escape") exitFullscreen();
				  	showColor();
				});

				// --- Mouse movement hiding system ---
				function showControls() {
					controls.forEach((el) => el.classList.remove("hidden"));
				}

				function hideControls() {
					if (!isHoveringControl) {
						controls.forEach((el) => el.classList.add("hidden"));
				  	}
				}

				function resetHideTimer() {
					showControls();
				  	if (hideTimer) clearTimeout(hideTimer);
				  	hideTimer = setTimeout(hideControls, 500);
				}

				a.testScreen.addEventListener("mousemove", resetHideTimer);

				a.testScreen.addEventListener('click', () => {
					index++;
					showColor();
				});

				a.startBtn.addEventListener('click', startTest);

				window.document.addEventListener('fullscreenchange', () => {
					if(!window.document.fullscreenElement) {
						a.testScreen.style.display = 'none';
						a.startBtn.style.display = 'block';
					}
				});

				controls.forEach((el) => {
					el.addEventListener("mouseenter", () => {
						isHoveringControl = true;
						showControls();
						if (hideTimer) clearTimeout(hideTimer);
				  	});
				  	el.addEventListener("mouseleave", () => {
						isHoveringControl = false;
						resetHideTimer();
				  	});
				});
			});
		}

		a.main();
	})();
</script>

<?php get_footer();