<?php /*Template Name:Window Vista*/
get_header();?>

							<div class="windows-vista-section">
								<div class="mic_setting_blue">
									<div class="mic_setting_info">
										<div class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
                          					<?php the_field('if_your_microphone_desc');?>
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
									if( have_rows('steps') ):

									 	// loop through the rows of data
									    while ( have_rows('steps') ) : the_row();?>
						                      		<div class="mic_setting_steps <?php echo $j[$i];?>">
						                      			<div class="dis-flex dis-block-xs clearfix">
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<p><?php the_sub_field('steps_no');?></p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img class="tve_image" alt="<?php the_sub_field('alt_text');?>" style="width: 287px" src="<?php the_sub_field('steps_image');?>" onerror="this.style.display='none'">
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
						                      		<!-- <div class="mic_setting_steps">
						                      			<div class="dis-flex dis-block-xs clearfix">
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<p> <span class="bold_text">Step 2:  </span> In Control Panel click Hardware and Sound.</p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img class="lazyload" src="//www.onlinemictest.com/image/lazy.gif" data-src="../image/hardware-sound-winvista-2.png" style="width: 510px;" alt="Clicking on Hardware and sound in the control panel">
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
							                      						<p> <span class="bold_text">Step 3:  </span>Under Sound click Manage Audio Devices.</p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img class="lazyload" src="//www.onlinemictest.com/image/lazy.gif" data-src="../image/manage-audio-winvista-3.png" style="width: 582px;" alt="Clicking on Manage audio devices">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
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
														<div class="dis-flex dis-block-xs clearfix">
														    <div class="width-50 wid-xs-100 step_half">
															    <div class="flex_col">
															      <div class="justify_col">
															        <p> <span class="bold_text">Step 4:  </span> Click the Recording tab.</p>
															      </div>
															    </div>
														    </div>
														    <div class="width-50 wid-xs-100 step_half">
															    <div class="flex_col">
															      <div class="justify_col">
															        <img class="lazyload" src="//www.onlinemictest.com/image/lazy.gif" data-src="../image/recording-tab-winvista-4.png" style="width: 394px;" alt="The recording tab in the sound menu">
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
							                      						<p> <span class="bold_text">Step 5:  </span>The list of recording devices will appear. Try speaking into your microphone, and look for green bars rising while you talk (see screenshot).</p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img class="lazyload" src="//www.onlinemictest.com/image/lazy.gif" data-src="../image/green-bars-winvista-5.png" style="width: 414px;" alt="Checking if green bars are rising">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
						                      		</div> -->
						                      		<div class="mic_setting_steps">
						                      			<div class="clearfix">
							                      			<div class="width-100 step_half mar-top-0">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<?php the_field('step6');?>
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
						                      		</div>
						                      		<?php

									// check if the repeater field has rows of data
									if( have_rows('next') ):

									 	// loop through the rows of data
									    while ( have_rows('next') ) : the_row();?>
						                      		<div class="mic_setting_steps">
						                      			<div class="dis-flex dis-block-xs clearfix">
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<p> <?php the_sub_field('nextsteps_no');?></p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img alt="<?php the_sub_field('image_alt_text');?>" style="width: 414px;" src="<?php the_sub_field('nextsteps_image');?>" onerror="this.style.display='none'">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
							                      		
							                      		<div class="ads-margin-30 mar-bot-0">
							                      			<div align="center">
															</div>
														</div>
							                      	</div>
							                      	<?php
														endwhile;
														else :
														endif;
														?>
							                      <!-- 	<div class="mic_setting_steps">
							                      		<div class="dis-flex dis-block-xs clearfix">
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<p>
							                      							<span class="bold_text">Step 9:  </span>Double-click on the device from the list. The Microphone Properties window will appear. Click the Levels tab.
							                      						</p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img alt="The levels tab in the microphone properties" style="width: 393px;" src="../image/levels-winvista-7.png">
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
							                      						<p>
							                      							<span class="bold_text">Step 10:  </span> Drag the slider all the way to the right, until the number ’100′ is displayed beside it.
							                      						</p>
							                      					</div>
							                      				</div>
							                      			</div>
							                      			<div class="width-50 wid-xs-100 step_half">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<img alt="Dragging the volume slider all the way up" style="width: 393px;" src="../image/levels-slider-winvista-8.png">
							                      					</div>
							                      				</div>
							                      			</div>
							                      		</div>
							                      	</div> -->
							                      	<div class="mic_setting_steps _last_">
							                      		<div class="">
							                      			<div class="justify_col">
					                      						<p> <?php the_field('step_11');?></p>
					                      					</div>
							                      		</div>
						                      			<div class="dis-flex dis-block-xs clearfix">
							                      			<div class="width-100 wid-xs-100 step_half mar-top-0">
							                      				<div class="flex_col">
							                      					<div class="justify_col">
							                      						<p class="mar-bot-20">
							                      							 <?php the_field('step_12');?>
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
                          							<?php the_field('what_to_do_if_you_did_see_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
											<div class="info_container">
												<?php the_field('what_to_do_if_you_did_see_desc');?>
											</div>
										</div>
									</div>
								</div>
								<div id="stillNothing" class="mic_setting_blue">
									<div class="mic_setting_info">
										<div class="mic_setting_info_title">
											<div class="pd-1">
												<h3>
											   <?php the_field('what_to_do_if_you_don’t_see_title');?>
												</h3>
											</div>
										</div>
										<div class="mic_setting_info_content">
										    	<div class="info_container">
					                      		<div class="mic_setting_steps _last_">
					                      			<div class="dis-flex dis-block-xs clearfix">
						                      			<div class="width-50 wid-xs-100 step_half">
						                      				<div class="flex_col">
						                      					<div class="justify_col">
						                      						<p>
							                      						<?php the_field('rightside_steps_');?></p>
						                      					</div>
						                      				</div>
						                      			</div>
						                      			<div class="width-50 wid-xs-100 step_half">
						                      				<div class="flex_col">
						                      					<div class="justify_col">
						                      						<img class="lazyload" src="<?php echo get_template_directory_uri();?>/assets/image/lazy.gif" data-src="<?php the_field('leftside_step_image');?>" style="width: 287px;" alt="Finding the control panel in the Start menu" onerror="this.style.display='none'">
						                      					</div>
						                      				</div>
						                      			</div>
						                      		</div>
					                      		</div>
					                      		<?php the_field('this_might_add_extra_desc');?>
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
					</div>
                    </div>
				</article>
			</div>
		</div>
<?php get_footer();?>