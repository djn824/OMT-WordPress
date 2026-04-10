<?php /*Template Name:Game*/
get_header();
?>
<div class="games-control-content">
	<p class="games-control-note">
		<?php while ( have_posts() ) {
		the_post(); ?>
			<?php the_content();?>
			<?php
		}?>
	</p>
	<div class="games_">
		<?php

		if( have_rows('game_content') ):

		while ( have_rows('game_content') ) : the_row();?>
		<div class="item_games">
			<div class="item_games_2">
				<img src="<?php the_sub_field('image');?>">
			</div>
			<div class="item_games_1">
				<p><a href="<?php the_sub_field('title_url');?>"><?php the_sub_field('title');?></a></p>
			</div>
			<div class="item_games_3">
				<p><a href="<?php the_sub_field('desc_url');?>" class=""><?php the_sub_field('desc');?></a></p>
			</div>
		</div>
		<?php 
		$i++;
		endwhile;
		else :
		endif;
		?>
		<!-- <div class="width-33_3 wid-xs-100 pad-left-15">
<div class="item_games">
<div class="item_games_1">
<p><a href="https://www.onlinemictest.com/games/soundspeed/">Soundspeed</a></p>
</div>
<div class="item_games_2">
<img style="width: 227px;" src="<?php //echo get_template_directory_uri();?>/assests/image/Soundspeed-Screen21.jpg" width="227" height="185">
</div>
<div class="item_games_3">
<p ><a href="https://www.onlinemictest.com/games/soundspeed/">Voice controlled &#65279;futuristic&#65279; racer!</a></p>
</div>
</div>
</div>
<div class="width-33_3 wid-xs-100 pad-left-15">
<div class="item_games">
<div class="item_games_1">
<p><a href="https://www.onlinemictest.com/games/mic-frog/">Mic Frog</a></p>
</div>
<div class="item_games_2">
<img style="width: 227px;" src="<?php //echo get_template_directory_uri();?>/assests/image/Mic-Frog-Screen-300x234.jpg" width="227" height="177">
</div>
<div class="item_games_3">
<p ><a href="https://www.onlinemictest.com/games/mic-frog/" class="">Voice &#65279;controlled&#65279; frog!</a></p>
</div>
</div>
</div> -->
	</div>
</div>

<div class="google-adds-1">
	<div align="center">
		<style>
			.OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }
			@media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }
			@media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }
		</style>
	</div>
</div>
</div>
</article>
</div>
</div>
<?php get_footer();?>
