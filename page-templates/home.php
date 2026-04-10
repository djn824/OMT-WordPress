<?php /*Template Name: Home */
get_header();
?>

                <div class="microphone-test">
                    <div class="microphone-1 dis-flex">
                        <div class="width-40 wid-md-50 wid-xs-100">
                            <div class="ct-row dis-flex">
                                <div class="microphone-1-icon_">
                                    <div class="microphone-icon">
                                        <svg class="ct-icon" viewBox="0 0 18 28" data-name="microphone">
                                            <path d="M18 11v2c0 4.625-3.5 8.437-8 8.937v2.063h4c0.547 0 1 0.453 1 1s-0.453 1-1 1h-10c-0.547 0-1-0.453-1-1s0.453-1 1-1h4v-2.063c-4.5-0.5-8-4.312-8-8.937v-2c0-0.547 0.453-1 1-1s1 0.453 1 1v2c0 3.859 3.141 7 7 7s7-3.141 7-7v-2c0-0.547 0.453-1 1-1s1 0.453 1 1zM14 5v8c0 2.75-2.25 5-5 5s-5-2.25-5-5v-8c0-2.75 2.25-5 5-5s5 2.25 5 5z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="microphone-1-text_">
                                    <div class="icon-text-1">
                                        <h3 class="ct-bold-text"><?php the_field('get_easily_title');?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="ct-row">
                                <div class="ct-microphone-text-1 pd-1">
                                    <?php 
                                    $i=0;
                                    $j=['','','','tcb-numbered-list-index',''];
                                    ?>
                                    <ul>
                                        <?php

                                    // check if the repeater field has rows of data
                                        if( have_rows('test_list') ):

                                        // loop through the rows of data
                                            while ( have_rows('test_list') ) : the_row();?>

                                                <li>
                                                    <span class="<?php echo $j[$i];?>">

                                                        <?php the_sub_field('number_list');?></span>
                                                        <div>
                                                            <strong><?php the_sub_field('number_text');?></strong>
                                                        </div>

                                                    </li>
                                                    <?php 
                                                    $i++;
                                                endwhile;
                                            else :
                                            endif;
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="ct-row">
                                    <div class="mic-work-not">
                                        <p><?php the_field('red_line_text');?></p>
                                    </div>
                                    <?php if(get_field('having_problems_option')==true){?>
                                        <div class="dis-flex">
                                            <div class="width-15">
                                                <div class="arrow-down-icon">
                                                    <a href="<?php the_field('having_problems_link');?>">
                                                        <div class="icon-down">
                                                            <svg class="ct-icon" viewBox="0 0 12 28" data-name="long-arrow-down">
                                                                <path d="M11.953 20.297c0.078 0.187 0.047 0.391-0.078 0.547l-5.469 6c-0.094 0.094-0.219 0.156-0.359 0.156v0c-0.141 0-0.281-0.063-0.375-0.156l-5.547-6c-0.125-0.156-0.156-0.359-0.078-0.547 0.078-0.172 0.25-0.297 0.453-0.297h3.5v-19.5c0-0.281 0.219-0.5 0.5-0.5h3c0.281 0 0.5 0.219 0.5 0.5v19.5h3.5c0.203 0 0.375 0.109 0.453 0.297z"></path>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="width-68">
                                                <div class="icon-down-text pd-1">
                                                    <p>
                                                        <a href="<?php the_field('having_problems_link');?>"><?php the_field('having_problems');?></a>
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    <?php }else{}?>
                                </div>
                            </div>
                            <div class="width-48 wid-md-50 pad-left-15 wid-xs-100 canvas-section">
                                <div class="ct-row dis-flex">
                                    <div class="width-45 wid-xs-30 pad-left-15">
                                        <div class="microphone-icon fl-right">
                                            <svg class="ct-icon" viewBox="0 0 18 28" data-name="microphone">
                                                <path d="M18 11v2c0 4.625-3.5 8.437-8 8.937v2.063h4c0.547 0 1 0.453 1 1s-0.453 1-1 1h-10c-0.547 0-1-0.453-1-1s0.453-1 1-1h4v-2.063c-4.5-0.5-8-4.312-8-8.937v-2c0-0.547 0.453-1 1-1s1 0.453 1 1v2c0 3.859 3.141 7 7 7s7-3.141 7-7v-2c0-0.547 0.453-1 1-1s1 0.453 1 1zM14 5v8c0 2.75-2.25 5-5 5s-5-2.25-5-5v-8c0-2.75 2.25-5 5-5s5 2.25 5 5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="width-55 pad-left-15 wid-xs-50">
                                        <div class="icon-text-2">
                                            <h3 class="ct-bold-text"><?php the_field('the_test');?></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="audio-block-1">
                                    <div id="audio-div" class="microphone-canvas">
                                        <div id="audio-start" style="width: 100%; height: 100%; position: absolute; padding-right: 4px; background: rgba(0, 0, 0, 0.8) url('data:image/png;base64,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') no-repeat scroll center center;"></div>
                                        <p id="audio-info">Waiting for microphone...</p>
                                        <canvas id="audio-canvas" class="audio_canvas" width="458" height="164"></canvas>
                                    </div>
                                </div>

                                <div class="audio-block-2">
                                    <div>
                                        <h3><strong><?php the_field('rightside_your_privacy_title');?></strong></h3>
                                        <p ><strong><?php the_field('rightside_desc');?></strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="width-12 pad-left-15 md-hidden">
                            </div>
                        </div>
                        <div class="microphone-2 dis-flex">
                            <div class="mic-2-text width-40 wid-md-50 wid-xs-100">
                                <div class="pad-left-15">
                                    <div class="mic-2-title">
                                        <h3 id="moreExplanation" class="ct-bold-text"><?php the_field('the_long_explanation');?></h3>
                                    </div>
                                    <div class="mic-2-desc">
                                        <ul>
                                            <?php

                                    // check if the repeater field has rows of data
                                            if( have_rows('long_explanation_list') ):

                                        // loop through the rows of data
                                                while ( have_rows('long_explanation_list') ) : the_row();?>

                                                    <li>
                                                        <span class="mic-li-text">
                                                            <?php the_sub_field('explanation_list_desc');?>
                                                        </span>
                                                            <!-- </li>
                                                            <li >
                                                                <span class="mic-li-text">
                                                                    
                                                                </span><br>
                                                            </li>
                                                            <li>
                                                                <span class="mic-li-text">
                                                                    
                                                                </span>
                                                            </li> -->
                                                        <?php endwhile;
                                                    else :
                                                    endif;
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mic-2-ads width-60 wid-md-50 wid-xs-100">
                                        <div class="ads_">
                                            <div class="text-center">
                                                <style>
                                                    .OMT_MOINSBD_Middle { width: 300px; height: 250px; }
                                                    @media(min-width: 500px) { .OMT_MOINSBD_Middle { width: 300px; height: 250px; } }
                                                    @media(min-width: 800px) { .OMT_MOINSBD_Middle { width: 300px; height: 250px; } }
                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="advertising_banner">
                                <div class="text-center">
                                    <style>
                                        .OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }
                                        @media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }
                                        @media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }
                                    </style>
                                </div>
                            </div>

                            <div class="trouble-shooting">
                                <div class="trouble-shooting-1 dis-flex">
                                    <div class="width-13 wid-xs-20"> 
                                        <div class="microphone-icon">
                                            <svg class="ct-icon" viewBox="0 0 18 28" data-name="microphone">
                                                <path d="M18 11v2c0 4.625-3.5 8.437-8 8.937v2.063h4c0.547 0 1 0.453 1 1s-0.453 1-1 1h-10c-0.547 0-1-0.453-1-1s0.453-1 1-1h4v-2.063c-4.5-0.5-8-4.312-8-8.937v-2c0-0.547 0.453-1 1-1s1 0.453 1 1v2c0 3.859 3.141 7 7 7s7-3.141 7-7v-2c0-0.547 0.453-1 1-1s1 0.453 1 1zM14 5v8c0 2.75-2.25 5-5 5s-5-2.25-5-5v-8c0-2.75 2.25-5 5-5s5 2.25 5 5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="width-87 wid-xs-80">
                                        <h3 class="ct-bold-text"><?php the_field('trouble-shooting_guide');?></h3>
                                    </div>
                                </div>

                                <div class="trouble-shooting-2 dis-flex">
                                    <div class="width-33_3 wid-md-50 wid-xs-100">
                                        <div class="trouble-shooting-text-1 pd-1">
                                            <ul>
                                                <li >
                                                    <span class="fw-600">​</span>
                                                    <span class="fw-600"><?php the_field('steps_title');?><br>
                                                    </span><br>
                                                    <?php

                                    // check if the repeater field has rows of data
                                                    if( have_rows('steps') ):

                                        // loop through the rows of data
                                                        while ( have_rows('steps') ) : the_row();?>
                                                            <span class="fw-600"><?php the_sub_field('step_no');?></span> 
                                                            <?php the_sub_field('step_desc');?><br><br>
                                                    <!-- <span class="fw-600">Step 2.</span> 
                                                    Reload the page and try again. In many cases that solves it.<br><br>
                                                    <span class="fw-600">Step 3.</span> If nothing helped please check if your microphone is connected. -->
                                                <?php endwhile;
                                            else :
                                            endif;
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="width-33_3 wid-md-50  wid-xs-100">
                                <div class="trouble-shooting-text-2 pd-1">
                                    <ul>
                                        <li>
                                            <?php the_field('right_side_mic_setup_desc');?>
                                            <br><br><span class="fw-600"><?php the_field('rightside_steps');?><br><br></span>
                                            <?php

                                                // check if the repeater field has rows of data
                                            if( have_rows('rightside_steps-') ):

                                                    // loop through the rows of data
                                                while ( have_rows('rightside_steps-') ) : the_row();?>
                                                    <span class="fw-600"><?php the_sub_field('rightside_steps_no');?>
                                                </span> <?php the_sub_field('rightside_steps_desc');?><br><br>
                                                    <!-- <span class="fw-600">Step 2.</span> Check that your microphone is connected to the correct (normally pink) socket in your computer. If it's a mic with a USB connector just make sure it is properly connected to the USB socket (you will not use the pink microphone in this case).<br><br>
                                                    <span class="fw-600">Step 3.</span> Check that your microphone is not muted - sometimes the mic has a mute button on it or on the wire that is connected to it.<br><br>
                                                    <span class="fw-600">Step 4.</span>?><br> -->
                                                <?php endwhile;
                                            else :
                                            endif;
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="width-33_3 md-hidden">
                            </div>
                        </div>
                    </div>

                    <div class="other-section">
                        <div class="ct-row mic-settings-title">
                            <span><?php the_field('tried_the_steps');?></span>
                        </div>
                        <div class="mic-settings-section">
                            <div class="mic-settings-menu width-50 wid-md-100">
                                <ul>
                                    <?php

                                                // check if the repeater field has rows of data
                                    if( have_rows('mic_setting_windows') ):

                                                    // loop through the rows of data
                                        while ( have_rows('mic_setting_windows') ) : the_row();?>
                                            <li class="dis-flex">
                                                <div class="mic-menu-icon">
                                                    <svg class="tcb-icon" viewBox="0 0 18 28" data-name="microphone">
                                                        <path d="M18 11v2c0 4.625-3.5 8.437-8 8.937v2.063h4c0.547 0 1 0.453 1 1s-0.453 1-1 1h-10c-0.547 0-1-0.453-1-1s0.453-1 1-1h4v-2.063c-4.5-0.5-8-4.312-8-8.937v-2c0-0.547 0.453-1 1-1s1 0.453 1 1v2c0 3.859 3.141 7 7 7s7-3.141 7-7v-2c0-0.547 0.453-1 1-1s1 0.453 1 1zM14 5v8c0 2.75-2.25 5-5 5s-5-2.25-5-5v-8c0-2.75 2.25-5 5-5s5 2.25 5 5z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <a href="<?php the_sub_field('url');?>">
                                                        <?php the_sub_field('windows_name');?></a>
                                                    </div>

                                                </li>
                                            <?php endwhile;
                                        else :
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="ct-row mic-settings-title">
                                <span><?php the_field('software_guides_title');?></span>
                            </div>
                            <div class="mic-settings-section">
                                <div class="mic-settings-menu width-50 wid-md-100">
                                    <ul>
                                        <?php

                                                // check if the repeater field has rows of data
                                        if( have_rows('software_guides_links') ):

                                                    // loop through the rows of data
                                            while ( have_rows('software_guides_links') ) : the_row();?>
                                                <li class="dis-flex">
                                                    <div class="mic-menu-icon">
                                                        <svg class="tcb-icon" viewBox="0 0 18 28" data-name="microphone">
                                                            <path d="M18 11v2c0 4.625-3.5 8.437-8 8.937v2.063h4c0.547 0 1 0.453 1 1s-0.453 1-1 1h-10c-0.547 0-1-0.453-1-1s0.453-1 1-1h4v-2.063c-4.5-0.5-8-4.312-8-8.937v-2c0-0.547 0.453-1 1-1s1 0.453 1 1v2c0 3.859 3.141 7 7 7s7-3.141 7-7v-2c0-0.547 0.453-1 1-1s1 0.453 1 1zM14 5v8c0 2.75-2.25 5-5 5s-5-2.25-5-5v-8c0-2.75 2.25-5 5-5s5 2.25 5 5z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <a href="<?php the_sub_field('url');?>">
                                                            <?php the_sub_field('software_name');?></a>
                                                        </div>

                                                    </li>
                                                <?php endwhile;
                                            else :
                                            endif;
                                            ?>
                                        </ul>
                                    </div>
                                </div>

                                <!--<div class="vs-mobile the-thumb">
                                    <img class="lazyload" src="<?php echo get_template_directory_uri();?>/assets/image/lazy.gif" data-src="<?php echo get_template_directory_uri();?>/assets/image/The-thumb.png">
                                </div>-->
                                <div class="read-more-section">
                                    <div class="ct-row dis-flex">
                                        <div class="width-50 wid-xs-100">
                                            <div class="read-more-text-secction">
                                                <div class="read-more-title" >
                                                    <h2><strong><?php the_field('read_this_title');?></strong></h2>
                                                </div>
                                                <?php 
                                                $class=0;
                                                $add=['1','2','3','3','4'];
                                                ?>
                                                <?php

                                                // check if the repeater field has rows of data
                                                if( have_rows('learn_more') ):

                                                    // loop through the rows of data
                                                    while ( have_rows('learn_more') ) : the_row();?>
                                                        <div class="read-more-<?php echo $add[$class];?>">


                                                            <div class="read-more-subtitle">
                                                                <h4 class="ct-bold-text mar-bot-20"><?php the_sub_field('title');?></h4>
                                                            </div>

                                                            <div class="read-more-text">
                                                                <?php the_sub_field('descp');?>
                                                            </div>

                                                        </div>
                                                        <?php 
                                                        $class++;
                                                    endwhile;
                                                else :
                                                endif;
                                                ?>

                                            </div>
                                        </div>


                                        <div class="width-50">
                                            <div class="img-section pad-left-15">
                                                <img class="lazyload" src="<?php the_field('rightside_image');?>" data-src=""/>
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

        <!-- <link href="https://fonts.googleapis.com/css?display=swap&family=Open+Sans+Condensed:300,300i,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet"> 
            <script src="<?php echo get_template_directory_uri();?>/assets/MicTest.js.min"></script>-->
            <?php get_footer();