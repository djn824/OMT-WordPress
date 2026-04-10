<?php /*Template Name:Keyboard*/
get_header('keyboard');
?>

							<div class="keyboard-section">
								<div id="tve_flt" class="tve_flt">
									<div id="tve_editor" class="tve_shortcode_editor">
										<div class="thrv_wrapper thrv_contentbox_shortcode thrv-content-box">
											<div class="tve-content-box-background"></div>
											<div class="tve-cb tve_empty_dropzone" data-css="tve-u-161806d1600">
												<div class="thrv_wrapper thrv_contentbox_shortcode thrv-content-box" data-css="tve-u-1618570d285">
													<div class="tve-content-box-background"></div>
													<div class="tve-cb tve_empty_dropzone" data-css="tve-u-16185479c93">
														<div class="thrv_wrapper thrv_custom_html_shortcode" data-css="tve-u-161806d41a7">
															<code class="tve_js_placeholder">
																<script>
																	jQuery(function(){
																		$.keyboard.layouts.numpad = {
																			'normal': [
																			'{clear} / * -',
																			'7 8 9 +',
																			'4 5 6 %',
																			'1 2 3 =',
																			'0 . {left} {right}'
																			]
																		};
																		$('#keyboard').keyboard({
																			appendTo: '.tve-content-box-background',
																			alwaysOpen: true,
																			autoAccept: true,
																			layout: 'custom',
																			toggleMode : true,
																			enterNavigation: false,
																			customLayout : {
																				'normal': [
																					'ESC F1 F2 F3 F4 F5 F6 F7 F8 F9 F10 F11 F12 prtSc Home',
																					'` 1 2 3 4 5 6 7 8 9 0 - = {bksp} Ins PgUp',
																					'{tab} q w e r t y u i o p [ ] \\ {del} PgDn',
																					'Caps a s d f g h j k l ; \' {enter} &uarr; Pause',
																					'{shift} z x c v b n m , . / {shift} {left} &darr; {right}',
																					'Ctrl {alt} {space} {alt} Ctrl NmLk ScrlLk',
																					'{mouseleft}'
																				],
																			},
																			display : {
																				'extender' : ' :toggle_numpad'
																			}
																		}).addTyping({showTyping: true, hoverDelay: 100000000000000000})
																		.addExtender({
																			layout     : 'numpad',
																			showing    : true,
																			reposition : true
																		});
																		$(".ui-keyboard-extender").addClass("ui-keyboard-keyset");
																		let key_press_status;
																		$(document).on('keypress', function (e) {
																			var y = e.which;
																			var x = String.fromCharCode(y) || y;
																			if((0 <= x && x <= 9) || y == 45){
																				var el = $(".ui-keyboard-keyset-normal .ui-keyboard-" + x);
																				if(y != 45 && el.hasClass("ui-state-hover")){
																					el.removeClass("ui-state-hover");
																					if(el.attr("style")){
																						el.addClass("ui-state-hover");
																					}
																				}
																			}else if(y == 47 || y == 46 || y == 42 || y == 43 || y == 37 || y == 61){
																				$(".ui-keyboard-extender .ui-keyboard-" + y).addClass("ui-state-hover");
																			}
																			
																		});
																		$(document).keydown(function(e){
																			var z = String.fromCharCode(e.which);
																			key_press_status = true;
																			if(e.which === 18 || e.which === 32) { 
																				e.preventDefault();
																			}
																			if(e.which === 27) {
																				let keyboard = $(".ui-keyboard");
																				keyboard.slice(2).remove(); 
																			}
																			if(e.which == 33){
																				$(".ui-keyboard-PgUp").addClass("ui-state-hover");
																			}else if(e.which == 34){
																				$(".ui-keyboard-PgDn").addClass("ui-state-hover");
																			}else if(0 <= z && z<= 9){
																				$(".ui-keyboard-keyset-normal .ui-keyboard-" + z).addClass("ui-state-hover").css('background', '#c5dbec');
																			}
																			$(".ui-keyboard-button.ui-state-hover").hover(function(){
																				// $(this).removeAttr("style");
																			}, function(){
																				$(this).addClass("ui-state-hover");
																			});
																		});
																		$(document).keyup(function(e){
																			key_press_status = false;
																			if(e.which == 44){
																				$(".ui-keyboard-prtSc").addClass("ui-state-hover");
																			}
																		});
																			
																		let endrow = $('.ui-keyboard-button-endrow').eq(12);
																		let mouseLeft = `<button role="button" type="button" aria-disabled="false" tabindex="-1" id="mouseLeft" class="ui-keyboard-button ui-keyboard-MouseLeft ui-keyboard-widekey ui-state-default ui-corner-all" data-value="mouseLeft" data-name="mouseLeft" data-pos="6,1" data-html="<span class=&quot;ui-keyboard-text&quot;>&nbsp;</span>" title="mouseLeft"><span class="ui-keyboard-text">&nbsp;</span></button>`;
																		let mouseMiddle = `<button role="button" type="button" aria-disabled="false" tabindex="-1" id="mouseMiddle" class="ui-keyboard-button ui-keyboard-widekey ui-state-default ui-corner-all ui-keyboard-MouseMiddle" data-value="mouseMiddle" data-name="mouseMiddle" data-pos="6,2" data-html="<span class=&quot;ui-keyboard-text&quot;></span>" title="mouseMiddle"><span class="ui-keyboard-text"></span></button>`;
																		let mouseRight = `<button role="button" type="button" aria-disabled="false" tabindex="-1" id="mouseRight" class="ui-keyboard-button ui-keyboard-MouseRight ui-keyboard-widekey ui-state-default ui-corner-all" data-value="mouseRight" data-name="mouseRight" data-pos="6,3" data-html="<span class=&quot;ui-keyboard-text&quot;>&nbsp;</span>" title="mouseRight"><span class="ui-keyboard-text">&nbsp;</span></button>`;
																		
																		let keyType = ['Left', 'Middle', 'Right'];
																		
																		$(endrow).after(mouseLeft, mouseMiddle, mouseRight);
																		$(document).ready(() => {
																			$(document).contextmenu(function() {
																				return false;
																			});
																			$(".ui-keyboard").off('mousedown').on('mousedown', function(e) {
																			});
																			$(document).on('mousedown', (e) => {
																				let id = "#mouse" + keyType[e.which - 1];
																				if(e.which === 2) {
																					event.preventDefault();
																				}
																				$(id).addClass("keydown_press");
																			});
																			$(document).on('mouseup', (e) => {
																				let id = "#mouse" + keyType[e.which - 1];
																				$(id).removeClass("keydown_press");
																				$(id).addClass("ui-state-hover");
																			});
																		});
																	});
																</script>
															</code>
															<div id="wrap">
																<textarea id="keyboard" rows="1"></textarea>
															</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="keyboard-test-info dis-flex">
								<div class="keyboard-info-1 wid-xs-100">
									<div class="keyboard-info-1-img">
										<img alt="" width="100" height="67" title="keyboard icon" src="<?php the_field('leftside_keyboard_icon');?>">
									</div>
									<div class="keyboard-info-1-title">
										<div class="pd-1">
											<h3><?php the_field('leftside_keyboard_info_title1');?></h3>
										</div>
									</div>
								</div>
								<div class="keyboard-info-2 wid-xs-100">
									<div class="keyboard-info-2-text">
										<ul>
											<?php

									// check if the repeater field has rows of data
									if( have_rows('rightside_desc') ):

									 	// loop through the rows of data
									    while ( have_rows('rightside_desc') ) : the_row();?>
											<li class="dis-flex">
												<div class="keyboard-list-icon">
													<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
														<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
													</svg>
												</div>
												<span class="keyboard-list-text">
													<?php the_sub_field('desc');?>
												</span>
											</li>
											<?php 
														endwhile;
														else :
														endif;
														?>
											<!-- <li class="dis-flex">
												<div class="keyboard-list-icon">
													<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
														<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
													</svg>
												</div>
												<span class="keyboard-list-text"><strong>Go over all the keys</strong> to make sure that they all work.</span>
											</li>
											<li class="dis-flex">
												<div class="keyboard-list-icon">
													<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
														<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
													</svg>
												</div>
												<span class="keyboard-list-text">
													If the entire virtual keyboard lights up (or at least all the keys that you have on your physical keyboard) then - <strong>hooray - that means your keyboard has passed the test!</strong>
												</span>
											</li> -->
										</ul>
									</div>
								</div>
							</div>

								<?php

								// check if the repeater field has rows of data
								if( have_rows('keyboard_info') ):

								// loop through the rows of data
								while ( have_rows('keyboard_info') ) : the_row();?>
								<div class="keyboard-test-info dis-flex">
									<div class="keyboard-info-1 wid-xs-100">
										<div class="keyboard-info-1-title">
											<h3><?php the_sub_field('left_title');?></h3>
										</div>
									</div>
									<div class="keyboard-info-2 wid-xs-100">
										<div class="keyboard-info-2-text">
											<ul>
												<li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														<?php the_sub_field('right_desc');?>
													</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<?php 
								endwhile;
								else :
								endif;
								?>
								

						</div>

                        <?php get_template_part('template-parts/guides/trouble-shooting') ?>
					</div>
					</div>
				</article>
			</div>
		</div>
		</div>
	
	<?php get_footer('2');?>