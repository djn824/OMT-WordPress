<?php /*Template Name:Keyboard test and guide*/
get_header('keyboard');
?>

<body <?php body_class( 'keyboard-test' ); ?>>
    <div class="full-width">
        <div class="left-sidebar">
            <div class="sAs left scol">
                <div class="sAsdmy"></div>
                <div class="sAsin">
                    <div class="msd">
                        <?php dynamic_sidebar('logo-en');?>
                        <?php dynamic_sidebar('logo-es');?>
                        <?php dynamic_sidebar('logo-de');?>
                        <?php dynamic_sidebar('logo-fr');?>
                        <?php dynamic_sidebar('logo-hi');?>
                        <?php dynamic_sidebar('logo-zh');?>
                        <?php dynamic_sidebar('logo-ja');?>
                        <?php dynamic_sidebar('logo-ko');?>
                        <?php dynamic_sidebar('logo-vi');?>
                        <?php dynamic_sidebar('logo-ru');?>

                        <div class="sb">
                            <a href="" class="sbm hbd"></a>
                            <a href="" class="sbs hbd"></a>

                            <form action="<?php echo get_site_url(); ?>" method="get" class="msh" style="display: none;">
                                <div>
                                    <input type="text" placeholder="Search..." class="search-field" name="s">
                                    <button type="submit" class="search-button"></button>
                                    <div class="clear"></div>
                                </div>
                            </form>
                        </div>
                        <nav class="menu-sidebar-nav-container">
                            <?php
                            $defaults = array(
                                'theme_location' => 'primary',
                                'menu' => 'Left-side-menu',
                                'container' => '',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => '',
                                'menu_id' => '',
                                'echo' => true,
                                'fallback_cb' => 'wp_page_menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'items_wrap' => '<ul id="menu-sidebar-nav" class="menu">%3$s</ul>',
                                'depth' => 0,
                                'walker' => ''
                            );
                            wp_nav_menu($defaults);
                            ?>

                        </nav>
                        <div class="clearfix"></div>
                    </div>
                    <div class="wsd" id="scrollingWidgets">
                        <div class="viewport">
                            <div class="scroll-wrapper overview scrollbar-chrome" style="position: absolute;">
                                <div class="overview scrollbar-chrome scroll-content scroll-scrolly_visible"
                                style="height: auto; margin-bottom: 0px; margin-right: 0px;">
                                <section id="custom_html-2">
                                    <div class="widget_text scn">
                                        <div class="textwidget custom-html-widget">
                                        </div>
                                    </div>
                                </section>
                                <div class="clear"></div>
                            </div>
                            <div class="scroll-element scroll-x scroll-scrolly_visible">
                                <div class="scroll-element_outer">
                                    <div class="scroll-element_size"></div>
                                    <div class="scroll-element_track"></div>
                                    <div class="scroll-bar" style="width: 240px;"></div>
                                </div>
                            </div>
                            <div class="scroll-element scroll-y scroll-scrolly_visible">
                                <div class="scroll-element_outer">
                                    <div class="scroll-element_size"></div>
                                    <div class="scroll-element_track"></div>
                                    <div class="scroll-bar" style="height: 0px; top: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section bSe fullWidth">
        <div class="wrap">
            <article>
                <div class="cnt content">
                    <div class="dis-flex">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="top-social_block">
                            <div class="swp_social_panel swp_flat_fresh swp_default_full_color swp_individual_full_color swp_other_full_color scale-100 scale- swp_one"
                            data-position="none" data-float="none" data-float-mobile="none" data-count="0"
                            data-floatcolor="#ffffff">
                            <div class="nc_tweetContainer swp_twitter" data-network="twitter">
                                <a rel="nofollow" target="_blank"
                                href="https://twitter.com/intent/tweet?text=Keyboard+Test&url=<?php echo get_site_url(); ?>/keyboard-test/"
                                data-link="https://twitter.com/intent/tweet?text=Keyboard+Test&url=https:<?php echo get_site_url(); ?>/keyboard-test/"
                                class="nc_tweet"><span class="swp_count swp_hide"><span class="iconFiller"><span
                                    class="spaceManWilly"><i class="sw swp_twitter_icon"></i><span
                                    class="swp_share">Tweet</span></span></span></span></a>
                                </div>
                                <div class="nc_tweetContainer swp_facebook" data-network="facebook">
                                    <a rel="nofollow" target="_blank"
                                    href="http://www.facebook.com/share.php?u=<?php echo get_site_url(); ?>/keyboard-test/"
                                    data-link="http://www.facebook.com/share.php?u=<?php echo get_site_url(); ?>/keyboard-test/"
                                    class="nc_tweet"><span class="iconFiller"><span class="spaceManWilly"><i
                                        class="sw swp_facebook_icon"></i><span
                                        class="swp_share">Share</span></span></span></a>
                                    </div>
                                    <div class="nc_tweetContainer swp_pinterest" data-network="pinterest">
                                        <a rel="nofollow" class="nc_tweet noPop" onclick="var e=document.createElement('script');
                                        e.setAttribute('type','text/javascript');
                                        e.setAttribute('charset','UTF-8');
                                        e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);
                                        document.body.appendChild(e);">
                                        <span class="swp_count swp_hide" style="transition: padding 0.1s linear;">
                                            <span class="iconFiller">
                                               <span class="spaceManWilly">
                                                  <i class="sw swp_pinterest_icon"></i>
                                                  <span class="swp_share">Pin</span>
                                              </span>
                                          </span>
                                      </span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="content-area">

                    <div class="breadcrumbs">
                        <div class="breadcrumbs-row dis-flex">
                            <div class="sub-title">
                                <h2><?php the_field('sub_title'); ?></h2>
                            </div>
                            <div class="languages">
                                <?php dynamic_sidebar('language'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="keyboard-section">
                        <div id="tve_flt" class="tve_flt">
                            <div id="tve_editor" class="tve_shortcode_editor">
                                <div class="thrv_wrapper thrv_contentbox_shortcode thrv-content-box">
                                    <div class="tve-content-box-background"></div>
                                    <div class="tve-cb tve_empty_dropzone" data-css="tve-u-161806d1600">
                                        <div class="thrv_wrapper thrv_contentbox_shortcode thrv-content-box"
                                        data-css="tve-u-1618570d285">
                                        <div class="tve-content-box-background"></div>
                                        <div class="tve-cb tve_empty_dropzone" data-css="tve-u-16185479c93">
                                            <div class="thrv_wrapper thrv_custom_html_shortcode"
                                            data-css="tve-u-161806d41a7">
                                            <code class="tve_js_placeholder">
                                                <script>
                                                    $(function () {
                                                        $.keyboard.layouts.numpad = {
                                                            'normal': [
                                                            '{clear} / * -',
                                                            '7 8 9 +',
                                                            '4 5 6 %',
                                                            '1 2 3 =',
                                                            '0 . {left} {right}'
                                                            ]
                                                        };
                                                        $('#keyboard').keyboard({
                                                            appendTo: '.tve-content-box-background',
                                                            alwaysOpen: true,
                                                            autoAccept: true,
                                                            layout: 'custom',
                                                            toggleMode: true,
                                                            enterNavigation: false,
                                                            customLayout: {
                                                                'normal': [
                                                                'ESC F1 F2 F3 F4 F5 F6 F7 F8 F9 F10 F11 F12 prtSc Home',
                                                                '` 1 2 3 4 5 6 7 8 9 0 - = {bksp} Ins PgUp',
                                                                '{tab} q w e r t y u i o p [ ] \\ {del} PgDn',
                                                                'Caps a s d f g h j k l ; \' {enter} &uarr; Pause',
                                                                '{shift} z x c v b n m , . / {shift} {left} &darr; {right}',
                                                                'Ctrl {alt} {space} {alt} Ctrl NmLk ScrlLk'
                                                                ],
                                                            },
                                                            display: {
                                                                'extender': ' :toggle_numpad'
                                                            }
                                                        }).addTyping({
                                                            showTyping: true,
                                                            hoverDelay: 100000000000000000
                                                        })
                                                        .addExtender({
                                                            layout: 'numpad',
                                                            showing: true,
                                                            reposition: true
                                                        });
                                                        $(".ui-keyboard-extender").addClass("ui-keyboard-keyset");
                                                        $(document).on('keypress', function (e) {
                                                            var y = e.which;
                                                            var x = String.fromCharCode(y) || y;
                                                            if ((0 <= x && x <= 9) || y == 45) {
                                                                var el = $(".ui-keyboard-keyset-normal .ui-keyboard-" + x);
                                                                if (y != 45 && el.hasClass("ui-state-hover")) {
                                                                    el.removeClass("ui-state-hover");
                                                                    if (el.attr("style")) {
                                                                        el.addClass("ui-state-hover");
                                                                    }
                                                                }
                                                            } else if (y == 47 || y == 46 || y == 42 || y == 43 || y == 37 || y == 61) {
                                                                $(".ui-keyboard-extender .ui-keyboard-" + y).addClass("ui-state-hover");
                                                            }
                                                            $(".ui-keyboard-button.ui-state-hover").hover(function () {
                                                                $(this).removeAttr("style");
                                                            }, function () {
                                                                $(this).addClass("ui-state-hover");
                                                            });
                                                        });
                                                        $(document).keydown(function (e) {
                                                            var z = String.fromCharCode(e.which);
                                                            if (e.which == 33) {
                                                                $(".ui-keyboard-PgUp").addClass("ui-state-hover");
                                                            } else if (e.which == 34) {
                                                                $(".ui-keyboard-PgDn").addClass("ui-state-hover");
                                                            } else if (0 <= z && z <= 9) {
                                                                $(".ui-keyboard-keyset-normal .ui-keyboard-" + z).addClass("ui-state-hover").css('background', '#c5dbec');
                                                            }
                                                            $(".ui-keyboard-button.ui-state-hover").hover(function () {
                                                                            // $(this).removeAttr("style");
                                                                        }, function () {
                                                                            $(this).addClass("ui-state-hover");
                                                                        });
                                                        });
                                                        $(document).keyup(function (e) {
                                                            if (e.which == 44) {
                                                                $(".ui-keyboard-prtSc").addClass("ui-state-hover");
                                                            }
                                                        });
                                                    });
                                                </script>
                                            </code>
                                            <div id="wrap">
                                                <textarea id="keyboard" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="keyboard-test-info dis-flex">
                    <div class="keyboard-info-1 wid-xs-100">
                        <div class="keyboard-info-1-img">
                            <img alt="" width="100" height="67" title="keyboard icon"
                            src="<?php the_field('leftside_keyboard_icon'); ?>">
                        </div>
                        <div class="keyboard-info-1-title">
                            <div class="pd-1">
                                <h3><?php the_field('leftside_keyboard_info_title1'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="keyboard-info-2 wid-xs-100">
                        <div class="keyboard-info-2-text">
                            <ul>
                                <?php

                                // check if the repeater field has rows of data
                                if (have_rows('rightside_desc')):

                                    // loop through the rows of data
                                    while (have_rows('rightside_desc')) : the_row(); ?>
                                        <li class="dis-flex">
                                            <div class="keyboard-list-icon">
                                                <svg class="tcb-icon" viewBox="0 0 23 28"
                                                data-name="arrow-right">
                                                <path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
                                            </svg>
                                        </div>
                                        <span class="keyboard-list-text">
                                           <?php the_sub_field('desc'); ?>
                                       </span>
                                   </li>
                                   <?php
                               endwhile;
                           else :
                           endif;
                           ?>
                       </ul>
                   </div>
               </div>
           </div>

           <div class="keyboard-test-info dis-flex">
            <div class="keyboard-info-1 wid-xs-100">
                <div class="keyboard-info-1-title">
                    <div class="pd-1">
                        <h3><?php the_field('leftside_keyboard_info_title2'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="keyboard-info-2 wid-xs-100">
                <div class="keyboard-info-2-text">
                    <ul>
                        <li class="dis-flex">
                            <div class="keyboard-list-icon">
                                <svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
                                    <path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
                                </svg>
                            </div>
                            <span class="keyboard-list-text">
                               <?php the_field('rightside_desc2'); ?>
                           </span>
                       </li>
                   </ul>
               </div>
           </div>
       </div>

   </div>

   <?php
   $guides = get_field('guides');
   if (!empty($guides)) {
    foreach ($guides as $guide) {
        if ('windows-xp' === $guide['guide_type']) {
            set_query_var('windows_xp', $guide['windows_xp']);
            get_template_part('template-parts/guides/windows-xp');

        } else if ('windows-vista' === $guide['guide_type']) {
            set_query_var('windows_vista', $guide['windows_vista']);
            get_template_part('template-parts/guides/windows-vista');

        } else if ('windows-7' === $guide['guide_type']) {
            set_query_var('windows_7', $guide['windows_7']);
            get_template_part('template-parts/guides/windows-7');

        } else if ('windows-8' === $guide['guide_type']) {
            set_query_var('windows_8', $guide['windows_8']);
            get_template_part('template-parts/guides/windows-8');

        } else if ('ubuntu' === $guide['guide_type']) {
            set_query_var('ubuntu', $guide['ubuntu']);
            get_template_part('template-parts/guides/ubuntu');

        } else if ('mac-os-x' === $guide['guide_type']) {
            set_query_var('mac_os_x', $guide['mac_os_x']);
            get_template_part('template-parts/guides/mac-os-x');
        }
    }
} ?>
</div>
</article>
</div>
</div>

<?php get_footer('2'); ?>