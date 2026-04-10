<?php /*Template Name: About */
get_header();?>
<div class="languages">
	<?php dynamic_sidebar('language');?>
</div>
<div class="about-us">
	<div class="about-content dis-flex dis-block-xs">
		<div class="width-50 pad-left-15 wid-xs-100">
			<div class="about-content-text pd-1">
				<?php while ( have_posts() ) {
					the_post(); ?>
					<?php the_content();?>
					<?php
				}?>
			</p>
			<p style="margin-bottom: 5px !important;">
				<a class="" href="<?php echo get_site_url();?>/contact"><?php the_field('contact');?>
			</p>

		</div>
	</div>
	<div class="width-50 pad-left-15 wid-xs-100">
		<div class="about-content-img pd-1">
			<div class="image-ilan">
				<img class="tve_image" alt="" style="width: 290px;" src="<?php the_field('rightside_image');?>" height="435" >
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