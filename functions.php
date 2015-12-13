<?php

// Enqueue main.css

function rbt_styles() {

    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/main.css'
    );

    wp_enqueue_script( 'roboto', get_stylesheet_directory_uri() . '/js/fonts.js', array(), '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'rbt_styles', 500 );


?>
