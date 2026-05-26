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
		// wp_enqueue_script( 'white-noise-js', get_stylesheet_directory_uri() . '/assets/js/noise/white-noise.js', '', '', true );
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

/**
 * Whether the current page is Russian (Polylang or locale fallback).
 */
function wpb_is_russian_language() {
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language( 'slug' ) === 'ru';
    }

    $locale = get_locale();

    return $locale === 'ru_RU' || strpos( $locale, 'ru_' ) === 0;
}

/**
 * Body class for Russian pages (used by global Raleway font styles).
 */
function wpb_russian_body_class( $classes ) {
    if ( wpb_is_russian_language() ) {
        $classes[] = 'lang-ru';
    }

    return $classes;
}
add_filter( 'body_class', 'wpb_russian_body_class', 20 );

/**
 * Raleway on every element for Russian pages (CSS + JS for inline styles).
 */
function wpb_russian_raleway_styles() {
    if ( ! wpb_is_russian_language() ) {
        return;
    }
    ?>
    <style id="wpb-russian-raleway">
        html[lang^="ru"] body.lang-ru,
        html[lang^="ru"] body.lang-ru *:not(.fa):not(.fas):not(.far):not(.fab):not(.fal):not([class*=" fa-"]):not([class^="fa-"]):not(.sw):not([class*="swp_"]):not(i),
        html[lang^="ru"] body.lang-ru h1,
        html[lang^="ru"] body.lang-ru h2,
        html[lang^="ru"] body.lang-ru h3,
        html[lang^="ru"] body.lang-ru h4,
        html[lang^="ru"] body.lang-ru h5,
        html[lang^="ru"] body.lang-ru h6,
        html[lang^="ru"] body.lang-ru p,
        html[lang^="ru"] body.lang-ru a,
        html[lang^="ru"] body.lang-ru span,
        html[lang^="ru"] body.lang-ru div,
        html[lang^="ru"] body.lang-ru li,
        html[lang^="ru"] body.lang-ru ul,
        html[lang^="ru"] body.lang-ru ol,
        html[lang^="ru"] body.lang-ru table,
        html[lang^="ru"] body.lang-ru tr,
        html[lang^="ru"] body.lang-ru td,
        html[lang^="ru"] body.lang-ru th,
        html[lang^="ru"] body.lang-ru label,
        html[lang^="ru"] body.lang-ru input,
        html[lang^="ru"] body.lang-ru button,
        html[lang^="ru"] body.lang-ru select,
        html[lang^="ru"] body.lang-ru textarea,
        html[lang^="ru"] body.lang-ru nav,
        html[lang^="ru"] body.lang-ru section,
        html[lang^="ru"] body.lang-ru article,
        html[lang^="ru"] body.lang-ru header,
        html[lang^="ru"] body.lang-ru footer,
        html[lang^="ru"] body.lang-ru aside,
        html[lang^="ru"] body.lang-ru main,
        html[lang^="ru"] body.lang-ru blockquote,
        html[lang^="ru"] body.lang-ru pre,
        html[lang^="ru"] body.lang-ru code,
        html[lang^="ru"] body.lang-ru strong,
        html[lang^="ru"] body.lang-ru em,
        html[lang^="ru"] body.lang-ru small,
        html[lang^="ru"] body.lang-ru figcaption,
        html[lang^="ru"] body.lang-ru dt,
        html[lang^="ru"] body.lang-ru dd,
        html[lang^="ru"] body.lang-ru legend,
        html[lang^="ru"] body.lang-ru option,
        html[lang^="ru"] body.lang-ru svg text,
        html[lang^="ru"] body.lang-ru svg tspan {
            font-family: 'Raleway', sans-serif !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'wpb_russian_raleway_styles', 100 );

/**
 * Apply Raleway via JS so inline font-family rules are overridden on Russian pages.
 */
function wpb_russian_raleway_scripts() {
    if ( ! wpb_is_russian_language() ) {
        return;
    }
    ?>
    <script id="wpb-russian-raleway-js">
    (function () {
        var font = "'Raleway', sans-serif";
        var iconSelector = '.fa, .fas, .far, .fab, .fal, .sw, [class*="swp_"], [class*=" fa-"], [class^="fa-"]';

        function shouldSkip(el) {
            if (!el || el.nodeType !== 1) {
                return true;
            }
            if (el.tagName === 'I' && el.closest && el.closest(iconSelector)) {
                return true;
            }
            return el.closest ? !!el.closest(iconSelector) : false;
        }

        function applyRaleway(root) {
            if (!root || shouldSkip(root)) {
                return;
            }
            root.style.setProperty('font-family', font, 'important');
            var nodes = root.querySelectorAll('*');
            for (var i = 0; i < nodes.length; i++) {
                var el = nodes[i];
                if (shouldSkip(el)) {
                    continue;
                }
                el.style.setProperty('font-family', font, 'important');
            }
            var svgText = root.querySelectorAll('svg text, svg tspan');
            for (var j = 0; j < svgText.length; j++) {
                if (!shouldSkip(svgText[j])) {
                    svgText[j].setAttribute('font-family', font);
                }
            }
        }

        function run() {
            if (!document.body || !document.body.classList.contains('lang-ru')) {
                return;
            }
            applyRaleway(document.body);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', run);
        } else {
            run();
        }
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'wpb_russian_raleway_scripts', 100 );

/**
 * Whether the current page is Chinese, Korean, or Japanese (Polylang or locale fallback).
 */
function wpb_is_cjk_language() {
    if ( function_exists( 'pll_current_language' ) ) {
        return in_array( pll_current_language( 'slug' ), array( 'zh', 'zh-cn', 'zh-tw', 'ko', 'ja' ), true );
    }

    $locale = get_locale();

    return strpos( $locale, 'zh_' ) === 0 || strpos( $locale, 'ko_' ) === 0 || strpos( $locale, 'ja_' ) === 0;
}

/**
 * Body class for Chinese, Korean, and Japanese pages.
 */
function wpb_cjk_body_class( $classes ) {
    if ( wpb_is_cjk_language() ) {
        $classes[] = 'lang-cjk';
    }

    return $classes;
}
add_filter( 'body_class', 'wpb_cjk_body_class', 20 );

/**
 * Noto Sans SC on every element for Chinese, Korean, and Japanese pages.
 */
function wpb_cjk_noto_sans_styles() {
    if ( ! wpb_is_cjk_language() ) {
        return;
    }
    ?>
    <style id="wpb-cjk-noto-sans">
        body.lang-cjk,
        body.lang-cjk *:not(.fa):not(.fas):not(.far):not(.fab):not(.fal):not([class*=" fa-"]):not([class^="fa-"]):not(.sw):not([class*="swp_"]):not(i),
        body.lang-cjk h1,
        body.lang-cjk h2,
        body.lang-cjk h3,
        body.lang-cjk h4,
        body.lang-cjk h5,
        body.lang-cjk h6,
        body.lang-cjk p,
        body.lang-cjk a,
        body.lang-cjk span,
        body.lang-cjk div,
        body.lang-cjk li,
        body.lang-cjk ul,
        body.lang-cjk ol,
        body.lang-cjk table,
        body.lang-cjk tr,
        body.lang-cjk td,
        body.lang-cjk th,
        body.lang-cjk label,
        body.lang-cjk input,
        body.lang-cjk button,
        body.lang-cjk select,
        body.lang-cjk textarea,
        body.lang-cjk nav,
        body.lang-cjk section,
        body.lang-cjk article,
        body.lang-cjk header,
        body.lang-cjk footer,
        body.lang-cjk aside,
        body.lang-cjk main,
        body.lang-cjk blockquote,
        body.lang-cjk pre,
        body.lang-cjk code,
        body.lang-cjk strong,
        body.lang-cjk em,
        body.lang-cjk small,
        body.lang-cjk figcaption,
        body.lang-cjk dt,
        body.lang-cjk dd,
        body.lang-cjk legend,
        body.lang-cjk option,
        body.lang-cjk svg text,
        body.lang-cjk svg tspan {
            font-family: "Noto Sans SC", sans-serif !important;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'wpb_cjk_noto_sans_styles', 100 );

/**
 * Apply Noto Sans SC via JS so inline font-family rules are overridden on CJK pages.
 */
function wpb_cjk_noto_sans_scripts() {
    if ( ! wpb_is_cjk_language() ) {
        return;
    }
    ?>
    <script id="wpb-cjk-noto-sans-js">
    (function () {
        var font = '"Noto Sans SC", sans-serif';
        var iconSelector = '.fa, .fas, .far, .fab, .fal, .sw, [class*="swp_"], [class*=" fa-"], [class^="fa-"]';

        function shouldSkip(el) {
            if (!el || el.nodeType !== 1) {
                return true;
            }
            if (el.tagName === 'I' && el.closest && el.closest(iconSelector)) {
                return true;
            }
            return el.closest ? !!el.closest(iconSelector) : false;
        }

        function applyNotoSans(root) {
            if (!root || shouldSkip(root)) {
                return;
            }
            root.style.setProperty('font-family', font, 'important');
            var nodes = root.querySelectorAll('*');
            for (var i = 0; i < nodes.length; i++) {
                var el = nodes[i];
                if (shouldSkip(el)) {
                    continue;
                }
                el.style.setProperty('font-family', font, 'important');
            }
            var svgText = root.querySelectorAll('svg text, svg tspan');
            for (var j = 0; j < svgText.length; j++) {
                if (!shouldSkip(svgText[j])) {
                    svgText[j].setAttribute('font-family', font);
                }
            }
        }

        function run() {
            if (!document.body || !document.body.classList.contains('lang-cjk')) {
                return;
            }
            applyNotoSans(document.body);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', run);
        } else {
            run();
        }
    })();
    </script>
    <?php
}
add_action( 'wp_footer', 'wpb_cjk_noto_sans_scripts', 100 );

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