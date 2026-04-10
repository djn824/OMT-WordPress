<?php /*Template Name:Contact */

get_header();

?>
<div class="breadcrumbs">
	<div class="breadcrumbs-row dis-flex">
		<div class="languages">
			<?php dynamic_sidebar('languages'); ?>
		</div>
	</div>
</div>

<div class="contact-content">

	<div id="simple-contact-form" class="scf">

		<?php dynamic_sidebar('contact-en');?>
		<?php dynamic_sidebar('contact-de');?>

	</div>

</div>

</div>

</article>

</div>

</div>





<?php get_footer();?>