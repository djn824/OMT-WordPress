<?php

/*
 * Template Name: Mic test and guide cases
*/
get_header('2');
?>
    <?php get_template_part('template-parts/tests/microphone') ?>
    
    <div class="advertising_banner">
        <div class="text-center">
            <style>
                .OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }
                @media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }
                @media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }
            </style>
        </div>
    </div>

    <?php get_template_part('template-parts/guides/new-cases') ?>
</div>
</div>
</article>
</div>
</div>
<?php get_footer('3');