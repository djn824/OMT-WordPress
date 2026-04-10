<?php /*Template Name:Webcam test and guide cases*/

get_header('2'); ?>

    <?php get_template_part('template-parts/tests/webcam') ?>

    <div class="advertising_banner">
        <div align="center">
            <style>
                .OMT_MOINSBD_Middle_Banner {
                    width: 300px;
                    height: 250px;
                }

                @media (min-width: 500px) {
                    .OMT_MOINSBD_Middle_Banner {
                        width: 336px;
                        height: 280px;
                    }
                }

                @media (min-width: 800px) {
                    .OMT_MOINSBD_Middle_Banner {
                        width: 970px;
                        height: 90px;
                    }
                }
            </style>
        </div>
    </div>
    <br>

    <?php get_template_part('template-parts/guides/new-cases') ?>
</div>
</div>
</article>
</div>
</div>
<!--<script src="<?php echo get_template_directory_uri(); ?>/assets/WebcamTest-new.js.min"></script>-->
<?php get_footer('3'); ?>