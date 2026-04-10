<?php /*Template Name:Custom Guide With Cases*/

get_header(); ?>
<div class="published-date">
    Updated <?php echo get_the_date();?>
</div>

<?php get_template_part('template-parts/guides/cases') ?>
</div>
</div>
</article>
</div>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/assets/WebcamTest-new.js.min"></script>
<?php get_footer(); ?>