<?php

function firstplugin_custom_posttypes(){
    register_post_type( "books", array(
        'label' => "Books",
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 99,
        'capabilities' => array(
          ),
        'supports' => array(
            'title',
            'thumbnail'
        ),
        'rewrite' => array(
        ),
        'can_export', false

    ) );    
}
add_action( "init", "firstplugin_custom_posttypes" );
?>