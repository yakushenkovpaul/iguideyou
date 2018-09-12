<?php

function deasil_customize_register( $wp_customize ) {
    /* Just use the $wp_customize object and create a section or use a built-in
    section. */
    $wp_customize->add_section(
        'deasil_setting_section', array(
            'title'       => esc_html__('Deasil Setting', 'deasil-core'),
            // 'priority'    => 200
            'panel' => 'nav_menus'
        )
    );

    /* Now you can add your settings/option ... */
    $wp_customize->add_setting(
        'login_nav', array(
            'default'    => '',
            'type'       => 'option',
            'capability' => 'edit_theme_options',
        )
    );
    /* ... and link controls to these settings. */
    $wp_customize->add_control(
        'login_nav', array(
            'label'      => esc_html__('Show Sign Up menu on Primary Mmenu', 'deasil-core'),
            'section' => 'deasil_setting_section',
            'settings'   => 'login_nav',
            'type' => 'checkbox',
        )
    );


}
add_action( 'customize_register' , 'deasil_customize_register' );
?>