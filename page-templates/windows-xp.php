<?php /*Template Name:Window- Xp*/
get_header();?>
<div class="published-date">
	Updated <?php echo get_the_date();?>
</div>
<div class="ads-margin-30">
	<div align="center">
		<style>
			.OMT_MOINSBD_Header { width: 320px; height: 100px; }
			@media(min-width: 500px) { .OMT_MOINSBD_Header { width: 468px; height: 60px; } }
			@media(min-width: 800px) { .OMT_MOINSBD_Header { width: 970px; height: 90px; } }
		</style>
	</div>
</div>

<div class="windows-xp-section">
	<div class="mic_setting_blue">
		<div class="mic_setting_info">
			<div class="mic_setting_info_title">
				<div class="pd-1">
					<h3>
						<?php the_field('here’s_how_to_set_title');?>
					</h3>
				</div>
			</div>
			<div class="mic_setting_info_content">
				<div class="windows-vista-content">
					<div class="info_container">
						<?php
						$i=0;
						$j=['_first_','','','','','',''];
						?>
						<?php

						// check if the repeater field has rows of data
						if( have_rows('here’s_how_to_set_steps') ):

							// loop through the rows of data
							while ( have_rows('here’s_how_to_set_steps') ) : the_row();?>
								<div class="mic_setting_steps <?php echo $j[$i];?>">
									<div class="dis-flex dis-block-xs clearfix">
										<div class="width-50 wid-xs-100 step_half">
											<div class="flex_col">
												<div class="justify_col">
													<p> <?php the_sub_field('steps');?></p>
												</div>
											</div>
										</div>
										<div class="width-50 wid-xs-100 step_half">
											<div class="flex_col">
												<div class="justify_col">
													<img class="tve_image win-xp" alt="<?php the_sub_field('image_alt');?>" src="<?php the_sub_field('rightside_images');?>" width="100%" height="<?php the_sub_field('image_height');?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php 
								$i++;
							endwhile;
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
</article>
</div>
</div>

<div class="content-section bSe fullWidth">
	<article style="padding-top: 0;">
		<div id="dontHaveMicOption" class="mic_setting_blue">
			<div class="mic_setting_info">
				<div class="mic_setting_info_title">
					<div class="pd-1">
						<h3>
							<?php the_field('what_to_do_if_you_don’t_see_title');?>
						</h3>
					</div>
				</div>
				<div class="mic_setting_info_content">
					<div class="windows-vista-content">
						<div class="info_container">
							<?php
							$class=0;
							$add=['_first_','','','','']?>
							<?php

					// check if the repeater field has rows of data
							if( have_rows('what_to_do_if_you_don’t_see_steps') ):

						// loop through the rows of data
								while ( have_rows('what_to_do_if_you_don’t_see_steps') ) : the_row();?>
									<div class="mic_setting_steps <?php echo $add['$class'];?>">
										<div class="dis-flex dis-block-xs clearfix">
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
													<div class="justify_col">
														<p><?php the_sub_field('leftside_steps');?></p>
													</div>
												</div>
											</div>
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
													<div class="justify_col">
														<img class="tve_image" alt="<?php the_sub_field('image_alt-');?>" style="width: 212px" src="<?php the_sub_field('rightside_imags_');?>" width="100%" height="<?php the_sub_field('image_height');?>">
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
									$class++;
								endwhile;
							else :
							endif;
							?>

							<div class="ads-margin-30 mar-bot-0">
								<div align="center">
									<style>
										.OMT_MOINSBD_End { width: 300px; height: 250px; }
										@media(min-width: 500px) { .OMT_MOINSBD_End { width: 336px; height: 280px; } }
										@media(min-width: 800px) { .OMT_MOINSBD_End { width: 970px; height: 90px; } }
									</style>
								</div>
							</div>

							<div class="clearfix">
								<div class="width-100 step_half mar-top-0">
									<div class="flex_col pad-left-0">
										<div class="justify_col">
											<?php the_field('step-4-5');?>

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

<div class="content-section bSe fullWidth">
	<article style="padding-top: 0;">
		<div id="furtherSteps" class="mic_setting_blue">
			<div class="mic_setting_info">
				<div class="mic_setting_info_title">
					<div class="pd-1">
						<h3>
							<?php the_field('what_to_do_if_your_problem_title');?>
						</h3>
					</div>
				</div>
				<div class="mic_setting_info_content">
					<div class="info_container">
						<div class="mic_setting_steps _last_">
							<p><?php the_field('steps1');?></p>
							<div class="dis-flex dis-block-xs clearfix">
								<div class="width-50 wid-xs-100 step_half">
									<div class="flex_col">
										<div class="justify_col">
											<p><?php the_field('step2__title');?></p>
										</div>
									</div>
								</div>
								<div class="width-50 wid-xs-100 step_half">
									<div class="flex_col">
										<div class="justify_col">
											<img class="lazyload" src="<?php the_field('step2__image');?>" data-src="<?php the_field('step2__image');?>" style="width: 365px;" alt="Checking that Microphone is marked" onerror="this.style.display='none'">
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php the_field('step3-4-5');?>
					</div>
				</div>
				<div class="ads-margin-30">
					<div align="center">
					</div>
				</div>
			</div>
		</div>
	</article>
</div>

<div class="content-section bSe fullWidth">
	<article style="padding-top: 0;">
		<div class="_accordion pd-1">
			<div class="tve_faq">
				<div class="tve_faqI">
					<div class="tve_faqB">
						<span class="tve_not_editable tve_toggle"></span>
						<h4>
							<span class="bold_text ttfm1 ttfm4">
								<span class="tve_custom_font_size">
									<?php the_field('what_to_do_if_your_problem_still_isn’t_solved_title');?>
								</span>
							</span>
						</h4>
					</div>
					<div class="tve_faqC tve_empty_dropzone" style="display: none;">
						<div class="thrv_paste_content thrv_wrapper tve_empty_dropzone">
							<div class="thrv_wrapper thrv_text_element tve_empty_dropzone">
								<p class="tve_p_left ttfm4" style="font-size: 18px; color: rgb(155, 157, 165); margin-bottom: 0px ! important; padding-top: 9px ! important; margin-left: 0px;">
									<span class="bold_text">
										</span><?php the_field('if_the_problem_still_isn’t_solved_title');?>
										<a href="<?php echo get_site_url();?>/microphone-settings/windows-xp/#selectTheMicrophoneStep" class="">
										</a>
										<br>
									</p>
									<?php

							// check if the repeater field has rows of data
									if( have_rows('what_to_do_if_your_problem_still_isn’t_solved') ):

								// loop through the rows of data
										while ( have_rows('what_to_do_if_your_problem_still_isn’t_solved') ) : the_row();?>
											<p class="tve_p_left ttfm6" data-unit="px" style="font-size: 20px; color: rgb(127, 130, 143); line-height: 22px; margin-bottom: 0px !important; padding-top: 9px !important; margin-left: 20px !important;">
												<span class="tve_custom_font_size" style="font-size: 25px;"><strong>
													<span class="tve_custom_font_size" style="font-size: 25px;">
														<span class="tve_custom_font_size" style="font-size: 16px;">
															<font color="#7f828f">
																<span class="bold_text"></span>
																<?php the_sub_field('tips');?>
															</font>
														</span>
													</span>
												</strong>
											</span>
										</p>
										<div class="thrv_wrapper" style="margin-top: 0px !important; margin-bottom: 0px !important;">
											<hr class="tve_sep tve_sep1">
										</div>
										<?php 
									endwhile;
								else :
								endif;
								?>
							</div>
							<div class="thrv_wrapper thrv_text_element tve_empty_dropzone">
								<p class="tve_p_left ttfm4" style="font-size: 18px; color: rgb(155, 157, 165); margin-bottom: 0px ! important; padding-top: 9px ! important; margin-left: 0px;"><span class="bold_text"></span><?php the_field('if_all_of_that_doesn’t_work_desc');?><a href="<?php echo get_site_url();?>/microphone-settings/windows-xp/#selectTheMicrophoneStep" class=""></a><br></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>
</div>

</div>
</div>
<script src="<?php echo get_template_directory_uri();?>/assets/js/xp-button.js"></script>

<?php get_footer();?>