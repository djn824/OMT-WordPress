<?php /*Template Name:Windows-7*/
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

<div class="windows-7-section">

	<div class="steps-titles">
		<p><?php the_field('here_are_some_scenarios_desc');?></p>
		<?php
									// check if the repeater field has rows of data
		if( have_rows('cases') ):
										// loop through the rows of data
			while ( have_rows('cases') ) : the_row();?>
				<p><a href="<?php the_sub_field('case_link');?>"><span><?php the_sub_field('case_no');?></span><?php the_sub_field('case_desc');?></a></p>
				<?php 
			endwhile;
		else :
		endif;
		?>
		
		<p><?php the_field('if_you_can’t_decide_desc');?></p> 

	</div>

	<div class="mic_setting_blue" id=case_1>
		<div class="mic_setting_info">
			<div class="mic_setting_info_title">
				<div class="pd-1">
					<h3>
						<?php the_field('case_1_title');?>
					</h3>
				</div>
			</div>
			<?php if(get_field('case_1')==true){?>
				<div class="mic_setting_info_content">
					<div class="windows-7-content">
						<div class="info_container">
							<?php 
							$i=0;
							$j=['_first_','','','','','',''];
							?>
							
							<?php

									// check if the repeater field has rows of data
							if( have_rows('case_1_steps') ):

									 	// loop through the rows of data
								while ( have_rows('case_1_steps') ) : the_row();?>
									<div class="mic_setting_steps <?php echo $j[$i];?>">
										<div class="dis-flex dis-block-xs clearfix">
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
													<div class="justify_col">
														<p> <?php the_sub_field('stepes_title');?></p>
													</div>
												</div>
											</div>
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
													<?php 
													$field=get_sub_field('steps1_image');
													if( !empty($field)){

														?>
														
														<div class="justify_col">
															<img width="100%" height="<?php the_sub_field('image_height');?>" class="tve_image" alt="<?php the_sub_field('alt_text');?> " style="width: 408px" src="<?php the_sub_field('steps1_image');?>" onerror="this.style.display='none'">
														</div>
													<?php }else{

													} ?>
												</div>
											</div>
										</div>
									</div>
									<?php $i++;
								endwhile;
							else :
							endif;
							?>
							
							<div class="mic_setting_steps _last_">
								<div class="clearfix">
									<div class="width-100 step_half mar-top-0">
										<div class="flex_col">
											<div class="justify_col">
												<p class="mar-bot-20">
													<?php the_field('case1_last_step');?>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php 
							$lastclass=0;
							$addclass=['_last_','','','','','',''];
							?>
							
							<?php

									// check if the repeater field has rows of data
							if( have_rows('cases_copy') ):

									 	// loop through the rows of data
								while ( have_rows('cases_copy') ) : the_row();?>
									<div class="mic_setting_steps <?php echo $addclass[$lastclass];?>">
										<div class="dis-flex dis-block-xs clearfix">
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
													<div class="justify_col">
														<p> <?php the_sub_field('case_desc');?></p>
													</div>
												</div>
											</div>
											<div class="width-50 wid-xs-100 step_half">
												<div class="flex_col">
							                      					<!-- <div class="justify_col">
							                      						<img class="tve_image" alt=" " style="width: 408px" src="<?php //the_sub_field('caseimage');?>">
							                      					</div> -->
							                      					<div class="justify_col">
							                      						<img class="tve_image" alt="<?php the_sub_field('alt-text-');?> " style="width: 408px" src="<?php the_sub_field('caseimage');?>" onerror="this.style.display='none'">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
							                      	</div>
							                      	<?php 
							                      	$lastclass++;
							                      endwhile;
							                  else :
							                  endif;
							                  ?> 
							              </div>
							          </div>
							          
							      </div>
							  <?php }else{}?>
							</div>
						</div>
						<?php if(get_field('accordion')==true){?>

							<div id="greenBarsButNotWorking" class="_accordion pd-1">
								<div class="tve_faq">
									<div class="tve_faqI">
										<div class="tve_faqB"><span class="tve_not_editable tve_toggle"></span>
											<h4><?php the_field('de-accordion_title');?></h4>
										</div>
										<div class="tve_faqC tve_empty_dropzone" style="display: none;">
											<div class="thrv_paste_content thrv_wrapper tve_empty_dropzone">
												<?php

									// check if the repeater field has rows of data
												if( have_rows('de-accordion') ):

									 	// loop through the rows of data
													while ( have_rows('de-accordion') ) : the_row();?>
														<div class="thrv_wrapper thrv_text_element tve_empty_dropzone"><p style="font-size: 20px; color: rgb(127, 130, 143); line-height: 22px; margin-bottom: 0px !important; padding-top: 9px !important; margin-left: 20px !important;" class="tve_p_left ttfm6" data-unit="px"><span class="tve_custom_font_size" style="font-size: 25px;"><b><span class="tve_custom_font_size" style="font-size: 25px;"><span class="tve_custom_font_size" style="font-size: 16px;"><font color="#7f828f"><span class="bold_text"></span>
															<?php the_sub_field('list');?>
														</font></span></span></b></span></p></div><div class="thrv_wrapper" style="margin-top: 0px !important; margin-bottom: 0px !important;">
															<hr class="tve_sep tve_sep1">
														</div>
														<?php 
														
													endwhile;
												else :
												endif;
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php }
						else { }?>
							<div class="ads-margin-30">
								<div align="center">
									<style>
										.OMT_MOINSBD_End { width: 300px; height: 250px; }
										@media(min-width: 500px) { .OMT_MOINSBD_End { width: 336px; height: 280px; } }
										@media(min-width: 800px) { .OMT_MOINSBD_End { width: 970px; height: 90px; } }
									</style>
								</div>
							</div>
							<?php if(get_field('was_sollst_du_tun')==true){?>
								<div id="greenBarsButNotWorking" class="mic_setting_blue">
									<div class="mic_setting_info">
										<div class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
													<?php the_field('was_sollst_du_tun_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
											<div class="info_container">
												<p class="mar-bot-30">
													<?php the_field('was_sollst_du_tun_desc');?>
												</p>
												<p class="bold_text">
													<?php the_field('was_sollst_du_tun_desc2');?>
												</p>
											</div>
										</div>
									</div>
								</div>
							<?php }else{}?>
							<?php if(get_field('case_2')==true){?>
								<div id="case_2" class="mic_setting_blue">
									<div class="mic_setting_info">
										<div class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
													<?php the_field('case2_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
											<div class="info_title">
												<p><?php the_field('wenn_es_scheint');?></p>
											</div>
											<div class="info_container">
												<div class="mic_setting_steps _last_">
													<div class="dis-flex dis-block-xs clearfix">
														<div class="width-50 wid-xs-100 step_half">
															<div class="flex_col">
																<div class="justify_col">
																	<p>
																		<?php the_field('case2_desc');?>
																	</p>
																</div>
															</div>
														</div>
														<div class="width-50 wid-xs-100 step_half">
															<div class="flex_col">
																<div class="justify_col">
																	<img class="lazyload" src="<?php the_field('case2_image');?>" data-src="<?php the_field('case2_image');?>" style="width: 408px;" onerror="this.style.display='none'">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php }else{}?>
										<?php if(get_field('esto_puede_anadir_descde')==true){?>

											<p class="bold_text"><?php the_field('esto_puede_anadir_descde');?></p>
										<?php }else{}?>
									</div>

								</div>
							</div>
							
							<?php if(get_field('case_3')==true){?>

								<div class="mic_setting_blue" id=case_3>
									<div class="mic_setting_info">
										<div class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
													<?php the_field('case_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
											<div class="windows-7-content">
												<div class="info_container">
													<div class="mic_setting_steps _first_">
														<div class="clearfix">
															<div class="width-100 step_half mar-top-0">
																<div class="flex_col">
																	<div class="justify_col">
																		<p  class="mar-bot-20"> 
																			<?php the_field('case3_step1');?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php

									// check if the repeater field has rows of data
														if( have_rows('case3_') ):

									 	// loop through the rows of data
															while ( have_rows('case3_') ) : the_row();?>
																<div class="mic_setting_steps">
																	<div class="dis-flex dis-block-xs clearfix">
																		<div class="width-50 wid-xs-100 step_half">
																			<div class="flex_col">
																				<div class="justify_col">
																					<p><?php the_sub_field('csae_3_steps');?></p>
																				</div>
																			</div>
																		</div>
																		<div class="width-50 wid-xs-100 step_half">
																			<div class="flex_col">
																				<div class="justify_col">
																					<img class="lazyload" src="<?php the_sub_field('case3_steps_image');?>" data-src="<?php the_sub_field('case3_steps_image');?>" width="100%" alt="<?php the_sub_field('case3_alt_text');?>" height="<?php the_sub_field('image_height');?>" onerror="this.style.display='none'">
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
														
														<div class="mic_setting_steps _last_">
															<div class="clearfix">
																<div class="width-100 step_half mar-top-0">
																	<div class="flex_col">
																		<div class="justify_col">
																			<p class="mar-bot-20">
																				<?php the_field('case3_step6');?>
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
								<?php }else{}?>
								<?php if(get_field('case_4')==true){?>

									<div class="mic_setting_blue" id="case_4">
										<div class="mic_setting_info">
											<div class="mic_setting_info_title">
												<div class="pd-1">
													<h3>
														<?php the_field('case4_title');?>
													</h3>
												</div>
											</div>
											<div class="mic_setting_info_content">
												<div class="info_title">
													<p><?php the_field('in_this_case_desc');?></p>
												</div>
												<div class="info_container">

													<div class="mic_setting_steps _last_">
														<div class="dis-flex dis-block-xs clearfix">
															<div class="width-50 wid-xs-100 step_half">
																<div class="flex_col">
																	<div class="justify_col">
																		<p>
																			<?php the_field('lets_start_desc');?>
																		</p>
																	</div>
																</div>
															</div>
															<div class="width-50 wid-xs-100 step_half">
																<div class="flex_col">
																	<div class="justify_col">
																		<img class="lazyload" src="<?php the_field('if_the_troubleshooter_image_rightside');?>" data-src="<?php the_field('if_the_troubleshooter_image_rightside');?>" style="width: 408px;" alt="Finding the control panel" onerror="this.style.display='none'">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<p>
														<?php the_field('if_a_new_microphone_desc');?>
													</p>
													<?php if( have_rows('case4_steps') ):

												 	// loop through the rows of data
														while ( have_rows('case4_steps') ) : the_row();?>
															<div class="mic_setting_steps">
																<div class="dis-flex dis-block-xs clearfix">
																	<div class="width-50 wid-xs-100 step_half">
																		<div class="flex_col">
																			<div class="justify_col">
																				<p><?php the_sub_field('case4_step_title');?></p>
																			</div>
																		</div>
																	</div>
																	<div class="width-50 wid-xs-100 step_half">
																		<div class="flex_col">
																			<div class="justify_col">
																				<img class="lazyload" src="<?php the_sub_field('case4_steps_image');?>" data-src="<?php the_sub_field('case4_steps_image');?>" width="100%" height="<?php the_sub_field('image_height');?>"
																				alt="<?php the_sub_field('case4_alt_text');?>" onerror="this.style.display='none'">
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

													
													<div class="mic_setting_steps _last_">
														<div class="clearfix">
															<div class="width-100 step_half mar-top-0">
																<div class="flex_col">
																	<div class="justify_col">
																		<p class="mar-bot-20">
																			<?php the_field('if_the_troubleshooter_desc');?> 
																		</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<?php

												// check if the repeater field has rows of data
													if( have_rows('if_the_troubleshooter_steps') ):

												 	// loop through the rows of data
														while ( have_rows('if_the_troubleshooter_steps') ) : the_row();?>
															<div class="mic_setting_steps">
																<div class="dis-flex dis-block-xs clearfix">
																	<div class="width-50 wid-xs-100 step_half">
																		<div class="flex_col">
																			<div class="justify_col">
																				<p><?php the_sub_field('if_the_troubleshooter_step_title');?></p>
																			</div>
																		</div>
																	</div>
																	<div class="width-50 wid-xs-100 step_half">
																		<div class="flex_col">
																			<div class="justify_col">
																				<img class="lazyload" 
																				src="<?php the_sub_field('if_the_troubleshootersteps_image');?>" data-src="<?php the_sub_field('if_the_troubleshootersteps_image');?>" width="100%" height="<?php the_sub_field('image_height');?>"
																				alt="<?php the_sub_field('alt_desc');?>" onerror="this.style.display='none'">
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
													
													
													
													<div class="mic_setting_steps">
														<div class="clearfix">
															<div class="width-100 step_half mar-top-0">
																<div class="flex_col">
																	<div class="justify_col">
																		<p class="mar-bot-20">
																			<?php the_field('if_the_troubleshooter_steps9');?>
																		</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
												<?php }else{}?>
												<?php if(get_field('some-final-tips')==true){?>

													<div class="mic_setting_steps _last_ pad-bot-0">
														<div class="clearfix">
															<div class="width-100 step_half mar-top-0">
																<div class="flex_col">
																	<div class="justify_col">
																		<p>
																			<span class="bold_text"><?php the_field('some_final_tips_title');?></span> 
																		</p>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="mic_setting_steps _last_ pad-top-0">
														<div class="dis-flex dis-block-xs clearfix">
															<div class="width-50 wid-xs-100 step_half mar-top-0">
																<div class="flex_col">
																	<div class="justify_col">
																		<ul class="final-tips">
																			<?php the_field('some_final_tips');?>
																			
																		</ul>
																	</div>
																</div>
															</div>
															<div class="width-50 wid-xs-100 step_half">
																<div class="flex_col">
																	<?php if( get_field('some_final_tips_rightside_image') ): ?>
																		<div class="justify_col">
																			
																			<img class="lazyload" src="<?php the_field('some_final_tips_rightside_image');?>" data-src="<?php the_field('some_final_tips_rightside_image');?>" style="width: 673px;" alt="Hardware and Sound option in the control panel" onerror="this.style.display='none'">
																			
																		</div>
																	<?php endif; ?>
																</div>
															</div>
														</div>
													</div>
												<?php }else{}?>

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