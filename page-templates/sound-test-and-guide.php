<?php /* Template Name: Sound test and guide */
get_header();?>
<style><?php //the_field('css');?></style>



<body <?php body_class( 'sound-test' ); ?>>
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

                        <form action="<?php echo get_site_url();?>" method="get" class="msh" style="display: none;">
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
                            'theme_location'  => 'primary',
                            'menu'            => 'Left-side-menu',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => '',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_page_menu',
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="menu-sidebar-nav" class="menu">%3$s</ul>',
                            'depth'           => 0,
                            'walker'          =>''
                        );
                        wp_nav_menu( $defaults );
                        ?>

                    </nav>
                    <div class="clearfix"></div>
                </div>
                <div class="wsd" id="scrollingWidgets">
                    <div class="viewport">
                        <div class="scroll-wrapper overview scrollbar-chrome" style="position: absolute;">
                            <div class="overview scrollbar-chrome scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: 0px; margin-right: 0px;">
                                <section id="custom_html-2">
                                    <div class="widget_text scn">
                                        <div class="textwidget custom-html-widget">
                                        </div>
                                    </div>
                                </section>
                                <div class="clear"></div>
                            </div>
                            <div class="scroll-element scroll-x scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="width: 240px;"></div></div></div><div class="scroll-element scroll-y scroll-scrolly_visible"><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar" style="height: 0px; top: 0px;"></div></div></div>
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
                        <h1 class="entry-title"><?php the_title();?></h1>
                        <div class="top-social_block">
                            <div class="swp_social_panel swp_flat_fresh swp_default_full_color swp_individual_full_color swp_other_full_color scale-100 scale- swp_one" data-position="none" data-float="none" data-float-mobile="none" data-count="0" data-floatcolor="#ffffff">
                                <div class="nc_tweetContainer swp_twitter" data-network="twitter">
                                    <a rel="nofollow" target="_blank" href="https://twitter.com/intent/tweet?text=Sound+Test&url=<?php echo get_site_url();?>/sound-test/" data-link="https://twitter.com/intent/tweet?text=Sound+Test&url=<?php echo get_site_url();?>/sound-test/" class="nc_tweet"><span class="swp_count swp_hide"><span class="iconFiller"><span class="spaceManWilly"><i class="sw swp_twitter_icon"></i><span class="swp_share">Tweet</span></span></span></span></a>
                                </div>
                                <div class="nc_tweetContainer swp_facebook" data-network="facebook">
                                    <a rel="nofollow" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo get_site_url();?>/sound-test/" data-link="http://www.facebook.com/share.php?u=<?php echo get_site_url();?>/sound-test/" class="nc_tweet"><span class="iconFiller"><span class="spaceManWilly"><i class="sw swp_facebook_icon"></i><span class="swp_share">Share</span></span></span></a>
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
                        <?php get_template_part('template-parts/tests/sound') ?>

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
                </div>
            </article>
        </div>
    </div>


<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/SpeakersTest.js"></script>
<?php
get_footer();?>