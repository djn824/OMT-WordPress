<?php /*Template Name:Windows-8*/
get_header();?>
<div class="published-date">
	Updated <?php echo get_the_date();?>
</div>
<div class="windows-8-section">
	<div class="mic_setting_blue">
		<div class="mic_setting_info">
			<div class="mic_setting_info_title">
				<div class="pd-1">
					<h3>
						<?php the_field('title');?>
					</h3>
				</div>
			</div>
			<div class="mic_setting_info_content">
				<div class="windows-8-content">
					<div class="ads-margin-30">
						<div align="center">
							<style>
								.OMT_MOINSBD_Header { width: 320px; height: 100px; }
								@media(min-width: 500px) { .OMT_MOINSBD_Header { width: 468px; height: 60px; } }
								@media(min-width: 800px) { .OMT_MOINSBD_Header { width: 970px; height: 90px; } }
							</style>
						</div>
					</div>

					<div class="info_title">
						<p class="bold_text"><?php the_field('if_your_microphone_desc');?></p>
					</div>
					<div class="info_container">
						<p><?php the_field('follow_the_steps-');?></p>
						<?php

												// check if the repeater field has rows of data
						if( have_rows('steps') ):

												 	// loop through the rows of data
							while ( have_rows('steps') ) : the_row();?>
								<div class="mic_setting_steps">
									<div class="dis-flex dis-block-xs clearfix">
										<div class="width-50 wid-xs-100 step_half">
											<div class="flex_col">
												<div class="justify_col">
													<p> <span class="bold_text">
														<?php the_sub_field('step');?>  </span><?php the_sub_field('desc');?></p>
													</div>
												</div>
											</div>
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
													<div class="justify_col_img">
														<img width="100%" class="lazyload" height="<?php the_sub_field('image_height');?>" src="<?php the_sub_field('image');?>" data-src="<?php the_sub_field('image');?>" alt="<?php the_sub_field('alt_text');?>"
														onerror="this.style.display='none'">
													</div>
												</div>
											</div>
										</div>
										<?php the_sub_field('extra_desc');?>
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

	<div class="ads-margin-30">
		<div align="center">
			<style>
				.OMT_MOINSBD_End { width: 300px; height: 250px; }
				@media(min-width: 500px) { .OMT_MOINSBD_End { width: 336px; height: 280px; } }
				@media(min-width: 800px) { .OMT_MOINSBD_End { width: 970px; height: 90px; } }
			</style>
		</div>
	</div>

	<div id="greenBarsButNotWorking" class="mic_setting_blue">
		<div class="mic_setting_info">
			<div class="mic_setting_info_title">
				<div class="pd-1">
					<h3>
						<?php the_field('what_to_do_if_you_did_see_green_bars_title');?>
					</h3>
				</div>
			</div>
			<div class="mic_setting_info_content">
				<div class="info_container">
					<?php the_field('what_to_do_if_you_did_see_green_bars_desc');?>
				</div>
			</div>
		</div>
	</div>
	<div id="stillNothing" class="mic_setting_blue">
		<div class="mic_setting_info">
			<div class="mic_setting_info_title">
				<div class="pd-1">
					<h3>
						<?php the_field('what_to_do_if_you_don’t_see_the_green_bars_title');?>
					</h3>
				</div>
			</div>
			<div class="mic_setting_info_content">
				<div class="info_title">
					<p><?php the_field('what_to_do_if_you_don’t_see_the_green_bars_desc');?></p>
				</div>
				<div class="info_container">
					<p><?php the_field('follow_the_step');?></p>
					<div class="mic_setting_steps _last_">
						<div class="dis-flex dis-block-xs clearfix">
							<div class="width-50 wid-xs-100 step_half">
								<div class="flex_col">
									<div class="justify_col">
										<p> <span class="bold_text"><?php the_field('step');?> </span><?php the_field('step_desc');?></p>
									</div>
								</div>
							</div>
							<div class="width-50 wid-xs-100 step_half">
								<div class="flex_col">
									<div class="justify_col_img">
										<img class="lazyload" src="<?php the_field('rightside_image');?>" data-src="<?php the_field('rightside_image');?>" style="width: 351px;" alt="Show disabled devices in the sound menu" onerror="this.style.display='none'">
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php the_field('this_might_add_extra_devices_desc');?>
					
				</div>
			</div>
			<div class="ads-margin-30">
				<div align="center">
				</div>
			</div>
		</div>
	</div>
</div>

</div>

</article>
</div>
</div>
<?php get_footer();?>