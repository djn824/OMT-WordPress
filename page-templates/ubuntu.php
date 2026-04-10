<?php /* Template Name: ubuntu*/
get_header();?>
<div class="published-date">
	Updated <?php echo get_the_date();?>
</div><div class="ads-margin-30">
	<div align="center">
		<style>
			.OMT_MOINSBD_Header { width: 320px; height: 100px; }
			@media(min-width: 500px) { .OMT_MOINSBD_Header { width: 468px; height: 60px; } }
			@media(min-width: 800px) { .OMT_MOINSBD_Header { width: 970px; height: 90px; } }
		</style>
	</div>
</div>

<div class="ubuntu-section">
	<div class="mic_setting_blue">
		<div class="mic_setting_info">
			<div class="mic_setting_info_title">
				<div class="pd-1">
					<h3>
						<?php the_field('follow_these_steps_title');?>
					</h3>
				</div>
			</div>
			<div class="mic_setting_info_content">
				<div class="ubuntu-content">
					<div class="info_container">
						<?php

						// check if the repeater field has rows of data
						if( have_rows('follow_these_steps') ):

							// loop through the rows of data
							while ( have_rows('follow_these_steps') ) : the_row();?>
								<div class="mic_setting_steps _first_">

									<div id="step1" class="dis-flex dis-block-xs clearfix">

										<div class="width-50 wid-xs-100 step_half">
											<div class="flex_col">
												<div class="justify_col">
													<p> <?php the_sub_field('steps');?></p>
												</div>
											</div>
										</div>

										<div class="width-50 wid-xs-100 step_half">
											<div class="flex_col">
												<div class="justify_col_img">
													<img class="tve_image" width="100%" height="<?php the_sub_field('image_height');?>" alt="<?php the_sub_field('alt_text');?>" src="<?php the_sub_field('steps_image');?>" onerror="this.style.display='none'">
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php 

							endwhile;
						else :
						endif;
						?>
						<div class="ads-margin-30 mar-bot-0">
							<div align="center">
								<style>
									.OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }
									@media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }
									@media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }
								</style>
							</div>
						</div>
					</div>

					<div class="mic_setting_steps">
						<div class="clearfix">
							<div class="width-100 step_half">
								<div class="flex_col pad-left-0">
									<div class="justify_col">
										<?php the_field('steps6-7');?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="mic_setting_steps">
						<div class="dis-flex dis-block-xs clearfix">
							<div class="width-50 wid-xs-100 step_half">
								<div class="flex_col">
									<div class="justify_col">
										<p> <?php the_field('step-8');?></p>
									</div>
								</div>
							</div>
							<div class="width-50 wid-xs-100 step_half">
								<div class="flex_col">
									<div class="justify_col_img">
										<img class="lazyload" src="<?php the_field('step8_image');?>" data-src="<?php the_field('step8_image');?>" style="width: 332px;" alt="Modifiying the input volume" onerror="this.style.display='none'">
									</div>
								</div>
							</div>
						</div>

						<div class="ads-margin-30 mar-bot-0">
							<div align="center">
							</div>
						</div>
					</div>
					<div class="mic_setting_steps _last_ pad-0">
						<div class="clearfix">
							<div class="width-100 step_half">
								<div class="flex_col pad-left-0">
									<div class="justify_col">
										<p>
											<?php the_field('step9');?></a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mic_setting_blue">
	<div class="mic_setting_info">
		<div id="pram" class="mic_setting_info_title">
			<div class="pd-1">
				<h3>
					<?php the_field('set_default_device_title');?>
				</h3>
			</div>
		</div>
		<div class="mic_setting_info_content">
			<div class="ubuntu-content">
				<div class="info_container mar-top-0">

					<div class="ads-margin-30 mar-bot-0">
						<div align="center">
							<style>
								.OMT_MOINSBD_End { width: 300px; height: 250px; }
								@media(min-width: 500px) { .OMT_MOINSBD_End { width: 336px; height: 280px; } }
								@media(min-width: 800px) { .OMT_MOINSBD_End { width: 970px; height: 90px; } }
							</style>
						</div>
					</div>

					<div class="mic_setting_steps _last_">
						<div class="clearfix">
							<div class="step_half dis-block">
								<div class="flex_col pad-left-0">
									<div class="justify_col">
										<p><?php the_field('step-10');?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="dis-flex dis-block-xs clearfix">
							<div class="width-50 wid-xs-100 step_half">
								<div class="flex_col">
									<div class="justify_col">
										<p> <?php the_field('step-11');?></p>
									</div>
								</div>
							</div>
							<div class="width-50 wid-xs-100 step_half">
								<div class="flex_col">
									<div class="justify_col_img">
										<img class="lazyload" src="<?php the_field('step-11_image');?>" data-src="<?php the_field('step-11_image');?>" style="width: 347px;" alt="Changing the default input device" onerror="this.style.display='none'">
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix">
							<div class="step_half dis-block">
								<div class="flex_col pad-left-0">
									<div class="justify_col">
										<p> <?php the_field('step-12');?></a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mic_setting_blue ubuntu_last_blue">
	<div class="mic_setting_info">
		<div id="orangeBarsButNotWorking" class="mic_setting_info_title">
			<div class="pd-1">
				<h3>
					<?php the_field('what_to_do_title');?>
				</h3>
			</div>
		</div>
		<div class="mic_setting_info_content">
			<div class="info_container">
				<div class="mic_setting_steps _last_ pad-0">
					<div class="clearfix">
						<?php the_field('what_to_do_desc');?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ads-margin-30">
	<div align="center">
	</div>
</div>
</div>
</div>
</div>
</article>
</div>
</div>


<?php 
get_footer();?>