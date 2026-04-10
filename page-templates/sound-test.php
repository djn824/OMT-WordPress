<?php /* Template Name: Sound*/
get_header();?>

<div class="google-adds-1">
	<div align="center">
		<style>
			.OMT_MOINSBD_Header { width: 320px; height: 100px; }
			@media(min-width: 500px) { .OMT_MOINSBD_Header { width: 468px; height: 60px; } }
			@media(min-width: 800px) { .OMT_MOINSBD_Header { width: 970px; height: 90px; } }
		</style>
	</div>
</div>

<div class="pd-1">
	<div class="sound-test-section">
		<div class="sound-content">
			<div class="sound-content-2 pd-1">
				<div id="speakers-test">
									            <!-- <audio src="/sound.mp3"></audio>
									            	<canvas width="200" height="200" style="float: right;"></canvas> -->
									            </div>
									        </div>
									    </div>
									</div>
								</div>

								<div class="advertising_banner">
									<div align="center">
										<style>
											.OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }
											@media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }
											@media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }
										</style>
									</div>
								</div>

								<div class="keyboard-test sound-test">
									<div class="keyboard-test-info dis-flex">
										<div class="keyboard-info-1 wid-xs-100">
											<div class="keyboard-info-1-img">
												<img alt="" width="100" height="67" title="keyboard icon" src="<?php the_field('leftside_sound_image');?>">
											</div>
											<div class="keyboard-info-1-title">
												<div class="pd-1">
													<h3><?php the_field('leftside_title');?></h3>
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
																	<?php the_sub_field('descp');?>
																</span>
															</li>
														<?php endwhile;
													else :
													endif;
													?>
												<!-- <li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														Want to check if you can hear <strong>stereo</strong> (two different audio channels, one coming from the left speaker and one from the right)? <strong>Use this sound test to quickly find out</strong>, without leaving the browser.
													</span>
												</li>
												<li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														
													</span>
												</li> -->
											</ul>
										</div>
									</div>
								</div>
								
								<div class="ct-row mic-settings-title" style="margin-top:50px; margin-bottom:20px;">
									<span><?php the_field('links_title');?></span>
								</div>
								<div class="mic-settings-section">
									<div class="mic-settings-menu width-50 wid-md-100">
										<ul>
											<?php

													// check if the repeater field has rows of data
											if( have_rows('links_table') ):

														// loop through the rows of data
												while ( have_rows('links_table') ) : the_row();?>
													<li class="dis-flex">
														<div class="mic-menu-icon">
															<img alt="" width="30" height="20" title="keyboard icon" src="<?php the_field('leftside_sound_image');?>">
														</div>
														<div>
															<a href="<?php the_sub_field('url');?>" style="margin-left:20px;">
																<?php the_sub_field('link_description');?></a>
															</div>

														</li>
													<?php endwhile;
												else :
												endif;
												?>
											</ul>
										</div>
									</div>


									<div class="keyboard-test-info dis-flex">
										<div class="keyboard-info-1 wid-xs-100">
											<div class="keyboard-info-1-title">
												<div class="pd-1">
													<h3><?php the_field('leftside_title_');?></h3>
												</div>
											</div>
										</div>
										<div class="keyboard-info-2 wid-xs-100">
											<div class="keyboard-info-2-text">
												<ul>
													<?php

												// check if the repeater field has rows of data
													if( have_rows('rightside_desc2') ):

												 	// loop through the rows of data
														while ( have_rows('rightside_desc2') ) : the_row();?>
															<li class="dis-flex">
																<div class="keyboard-list-icon">
																	<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
																		<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
																	</svg>
																</div>
																<span class="keyboard-list-text">
																	<?php the_sub_field('rightside-desc');?>
																</span>
															</li>
														<?php endwhile;
													else :
													endif;
													?>
												<!-- <li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														Make sure that your speakers are connected to electricity and <strong>powered on</strong>.
													</span>
												</li>
												<li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														Make sure that the speakers are connected to the back of your computer – to the green jack.
													</span>
												</li>
												<li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														Check that <strong>volume in your operating system isn’t turned all the way down</strong>, and if you have a laptop – that the volume on your laptop (it should be set by a physical button) isn’t turned all the way down. In fact, turn the volume all the way up just for checking: your speakers might be working but playing weak sound.
													</span>
												</li>
												<li class="dis-flex">
													<div class="keyboard-list-icon">
														<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
															<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
														</svg>
													</div>
													<span class="keyboard-list-text">
														Make sure that the correct playback device is enabled in your operating system. The operating system might be trying to play the test audio through a different device or jack.
													</span>
												</li> -->
											</ul>
										</div>
									</div>
								</div>

								<div class="keyboard-test-info dis-flex">
									<div class="keyboard-info-1 wid-xs-100">
										<div class="keyboard-info-1-title">
											<div class="pd-1">
												<h3>
													<?php the_field('leftside_title3');?>
												</h3>
											</div>
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
														<?php the_field('rightside_desc3');?>
													</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								
								<div class="keyboard-test-info dis-flex">
									<div class="keyboard-info-1 wid-xs-100">
										<div class="keyboard-info-1-title">
											<?php if(get_field('leftside_desc_option')==true){?>
												<div class="pd-1">
													<h3>
														<?php the_field('leftside_title4');?>
													</h3>
												</div>
											<?php }else{}?>
										</div>
									</div>
									<div class="keyboard-info-2 wid-xs-100">
										<div class="keyboard-info-2-text">
											<ul>
												<?php if(get_field('the_sample_title_option')==true){?>
													<li class="dis-flex">
														<div class="keyboard-list-icon">
															<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
																<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
															</svg>
														</div>
														<span class="keyboard-list-text">
															
															<?php the_field('leftside_desc');?>
															
															<?php if(get_field('keyboard_list_option')==true){?>
																<ol style="margin-top:20px;">
																	<?php

												// check if the repeater field has rows of data
																	if( have_rows('keyboard_list') ):

												 	// loop through the rows of data
																		while ( have_rows('keyboard_list') ) : the_row();?>
																			<li><a href="<?php the_sub_field('link');?>"><?php the_sub_field('title');?></a></li>
																		<?php endwhile;
																	else :
																	endif;
																	?>
														   <!--  <li><a href="https://www.asus.com/support/Download-Center/">Asus</a></li>
														    <li><a href="https://www.evga.com/support/download/">EVGA</a></li>
														    <li><a href="https://customer.focusrite.com/support/downloads">Focusrite</a></li> -->
														</ol>
													<?php }else{}?>
												</span>
											</li>
										<?php }else{}?>
									</ul>
								</div>
							</div>
						</div>

					</div>


					<div class="sound-created-by clearfix">
						<div class="sound-created-text pd-1">
							<p><?php the_field('the_sample_title');?></p>
						</div>
						<div class="sound-created-button pd-1">
							<a href="<?php the_field('button_link');?>" target="_blank"><?php the_field('bottom_button_title');?></a>
						</div>
					</div>

				</div>
			</div>
		</article>
	</div>
</div>


<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/SpeakersTest.js"></script>
<?php
get_footer();