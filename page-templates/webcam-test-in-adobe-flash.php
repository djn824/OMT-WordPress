<?php /*Template Name:Webcam Test In Adove Flash*/
get_header();?>
<div class="webcam-adobe-flash-section">

	<div class="adobe-flash-blue pd-1">
		<div class="adobe-flash_info">
			<div class="adobe-flash_info-title">
				<div class="pd-1">
					<h3>
						<?php the_field('title');?>
					</h3>
				</div>
			</div>
			<div class="adobe-flash_info-content">

				<div class="webcam-ads">
					<div align="center">
						<style>
							.OMT_MOINSBD_Header { width: 320px; height: 100px; }
							@media(min-width: 500px) { .OMT_MOINSBD_Header { width: 468px; height: 60px; } }
							@media(min-width: 800px) { .OMT_MOINSBD_Header { width: 970px; height: 90px; } }
						</style>
					</div>
				</div>

				<div class="dis-flex dis-block-xs">
					<div class="width-50 pad-left-15 wid-xs-100">
						<div class="webcam-adobe-flash-1 pd-1">
							<p>
								<?php the_field('desc1');?>
							</p>
							<p class="webcam_info-content-title">
								<?php the_field('title2');?>
							</p>

							<?php the_field('desc2');?>
						</div>
					</div>

					<div class="width-50 pad-left-15 wid-xs-100">
						<div class="dis-flex flash_content_center">
							<div class="flash_content_ pd-1">
								<div id="flashContentBig">
									<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="fm_webcamTest1_865472159" class="flashmovie" width="596" height="452">
										<param name="movie" value="<?php echo get_template_directory_uri();?>/assets/webcamTest1.swf">
										<param name="scale" value="showall">
										<param name="allowscriptaccess" value="sameDomain">
										<!--[if !IE]>-->
										<object type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri();?>/assets/webcamTest1.swf" name="fm_webcamTest1_865472159" width="596" height="452">
											<param name="scale" value="showall">
											<param name="allowscriptaccess" value="sameDomain">
											<!--<![endif]-->
												<a href="https://adobe.com/go/getflashplayer"><img alt="Get Adobe Flash player" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/flash.gif" ></a>
												<!--[if !IE]>-->
											</object>
											<!--<![endif]-->
											</object>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="webcam-ads">
						<div align="center">
							<style>
								.OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }
								@media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }
								@media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }
							</style>
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