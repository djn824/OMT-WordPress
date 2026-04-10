<?php /* Template Name: soundspeed*/
get_header();?>
<div class="advertising_banner">
	<div align="center">
		<style>
			.OMT_MOINSBD_Header { width: 320px; height: 100px; }
			@media(min-width: 500px) { .OMT_MOINSBD_Header { width: 468px; height: 60px; } }
			@media(min-width: 800px) { .OMT_MOINSBD_Header { width: 970px; height: 90px; } }
		</style>
	</div>
</div>

<div class="download_webplayer">
	<div class="download_webplayer_js">
		<script type="text/javascript">var unityObjectUrl="http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject2.js";"https:"==document.location.protocol&&(unityObjectUrl=unityObjectUrl.replace("http://","https://ssl-")),document.write('<script type="text/javascript" src="'+unityObjectUrl+'"></script><script type="text/javascript">var config={width:800,height:576,params:{enableDebugging:"1"}},u=new UnityObject2(config);jQuery(function(){var t=jQuery("#unityPlayer").find(".missing"),e=jQuery("#unityPlayer").find(".broken");t.hide(),e.hide(),u.observeProgress(function(n){switch(n.pluginStatus){case"broken":e.find("a").click(function(t){return t.stopPropagation(),t.preventDefault(),u.installPlugin(),!1}),e.show();break;case"missing":t.find("a").click(function(t){return t.stopPropagation(),t.preventDefault(),u.installPlugin(),!1}),t.show();break;case"installed":t.remove();break;case"first":}}),u.initPlugin(jQuery("#unityPlayer")[0],"/soundspeed/soundspeed.unity3d")});</script>
		<div id="unityPlayer">
			<div class="missing tve_empty_dropzone" style="display: block;">
				<div class="tve_image_caption thrv_wrapper tve-droppable">
					<span class="tve_image_frame"><a title="Unity Web Player. Install now!" href="https://unity3d.com/webplayer/" class="" target="" rel="" data-tcb-events="" draggable="false">
						<img src="<?php the_field('getunity_image');?>" alt="Unity Web Player. Install now!" width="193" height="63" ></a></span></div></div>
					</div>
				</div>

			</div>

			<div class="soundspeed-info pd-1">
				<div class="soundspeed_info">
					<div class="soundspeed_info_1">
						<div>
							<h3>
								<?php the_field('instructions_title');?>
							</h3>
						</div>
					</div>
					<div class="soundspeed_info_2">
						<div class="pd-1">
							<?php

							// check if the repeater field has rows of data
							if( have_rows('instruction') ):

								// loop through the rows of data
								while ( have_rows('instruction') ) : the_row();?>
									<p>
										<?php the_sub_field('steps');?>

									</p>
									<?php 

								endwhile;
							else :
							endif;
							?>
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

			<div class="_accordion pd-1">
				<div class="tve_faq">
					<div class="tve_faqI">
						<div class="tve_faqB">
							<span class="tve_not_editable tve_toggle"></span>
							<h4><?php the_field('game_tips_title');?></h4>
						</div>
						<div class="tve_faqC tve_empty_dropzone" style="display: none;">
							<div class="thrv_paste_content thrv_wrapper tve_empty_dropzone">
								<?php

								// check if the repeater field has rows of data
								if( have_rows('game_tips') ):

									// loop through the rows of data
									while ( have_rows('game_tips') ) : the_row();?><div class="thrv_wrapper thrv_text_element tve_empty_dropzone">
										<p style="font-size: 20px; color: rgb(127, 130, 143); line-height: 22px; margin-bottom: 0px !important; padding-top: 9px !important; margin-left: 20px !important;" class="tve_p_left ttfm6" data-unit="px">
											<span class="tve_custom_font_size" style="font-size: 25px;">
												<b>
													<span class="tve_custom_font_size" style="font-size: 25px;">
														<span class="tve_custom_font_size" style="font-size: 16px;">
															<font color="#7f828f">
																<span class="bold_text"></span><?php the_sub_field('tips');?></font>
															</span>
														</span>
													</b>
												</span>
											</p>
										</div>
										<div class="thrv_wrapper" style="margin-top: 0px !important; margin-bottom: 0px !important;">
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

			<div class="soundspeed-info pd-1">
				<div class="soundspeed_info">
					<div class="soundspeed_info_1">
						<div>
							<h3>
								<?php the_field('troubleshooting_title');?>
							</h3>
						</div>
					</div>
					<div class="soundspeed_info_2">
						<div class="pd-1">
							<?php

							// check if the repeater field has rows of data
							if( have_rows('troubleshooting') ):

								// loop through the rows of data
								while ( have_rows('troubleshooting') ) : the_row();?>
									<p>
										<span class="bold_text"><?php the_sub_field('troubleshooting_steps');?>
									</p>
									<?php 
								endwhile;
							else :
							endif;
							?>
						</div>
					</div>

					<div class="advertising_banner">
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
</article>
</div>
</div>
<script src="<?php echo get_template_directory_uri();?>/assets/SpeakersTest.js.min"></script>
<script src="<?php echo get_template_directory_uri();?>/assets/js/xp-button.js"></script>
<?php 
get_footer();?>