<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8">

    <meta property="og:site_name" name="og:site_name" content="Online Mic Test" data-app="true" />
    <meta name="google-site-verification" content="iFf63cPqYNrdHaUvI_npfKkC6xC3PvPm1H0p-Nl-bh8" />
    <meta name = "naver-site-verification" content = "" />
    <?php wp_head();?>

    <link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/image/cropped-OMT-logo-white-on-blue-32x32.png" sizes="32x32" />
    <link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/image/cropped-OMT-logo-white-on-blue-192x192.png" sizes="192x192" />

    <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri();?>/assets/image/cropped-OMT-logo-white-on-blue-180x180.png" />
	<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery/jquery.js'></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/css/custom-form.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<?php
	$uri = $_SERVER['REQUEST_URI'];
	$searchString = '/ar';

	if(strpos($uri, $searchString) !== false) {
	?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/css/responsive-layout-ar.css">
	<?php 
	}
	?>
	
    <!-- End of AdThrive Head Tag -->
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/images/ul2_f_black.png">
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/images/ul4_f_black.png">
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/images/toggle_closed.png">
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/images/toggle_open.png">

    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/icons/chevron-right-solid.svg" type="image/svg+xml">
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/icons/facebook-f-brands.svg" type="image/svg+xml">
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/icons/pinterest-brands.svg" type="image/svg+xml">
    <link  rel="preload" as="image" href="<?php echo get_stylesheet_directory_uri();?>/assets/icons/twitter-brands.svg" type="image/svg+xml">
</head>

<body <?php body_class(); ?>>
    <?php 
    global $template;
    $template_name = basename($template);
    ?>
	
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
                        <?php dynamic_sidebar('logo-ms');?> 
						<?php dynamic_sidebar('logo-ar');?> 
                        <?php dynamic_sidebar('logo-pl');?> 
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
										<?php
											$seo_title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
										?>
                                        <a rel="nofollow" target="_blank" 
										   href="https://twitter.com/intent/tweet?text=<?= urlencode($seo_title);?>&url=<?= get_the_permalink();?>" 
										   data-link="https://twitter.com/intent/tweet?text=<?= urlencode($seo_title);?>&url=<?= get_the_permalink();?>" class="nc_tweet">
                                            <span class="swp_count swp_hide" style="transition: padding 0.1s linear;">
                                                <span class="iconFiller">
                                                    <span class="spaceManWilly">
                                                        <i class="sw swp_twitter_icon"></i>
                                                        <span class="swp_share">Tweet</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="nc_tweetContainer swp_facebook" data-network="facebook">
                                        <a rel="nofollow" target="_blank" 
										   href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_the_permalink()); ?>"
										   data-link="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_the_permalink()); ?>" class="nc_tweet">
                                            <span class="iconFiller">
                                                <span class="spaceManWilly">
                                                    <i class="sw swp_facebook_icon"></i>
                                                    <span class="swp_share">Share</span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
									<div class="nc_tweetContainer swp_pinterest" data-network="pinterest">
										<a rel="nofollow" class="nc_tweet noPop" onclick="if (window.pinmarklet) pinmarklet(); else pinterestShare()">
											<span class="swp_count swp_hide" style="transition: padding 0.1s linear;">
												<span class="iconFiller">
													<span class="spaceManWilly">
														<i class="sw swp_pinterest_icon"></i>
														<span class="swp_share">Pin</span>
													</span>
												</span>
											</span>
										</a>
										<script>
											const pinterestShare = () => {
												let e = document.createElement('script');
												e.setAttribute('type', 'text/javascript');
												e.setAttribute('charset', 'UTF-8');
												e.onload = () => {};
												e.onerror = () => {};
												e.setAttribute('src', '//assets.pinterest.com/js/pinmarklet.js?r=' + Math.random() * 99999999);
												e.setAttribute('url', null);
												document.body.appendChild(e);
											};
										</script>
									</div>
								</div>
							</div>
						</div>
						<div class="content-area">
							<?php 
							if($template_name != 'page.php' && $template_name != 'about.php' && $template_name != 'contact.php' && $template_name != 'privacy.php'){
							?>
							<div class="breadcrumbs">
								<div class="breadcrumbs-row dis-flex">
									<div class="sub-title">
										<h2>
											<?php 
								if(!empty(get_field('sub_title'))){
									the_field('sub_title');                                         
								} else if(!empty(get_field('subtitle'))){
									the_field('subtitle');
								} else if(!empty(get_field('microphone_sub_title'))){
									the_field('microphone_sub_title');
								} else if(!empty(get_field('note'))){
									the_field('note');
								} else {
									the_field('subheading');
								}
											?>
										</h2>
									</div>
									<div class="languages">
										<?php dynamic_sidebar('languages'); ?>
									</div>
								</div>
							</div>
							<?php } ?>

