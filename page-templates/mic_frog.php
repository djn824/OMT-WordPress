<?php /* Template Name: mic frog*/
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

<div class="pd-1" >
	<div class="mic-frog-game-section">
		<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/full-screen-2.svg" data-attachment-id="8602" width="28" height="28" id="full-screen-option">
		<iframe src="/mic-frog-game" name="iframe_a" title="Iframe Example" width="100%" height="100%" id="fullscreen-element"></iframe>
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

<div class="mic-frog-info pd-1">
	<div class="frog_info">
		<div class="mic_frog_info_1">
			<div>
				<h3>
					<?php the_field('instructions_title')?>
				</h3>
			</div>
		</div>
		<div class="mic_frog_info_2">
			<div class="pd-1">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('instructions') ):

					// loop through the rows of data
					while ( have_rows('instructions') ) : the_row();?>
						<p><span class="bold_text"><?php the_sub_field('steps');?></span><br></p>
						<?php 
					endwhile;
				else :
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<div class="google-adds-1">
	<div align="center">
		<style>
			.OMT_MOINSBD_End { width: 300px; height: 250px; }
			@media(min-width: 500px) { .OMT_MOINSBD_End { width: 336px; height: 280px; } }
			@media(min-width: 800px) { .OMT_MOINSBD_End { width: 970px; height: 90px; } }
		</style>
	</div>
</div>

<div class="_accordion pd-1">
	<div class="tve_faq">
		<div class="tve_faqI">
			<div class="tve_faqB"><span class="tve_not_editable tve_toggle"></span>
				<h4 class="ttfm1 ttfm4" data-unit="px" data-css="tve-u-16194adfc67"><span class="bold_text ttfm1 ttfm4" data-css="tve-u-16194adfc6c"><span class="tve_custom_font_size" data-css="tve-u-16194adfc6e"><?php the_field('game_tips_title');?></span></span></h4>
			</div>
			<div class="tve_faqC tve_empty_dropzone" style="display: none;">
				<div class="thrv_paste_content thrv_wrapper tve_empty_dropzone">
					<?php

					// check if the repeater field has rows of data
					if( have_rows('game_tips_list') ):

						// loop through the rows of data
						while ( have_rows('game_tips_list') ) : the_row();?>	
							<div class="thrv_wrapper thrv_text_element tve_empty_dropzone"><p class="tve_p_left ttfm6" data-unit="px" style="font-size: 20px; color: rgb(127, 130, 143); line-height: 22px; margin-bottom: 0px !important; padding-top: 9px !important; margin-left: 20px !important;">
								<span class="tve_custom_font_size" style="font-size: 25px;"><strong>
									<span class="tve_custom_font_size" style="font-size: 25px;">
										<span class="tve_custom_font_size" style="font-size: 16px;">
											<font color="#7f828f">
												<span class="bold_text"></span><?php the_sub_field('tips');?></font>
											</span>
										</span>
									</strong>
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
</div>
</div>
</article>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const fullscreenElement = document.getElementById('fullscreen-element');
  const toggleFullscreenBtn = document.getElementById('full-screen-option');

  // Function to enter full-screen mode
  function enterFullscreen(element) {
    if (element.requestFullscreen) {
      element.requestFullscreen();
    }
  }

  // Function to exit full-screen mode
  function exitFullscreen() {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    }
  }

  // Toggle full-screen mode
  toggleFullscreenBtn.addEventListener('click', () => {
    if (!document.fullscreenElement) {
      enterFullscreen(fullscreenElement);
    } else {
      exitFullscreen();
    }
  });

});

</script>

<?php 
get_footer();?>