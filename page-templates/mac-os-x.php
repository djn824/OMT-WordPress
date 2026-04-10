<?php /*Template name:Mac-Os*/
get_header();?>

							<div class="mac-os-x-section">
								<p class="breadcrumbs_note">
									<?php the_field('desc');?>
								</p>
								<div class="mic_setting_blue">
									<div class="mic_setting_info">
										<div class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
													<?php the_field('follow_the_steps_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
											<div class="mac-os-x-content">
						                      	<div class="info_container">
						                      		<?php
						                      		$i=0;
						                      		$j=['_first_','','','','','',''];
						                      		?>
						                      		<?php

												// check if the repeater field has rows of data
												if( have_rows('follow_the_steps') ):

												 	// loop through the rows of data
									    		while ( have_rows('follow_the_steps') ) : the_row();?>
						                      		<div class="mic_setting_steps _first_">
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
							                      						<img class="tve_image" alt="<?php the_sub_field('alt_text')?>" style="width: 670px" src="<?php the_sub_field('steps_image');?>">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
						                      		</div>
						                      		<?php $i++;
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
														<div class="clearfix">
							                      			<div class="width-100 step_half">
							                      				<div class="flex_col pad-left-0">
							                      					<div class="justify_col">
							                      						<?php the_field('steps-6-7');?>
							                      						
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
													</div>

						                      		<div class="mic_setting_steps _last_">
						                      			<div class="dis-flex dis-block-xs clearfix">
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<p> <?php the_field('step8');?></p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img class="lazyload" src="<?php the_field('step8_image');?>" data-src="<?php the_field('step8_image');?>" style="width: 670px;" alt="Changing the input volume">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>

							                      		<div class="ads-margin-30 mar-bot-0">
							                      			<div align="center">
															</div>
														</div>

														<div class="clearfix">
							                      			<div class="width-100 step_half">
							                      				<div class="flex_col pad-left-0">
							                      					<div class="justify_col">
							                      						<?php the_field('step9-10');?>
							                      						
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

								<div class="mic_setting_blue reset-the-pram">
									<div class="mic_setting_info">
										<div id="pram" class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
													<?php the_field('reset_the_pram_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
											<div class="mac-os-x-content">
						                      	<div class="info_container mar-top-0">
						                      		<?php

												// check if the repeater field has rows of data
												if( have_rows('reset_the_pram') ):

												 	// loop through the rows of data
									    		while ( have_rows('reset_the_pram') ) : the_row();?>
						                      		<div class="mic_setting_steps">
						                      			<div class="clearfix">
							                      			<div class="step_half mar-top-0 dis-block">
							                      				<div class="flex_col pad-left-0">
							                      					<div class="justify_col">
							                      						<p class="pad-top-0"> <?php the_sub_field('reset_the_pram_steps');?></p>
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
																.OMT_MOINSBD_End { width: 300px; height: 250px; }
																@media(min-width: 500px) { .OMT_MOINSBD_End { width: 336px; height: 280px; } }
																@media(min-width: 800px) { .OMT_MOINSBD_End { width: 970px; height: 90px; } }
																</style>
															</div>
														</div>
						                      		</div>
						                      	</div>
											</div>
                  						</div>
									</div>
								</div>

								<div class="mic_setting_blue new_account">
									<div class="mic_setting_info">
										<div id="newAccount" class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
											   		<?php the_field('Create a New Account');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
										    <div class="info_container">
					                      		<div class="mic_setting_steps pad-top-0 _last_">
					                      			<div class="dis-flex dis-block-xs clearfix">
						                      			<div class="width-50 wid-xs-100 step_half">
						                      				<div class="flex_col">
						                      					<div class="justify_col">
						                      						<p><?php the_field('letside_create_a_new_account');?></p>
						                      					</div>
						                      				</div>
						                      			</div>
						                      			<div class="width-50 wid-xs-100 step_half">
						                      				<div class="flex_col">
						                      					<div class="justify_col">
						                      						<img class="lazyload" src="<?php the_field('rightside_image_');?>" data-src="<?php the_field('rightside_image_');?>" style="width: 661px;" alt="Users and groups icon in the system preferences">
						                      					</div>
						                      				</div>
						                      			</div>
						                      		</div>
					                      		</div>
					                      		<?php the_field('other_account_step');?>
					                      		
											</div>
										</div>
									</div>
								</div>

								<div class="ads-margin-30">
	                      			<div align="center">
									</div>
								</div>

								<div class="mic_setting_blue mac_os_last_blue">
									<div class="mic_setting_info">
										<div id="blueBarsButNotWorking" class="mic_setting_info_title">
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

							</div>
						</div>
					</div>
				</article>
			</div>
		</div>

<?php get_footer();?>