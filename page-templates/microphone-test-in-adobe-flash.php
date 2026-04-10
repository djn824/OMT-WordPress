<?php /*Template Name:MICROPHONE TEST – IN ADOBE FLASH */
get_header();?>

<div class="microphone-adobe-flash-section">
	<p class="microphone-adobe-flash-important">
		<?php the_field('descp');?>
	</p>
	<div class="adobe-flash-blue pd-1">
		<div class="adobe-flash_info">
			<div class="adobe-flash_info-title">
				<div class="pd-1">
					<h3>
						<?php the_field('use_the_online_title');?>
					</h3>
				</div>
			</div>
			<div class="adobe-flash_info-content">
				<div class="dis-flex dis-block-xs">
					<div class="width-50 pad-left-15 wid-xs-100">
						<?php

						// check if the repeater field has rows of data
						if( have_rows('box_list') ):

							// loop through the rows of data
							while ( have_rows('box_list') ) : the_row();?>

								<div class="pd-1">
									<ul>
										<li>
											<span>
												<?php the_sub_field('desc');?>
											</span>
										</li>
									</ul>
								</div>
							<?php endwhile;
						else :
						endif;
						?>
					</div>

					<div class="width-50 pad-left-15 wid-xs-100">
						<div class="flash_content_ pd-1">
							<div id="flashContent">
								<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="fm_mictest_39265014" class="flashmovie" width="438" height="400">
									<param name="movie" value="<?php echo get_template_directory_uri();?>/assets/mictest.swf">
									<param name="allowscriptaccess" value="sameDomain">
									<!--[if !IE]>-->
									<object type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri();?>/assets/mictest.swf" name="fm_mictest_39265014" width="438" height="400">
										<param name="allowscriptaccess" value="sameDomain">
										<!--<![endif]-->
											<a href="https://adobe.com/go/getflashplayer"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/flash.gif" alt="Get Adobe Flash player"></a>
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
			</div>

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
</article>
</div>
</div>

<?php get_footer();?>