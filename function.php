<?php

/**
 * Preload fonts in header
 **/
function wpb_preload_local_fonts() {
    $uri = get_stylesheet_directory_uri();
    $url =  parse_url( $uri );
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Open-Sans-Condensed-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/OpenSansCondensed-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Raleway-Thin-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/RalewayThinMedium.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Raleway-ThinRegular.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Raleway-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Raleway-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Raleway-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
    echo '<link rel="preload" href="' . $uri . '/assets/fonts/Lato-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">';
}

add_action( 'wp_head', 'wpb_preload_local_fonts' );

/**
 * Enqueue scripts and styles
 */
function wpb_load_scripts() {

    //Scripts
    if ( is_page_template( 'page-templates/home.php' ) || is_page_template( 'page-templates/microphone-test-and-guide-cases.php' )  ) {
        wp_enqueue_script( 'mictest', get_stylesheet_directory_uri() . '/assets/js/MicTest.min.js', '', '', true );
    }

    if ( is_page_template( 'page-templates/Webcam-test.php' ) || is_page_template( 'page-templates/online_mirror.php' ) || is_page_template( 'page-templates/webcam-test-and-guide-cases.php' ) || is_page_template( 'page-templates/webcam-test-and-guide.php' )  ) {
        wp_enqueue_script( 'webcamtest', get_stylesheet_directory_uri() . '/assets/js/WebcamTest.js', '', '', true );
        wp_enqueue_script( 'fullscreen-js', get_stylesheet_directory_uri() . '/assets/js/full_screen.js', '', '', true );
    }

    //wp_enqueue_script( 'wp-jquery', get_stylesheet_directory_uri() . '/assets/js/jquery/jquery.js', '', '', true );
	wp_enqueue_script( 'wp-jquery-migrate', get_stylesheet_directory_uri() . '/assets/js/jquery/jquery-migrate.min.js', '', '', true );
    wp_enqueue_script( 'frontend-js', get_stylesheet_directory_uri() . '/assets/js/frontend.min.js', '', '', true );
    wp_enqueue_script( 'responsive-menu-js', get_stylesheet_directory_uri() . '/assets/js/responsive_menu_hamburger.js', '', '', true );

    wp_enqueue_script( 'wpb-social-script-js', get_stylesheet_directory_uri() . '/assets/js/social-warfare/script.min.js?ver=3.0.9', '', '', true );
    wp_enqueue_style( 'wpb-base-style', get_stylesheet_directory_uri() . '/assets/css/responsive-menu.css' );

    if ( is_page_template( 'page-templates/tone-generator-main.php' ) ) {
        wp_enqueue_style( 'tone-generator-main-style', get_stylesheet_directory_uri() . '/assets/css/tone-generator-main.css' );
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
        wp_enqueue_script( 'tone-generator-main-js', get_stylesheet_directory_uri() . '/assets/js/tone-generator-main-script.js', '', '', true );
    }
	
	if ( is_page_template( 'page-templates/keyboard-test-new.php' ) ) {
		wp_enqueue_style( 'noise-generator-main-style', get_stylesheet_directory_uri() . '/assets/css/keyboard-layout.css' );
	}
	
	if ( is_page_template( 'page-templates/white-noise-generator.php' ) ) {
		wp_enqueue_style( 'noise-generator-main-style', get_stylesheet_directory_uri() . '/assets/css/noise-generator-main.css' );
		wp_enqueue_script( 'white-noise-js', get_stylesheet_directory_uri() . '/assets/js/noise/white-noise.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/vibration-test.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/online-gyroscope.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/online-accelerometer.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/multi-touch-test.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/controller-gyroscope.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}

	if ( is_page_template( 'page-templates/fps-test.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/all-tools.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/metronome.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/stuck-pixel-fixer.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
	
	if ( is_page_template( 'page-templates/piano-typing-tool.php' ) ) {
        wp_enqueue_style( 'bootstrap-min-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-min-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', '', '', true );
	}
}

/**
 * Deque styles
 **/
function wpb_deque_styles() {
    wp_dequeue_style( 'twentynineteen-style' );
    wp_dequeue_style( 'twentynineteen-print-style' );
}

/**
 * Deque scripts
 **/
function wpb_deque_scripts() {
    wp_dequeue_script( 'jquery-migrate' );
    wp_deregister_script( 'jquery-migrate' );
    wp_dequeue_script( 'wp-emojis' );
    wp_deregister_script( 'wp-emojis' );
    wp_dequeue_script( 'twentynineteen-touch-navigation' );
    wp_deregister_script( 'twentynineteen-touch-navigation' );
    wp_dequeue_script( 'twentynineteen-priority-menu' );
    wp_deregister_script( 'twentynineteen-priority-menu' );
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}

/* Function to enqueue scripts and styles for Contact Form 7 */

add_action( 'wp_enqueue_scripts', 'wpb_disable_cf7' );

function wpb_disable_cf7() {
    if ( is_page( 'contact' ) ) {
        return;
    }

    wp_dequeue_script( 'contact-form-7' );
    wp_dequeue_style( 'contact-form-7' );
}

// Add class to body tag base on template selction
function add_body_class($classes) {
    global $template; 
    $template_name = basename($template);

    if($template_name == 'home.php' || $template_name == 'microphone-test-and-guide-cases.php' || $template_name = 'microphome-test.php'){
        $body_class = 'home';
    }
    if($template_name == 'Webcam-test.php'){
        $body_class = 'webcam-test';
    }
    if($template_name == 'sound-test.php' || $template_name == 'sound-test-and-guide-cases.php'){
        $body_class = 'sound-test';
    }
    if($template_name == 'mouse-test.php' || $template_name == 'pitch-detector.php' || $template_name == 'guitar-tuner.php' || $template_name == 'alternate-tunings.php' || $template_name == 'ukulele-tuner.php' || $template_name == 'violin-tuner.php' || $template_name == 'banjo-tuner.php' || $template_name == 'webcam-test-and-guide-cases.php' || $template_name == 'mouse-test-and-guide-cases.php'){
        $body_class = 'mouse-test';
    }
    if($template_name == 'tone-generator-main.php'){
        $body_class = 'tone-generator';
    }
    if($template_name == 'microphone-test-in-adobe-flash.php'){
        $body_class = 'microphone-test-in-adobe-flash';
    }
    if($template_name == 'sound-test – in adobe-flash.php'){
        $body_class = 'sound-test-in-adobe-flash';
    }
    if($template_name == 'webcam-test-in-adobe-flash.php'){
        $body_class = 'webcam-test-in-adobe-flash';
    }
    if($template_name == 'Windows-8.php'){
        $body_class = 'windows-8';
    }
    if($template_name == 'windows-7.php'){
        $body_class = 'windows-7';
    }
    if($template_name == 'windows-xp.php'){
        $body_class = 'windows-xp';
    }
    if($template_name == 'ubuntu.php'){
        $body_class = 'ubuntu';
    }
    if($template_name == 'online_mirror.php'){
        $body_class = 'online-mirror';
    }
    if($template_name == 'mic_frog.php'){
        $body_class = 'mic-frog';
    }
    if($template_name == 'soundspeed.php'){
        $body_class = 'soundspeed';
    }
    if($template_name == 'page.php'){
        $body_class = 'blog';
    }
    if($template_name == 'about.php'){
        $body_class = 'about-us';
    }
    if($template_name == 'contact.php'){
        $body_class = 'contact-us';
    }
    if($template_name == 'privacy.php'){
        $body_class = 'privacy-policy';
    }
	if($template_name == 'touch-screen-test.php'){
        $body_class = 'touch-screen';
    }

    $classes[] = $body_class;

    return $classes;
}
add_filter('body_class', 'add_body_class');

add_action( 'wp_enqueue_scripts', 'wpb_load_scripts' );
add_action( 'wp_enqueue_scripts', 'wpb_deque_styles', 9999 );
add_action( 'wp_print_scripts', 'wpb_deque_scripts', 100 );

/**
 * Display a custom message instead of the RSS Feeds.
 *
 * @return void
 */
function wpcode_snippet_disable_feed() {
    wp_die(
        sprintf(
            // Translators: Placeholders for the homepage link.
            esc_html__( 'No feed available, please visit our %1$shomepage%2$s!' ),
            ' <a href="' . esc_url( home_url( '/' ) ) . '">',
            '</a>'
        )
    );
}
 
// Replace all rss feeds with the message above.
add_action( 'do_feed_rdf', 'wpcode_snippet_disable_feed', 1 );
add_action( 'do_feed_rss', 'wpcode_snippet_disable_feed', 1 );
add_action( 'do_feed_rss2', 'wpcode_snippet_disable_feed', 1 );
add_action( 'do_feed_atom', 'wpcode_snippet_disable_feed', 1 );
add_action( 'do_feed_rss2_comments', 'wpcode_snippet_disable_feed', 1 );
add_action( 'do_feed_atom_comments', 'wpcode_snippet_disable_feed', 1 );
// Remove links to rss feed from the header.
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );