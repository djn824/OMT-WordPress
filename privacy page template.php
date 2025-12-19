<?php /*Template Name:Privacy*/
get_header();?>
<div class="languages">
	<?php dynamic_sidebar('language');?>
	
</div>
<?php while ( have_posts() ) : the_post();
	the_content();
endwhile;?>

</div>
</div>
</article>
</div>
</div>
<?php get_footer()?>