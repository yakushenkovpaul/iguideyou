<?php
define('vc_inc_dir_url', plugin_dir_url(__FILE__));

if(!function_exists('deasil_vc_css_enqueue')) {
    /*enqueue vc related css*/
    function deasil_vc_css_enqueue($hook) {
        if ( 'post.php' != $hook ) {
            return;
        }
        wp_enqueue_style('vc-css', vc_inc_dir_url . '/assets/css/vc-style.css',null,null,'screen');
    }
    add_action( 'admin_enqueue_scripts', 'deasil_vc_css_enqueue' );
}

if(!function_exists('deasil_vc_before_init_actions')) {
    /*VC Before Init load component*/
    function deasil_vc_before_init_actions() {
        require_once( 'vc-elements/banner.php' ); 
        require_once( 'vc-elements/button.php' ); 
        require_once( 'vc-elements/iconfont.php' );

        require_once( 'vc-elements/infobox.php' );
        require_once( 'vc-elements/img-sliders.php' );  
        require_once( 'vc-elements/main-heading.php' );  
        require_once( 'vc-elements/blank-space.php' );
        require_once( 'vc-elements/feature-list.php' ); 
        require_once( 'vc-elements/count-number.php' );  
        require_once( 'vc-elements/testimonial.php' );  
        require_once( 'vc-elements/supported-by.php' );  

        require_once( 'vc-elements/steps.php' );  
        require_once( 'vc-elements/timeline.php' );  
        require_once( 'vc-elements/team.php' );  
        require_once( 'vc-elements/search.php' );  
        require_once( 'vc-elements/location.php' );   
    }
    add_action( 'vc_before_init', 'deasil_vc_before_init_actions' );
}



/***
*Add extra icons if icons*
***/

if(!function_exists('deasil_vc_before_init_actions')) {
    /*Enqueue Backend and Frontend CSS Styles*/
    function deasil_vc_iconpicker_editor_jscss(){
        wp_enqueue_style( 'deasilicon' );
    }
    add_action( 'vc_backend_editor_enqueue_js_css', 'deasil_vc_iconpicker_editor_jscss' );
    add_action( 'vc_frontend_editor_enqueue_js_css', 'deasil_vc_iconpicker_editor_jscss' );
}

if(!function_exists('deasil_enqueue_font_deasilicon')) {
    /** Enqueue CSS in Frontend when it's used*/
    function deasil_enqueue_font_deasilicon($font){
        switch ( $font ) {
            case 'deasilicon': wp_enqueue_style( 'deasilicon' );
        }
    }
    add_action('vc_enqueue_font_icon_element', 'deasil_enqueue_font_deasilicon');
}

if(!function_exists('deasil_vc_iconpicker_type_deasilicon')) {
    /*Define the Icons for VC Iconpicker*/
    function deasil_vc_iconpicker_type_deasilicon( $icons ) {
        $deasilicon_icons = array(
            array('icon-addon' => 'icon-addon'),
            array('icon-address' => 'icon-address'),
            array('icon-alarm' => 'icon-alarm'),
            array('icon-alert' => 'icon-alert'),
            array('icon-anchor' => 'icon-anchor'),
            array('icon-anounce' => 'icon-anounce'),
            array('icon-arr-down' => 'icon-arr-down'),
            array('icon-arr-left' => 'icon-arr-left'),
            array('icon-arr-right' => 'icon-arr-right'),
            array('icon-arr-up' => 'icon-arr-up'),
            array('icon-arrow-down' => 'icon-arrow-down'),
            array('icon-arrow-left' => 'icon-arrow-left'),
            array('icon-arrow-right' => 'icon-arrow-right'),
            array('icon-arrow-up' => 'icon-arrow-up'),
            array('icon-atom' => 'icon-atom'),
            array('icon-attach' => 'icon-attach'),
            array('icon-backpack' => 'icon-backpack'),
            array('icon-badge' => 'icon-badge'),
            array('icon-balloon' => 'icon-balloon'),
            array('icon-bandaid' => 'icon-bandaid'),
            array('icon-barcode' => 'icon-barcode'),
            array('icon-beaker' => 'icon-beaker'),
            array('icon-bed' => 'icon-bed'),
            array('icon-beer' => 'icon-beer'),
            array('icon-bell' => 'icon-bell'),
            array('icon-binocular' => 'icon-binocular'),
            array('icon-bird' => 'icon-bird'),
            array('icon-bold' => 'icon-bold'),
            array('icon-bowl' => 'icon-bowl'),
            array('icon-briefcase' => 'icon-briefcase'),
            array('icon-browser' => 'icon-browser'),
            array('icon-brush' => 'icon-brush'),
            array('icon-bulb' => 'icon-bulb'),
            array('icon-bungee' => 'icon-bungee'),
            array('icon-bus' => 'icon-bus'),
            array('icon-butcher-knife' => 'icon-butcher-knife'),
            array('icon-cactus' => 'icon-cactus'),
            array('icon-cake' => 'icon-cake'),
            array('icon-calculate' => 'icon-calculate'),
            array('icon-calendar' => 'icon-calendar'),
            array('icon-camel' => 'icon-camel'),
            array('icon-camera' => 'icon-camera'),
            array('icon-camp-fire' => 'icon-camp-fire'),
            array('icon-car' => 'icon-car'),
            array('icon-cart' => 'icon-cart'),
            array('icon-cat' => 'icon-cat'),
            array('icon-cd' => 'icon-cd'),
            array('icon-chart-bar' => 'icon-chart-bar'),
            array('icon-chart-line' => 'icon-chart-line'),
            array('icon-chart-pie' => 'icon-chart-pie'),
            array('icon-chart-stock' => 'icon-chart-stock'),
            array('icon-chat' => 'icon-chat'),
            array('icon-checklist' => 'icon-checklist'),
            array('icon-chicken' => 'icon-chicken'),
            array('icon-chilli' => 'icon-chilli'),
            array('icon-chrome' => 'icon-chrome'),
            array('icon-clock' => 'icon-clock'),
            array('icon-cloud' => 'icon-cloud'),
            array('icon-cloud-add' => 'icon-cloud-add'),
            array('icon-cloud-down' => 'icon-cloud-down'),
            array('icon-cloud-drop' => 'icon-cloud-drop'),
            array('icon-cloud-moon' => 'icon-cloud-moon'),
            array('icon-cloud-rain' => 'icon-cloud-rain'),
            array('icon-cloud-schedule' => 'icon-cloud-schedule'),
            array('icon-cloud-sun' => 'icon-cloud-sun'),
            array('icon-cloud-thunder' => 'icon-cloud-thunder'),
            array('icon-cloud-up' => 'icon-cloud-up'),
            array('icon-club' => 'icon-club'),
            array('icon-coffee' => 'icon-coffee'),
            array('icon-collapse' => 'icon-collapse'),
            array('icon-color' => 'icon-color'),
            array('icon-compass' => 'icon-compass'),
            array('icon-conical-flask' => 'icon-conical-flask'),
            array('icon-contact' => 'icon-contact'),
            array('icon-cook-hat' => 'icon-cook-hat'),
            array('icon-copy' => 'icon-copy'),
            array('icon-creditcard' => 'icon-creditcard'),
            array('icon-cross' => 'icon-cross'),
            array('icon-css' => 'icon-css'),
            array('icon-cursor' => 'icon-cursor'),
            array('icon-cycle' => 'icon-cycle'),
            array('icon-cycling' => 'icon-cycling'),
            array('icon-danger' => 'icon-danger'),
            array('icon-dashboard' => 'icon-dashboard'),
            array('icon-data' => 'icon-data'),
            array('icon-date' => 'icon-date'),
            array('icon-deer' => 'icon-deer'),
            array('icon-desktop' => 'icon-desktop'),
            array('icon-diamond' => 'icon-diamond'),
            array('icon-dish' => 'icon-dish'),
            array('icon-dna' => 'icon-dna'),
            array('icon-dog' => 'icon-dog'),
            array('icon-dollar' => 'icon-dollar'),
            array('icon-door-tag' => 'icon-door-tag'),
            array('icon-download' => 'icon-download'),
            array('icon-dribbble' => 'icon-dribbble'),
            array('icon-drink' => 'icon-drink'),
            array('icon-dropbox' => 'icon-dropbox'),
            array('icon-drums' => 'icon-drums'),
            array('icon-earth' => 'icon-earth'),
            array('icon-elephant' => 'icon-elephant'),
            array('icon-euro' => 'icon-euro'),
            array('icon-expand' => 'icon-expand'),
            array('icon-eye' => 'icon-eye'),
            array('icon-facebook' => 'icon-facebook'),
            array('icon-file' => 'icon-file'),
            array('icon-filter' => 'icon-filter'),
            array('icon-firefox' => 'icon-firefox'),
            array('icon-fish' => 'icon-fish'),
            array('icon-flag' => 'icon-flag'),
            array('icon-flower' => 'icon-flower'),
            array('icon-folder' => 'icon-folder'),
            array('icon-forward' => 'icon-forward'),
            array('icon-gas' => 'icon-gas'),
            array('icon-github' => 'icon-github'),
            array('icon-gliding' => 'icon-gliding'),
            array('icon-gloves' => 'icon-gloves'),
            array('icon-google' => 'icon-google'),
            array('icon-grid' => 'icon-grid'),
            array('icon-guitar' => 'icon-guitar'),
            array('icon-hand-dislike' => 'icon-hand-dislike'),
            array('icon-hand-down' => 'icon-hand-down'),
            array('icon-hand-fist' => 'icon-hand-fist'),
            array('icon-hand-left' => 'icon-hand-left'),
            array('icon-hand-like' => 'icon-hand-like'),
            array('icon-hand-right' => 'icon-hand-right'),
            array('icon-hand-rock' => 'icon-hand-rock'),
            array('icon-hand-scissor' => 'icon-hand-scissor'),
            array('icon-hand-stop' => 'icon-hand-stop'),
            array('icon-hand-swipe' => 'icon-hand-swipe'),
            array('icon-hand-up' => 'icon-hand-up'),
            array('icon-handdrawn-arrow-left' => 'icon-handdrawn-arrow-left'),
            array('icon-handdrawn-arrow-right' => 'icon-handdrawn-arrow-right'),
            array('icon-happy' => 'icon-happy'),
            array('icon-headset' => 'icon-headset'),
            array('icon-heart' => 'icon-heart'),
            array('icon-heart-beat' => 'icon-heart-beat'),
            array('icon-helicopter' => 'icon-helicopter'),
            array('icon-help' => 'icon-help'),
            array('icon-hiking' => 'icon-hiking'),
            array('icon-home' => 'icon-home'),
            array('icon-horse' => 'icon-horse'),
            array('icon-html5' => 'icon-html5'),
            array('icon-ice-skating' => 'icon-ice-skating'),
            array('icon-ie' => 'icon-ie'),
            array('icon-info' => 'icon-info'),
            array('icon-injection' => 'icon-injection'),
            array('icon-island' => 'icon-island'),
            array('icon-italic' => 'icon-italic'),
            array('icon-jacket' => 'icon-jacket'),
            array('icon-jeep' => 'icon-jeep'),
            array('icon-key' => 'icon-key'),
            array('icon-keyboard' => 'icon-keyboard'),
            array('icon-knife' => 'icon-knife'),
            array('icon-laptop' => 'icon-laptop'),
            array('icon-leaf' => 'icon-leaf'),
            array('icon-less' => 'icon-less'),
            array('icon-level-1' => 'icon-level-1'),
            array('icon-level-10' => 'icon-level-10'),
            array('icon-level-2' => 'icon-level-2'),
            array('icon-level-3' => 'icon-level-3'),
            array('icon-level-4' => 'icon-level-4'),
            array('icon-level-5' => 'icon-level-5'),
            array('icon-level-6' => 'icon-level-6'),
            array('icon-level-7' => 'icon-level-7'),
            array('icon-level-8' => 'icon-level-8'),
            array('icon-level-9' => 'icon-level-9'),
            array('icon-life-jacket' => 'icon-life-jacket'),
            array('icon-link' => 'icon-link'),
            array('icon-linkedin' => 'icon-linkedin'),
            array('icon-list' => 'icon-list'),
            array('icon-locate' => 'icon-locate'),
            array('icon-locate-map' => 'icon-locate-map'),
            array('icon-location' => 'icon-location'),
            array('icon-lock' => 'icon-lock'),
            array('icon-logout' => 'icon-logout'),
            array('icon-mail' => 'icon-mail'),
            array('icon-mail-open' => 'icon-mail-open'),
            array('icon-map' => 'icon-map'),
            array('icon-medal' => 'icon-medal'),
            array('icon-medical' => 'icon-medical'),
            array('icon-medicine' => 'icon-medicine'),
            array('icon-message' => 'icon-message'),
            array('icon-microphone' => 'icon-microphone'),
            array('icon-microscope' => 'icon-microscope'),
            array('icon-minicart' => 'icon-minicart'),
            array('icon-minus' => 'icon-minus'),
            array('icon-mobile' => 'icon-mobile'),
            array('icon-money' => 'icon-money'),
            array('icon-moon' => 'icon-moon'),
            array('icon-mountain' => 'icon-mountain'),
            array('icon-mouse' => 'icon-mouse'),
            array('icon-music-note' => 'icon-music-note'),
            array('icon-music-note-2' => 'icon-music-note-2'),
            array('icon-mute' => 'icon-mute'),
            array('icon-news' => 'icon-news'),
            array('icon-opera' => 'icon-opera'),
            array('icon-order' => 'icon-order'),
            array('icon-os-android' => 'icon-os-android'),
            array('icon-os-apple' => 'icon-os-apple'),
            array('icon-os-mac' => 'icon-os-mac'),
            array('icon-os-window' => 'icon-os-window'),
            array('icon-owl' => 'icon-owl'),
            array('icon-paint' => 'icon-paint'),
            array('icon-paper-knife' => 'icon-paper-knife'),
            array('icon-paper-plane' => 'icon-paper-plane'),
            array('icon-paragliding' => 'icon-paragliding'),
            array('icon-pdf' => 'icon-pdf'),
            array('icon-pencil' => 'icon-pencil'),
            array('icon-phone-tilt' => 'icon-phone-tilt'),
            array('icon-pin' => 'icon-pin'),
            array('icon-pinterest' => 'icon-pinterest'),
            array('icon-plane' => 'icon-plane'),
            array('icon-plate' => 'icon-plate'),
            array('icon-play' => 'icon-play'),
            array('icon-plug' => 'icon-plug'),
            array('icon-plus' => 'icon-plus'),
            array('icon-pound' => 'icon-pound'),
            array('icon-printer' => 'icon-printer'),
            array('icon-quote' => 'icon-quote'),
            array('icon-rafting' => 'icon-rafting'),
            array('icon-razor' => 'icon-razor'),
            array('icon-record' => 'icon-record'),
            array('icon-recycle' => 'icon-recycle'),
            array('icon-reply' => 'icon-reply'),
            array('icon-replyall' => 'icon-replyall'),
            array('icon-responsive' => 'icon-responsive'),
            array('icon-rewind' => 'icon-rewind'),
            array('icon-road-sign' => 'icon-road-sign'),
            array('icon-rock-climbing' => 'icon-rock-climbing'),
            array('icon-rocket' => 'icon-rocket'),
            array('icon-round-flask' => 'icon-round-flask'),
            array('icon-rss' => 'icon-rss'),
            array('icon-sad' => 'icon-sad'),
            array('icon-safari' => 'icon-safari'),
            array('icon-sass' => 'icon-sass'),
            array('icon-saturn' => 'icon-saturn'),
            array('icon-schedule' => 'icon-schedule'),
            array('icon-scissor' => 'icon-scissor'),
            array('icon-scooter' => 'icon-scooter'),
            array('icon-scuba-diving' => 'icon-scuba-diving'),
            array('icon-search' => 'icon-search'),
            array('icon-setting' => 'icon-setting'),
            array('icon-sexaphone' => 'icon-sexaphone'),
            array('icon-share' => 'icon-share'),
            array('icon-shark' => 'icon-shark'),
            array('icon-ship' => 'icon-ship'),
            array('icon-shoe' => 'icon-shoe'),
            array('icon-shop' => 'icon-shop'),
            array('icon-shopbag' => 'icon-shopbag'),
            array('icon-signal' => 'icon-signal'),
            array('icon-sking' => 'icon-sking'),
            array('icon-skype' => 'icon-skype'),
            array('icon-snail' => 'icon-snail'),
            array('icon-snow' => 'icon-snow'),
            array('icon-spade' => 'icon-spade'),
            array('icon-star' => 'icon-star'),
            array('icon-star-empty' => 'icon-star-empty'),
            array('icon-star-half' => 'icon-star-half'),
            array('icon-stethoscope' => 'icon-stethoscope'),
            array('icon-stop' => 'icon-stop'),
            array('icon-sun' => 'icon-sun'),
            array('icon-support' => 'icon-support'),
            array('icon-swiming' => 'icon-swiming'),
            array('icon-swiss-knife' => 'icon-swiss-knife'),
            array('icon-sync' => 'icon-sync'),
            array('icon-tablet' => 'icon-tablet'),
            array('icon-tag' => 'icon-tag'),
            array('icon-tea' => 'icon-tea'),
            array('icon-telephone' => 'icon-telephone'),
            array('icon-telescope' => 'icon-telescope'),
            array('icon-temperature' => 'icon-temperature'),
            array('icon-tent' => 'icon-tent'),
            array('icon-text-transform' => 'icon-text-transform'),
            array('icon-tick' => 'icon-tick'),
            array('icon-tooth' => 'icon-tooth'),
            array('icon-tortoise' => 'icon-tortoise'),
            array('icon-train' => 'icon-train'),
            array('icon-transfer' => 'icon-transfer'),
            array('icon-transfer2' => 'icon-transfer2'),
            array('icon-trash' => 'icon-trash'),
            array('icon-tree' => 'icon-tree'),
            array('icon-triangle-down' => 'icon-triangle-down'),
            array('icon-triangle-left' => 'icon-triangle-left'),
            array('icon-triangle-right' => 'icon-triangle-right'),
            array('icon-triangle-up' => 'icon-triangle-up'),
            array('icon-tv' => 'icon-tv'),
            array('icon-twitter' => 'icon-twitter'),
            array('icon-umbrella' => 'icon-umbrella'),
            array('icon-underline' => 'icon-underline'),
            array('icon-upload' => 'icon-upload'),
            array('icon-user' => 'icon-user'),
            array('icon-volume' => 'icon-volume'),
            array('icon-volume-full' => 'icon-volume-full'),
            array('icon-volume-small' => 'icon-volume-small'),
            array('icon-weight' => 'icon-weight'),
            array('icon-whale' => 'icon-whale'),
            array('icon-wind-surfing' => 'icon-wind-surfing'),
            array('icon-wine' => 'icon-wine'),
            array('icon-winner' => 'icon-winner'),
            array('icon-wrench-tilt' => 'icon-wrench-tilt'),
            array('icon-youtube' => 'icon-youtube'),
            array('icon-youtubeplay' => 'icon-youtubeplay'),
            array('icon-zoomin' => 'icon-zoomin'),
            array('icon-zoomout' => 'icon-zoomout')

            );

    return array_merge( $icons, $deasilicon_icons );
    }
    add_filter( 'vc_iconpicker-type-deasilicon', 'deasil_vc_iconpicker_type_deasilicon' );
}