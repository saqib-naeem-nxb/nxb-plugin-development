<?php 

/**
 * custom filters 
 * menu filter
 * remove login and register links if user is logged in
 * Author: Saqib Naeem
 * 07/22/2020
 */

function filter_handler_css( $classes, $item, $args, $depth ) {
	if($args->theme_location == "primary"){
		if($item->title == "Register")
		$classes[] = " hello";
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'filter_handler_css', 0, 4 ); 


remove_action( "init", "twentytwenty_menus" );
function custom_register_nav_menu(){
	register_nav_menus( array(
		"primary" => "Primary Nav",
		"secondary" => "Secondary Nav"
	) );
}
add_action( "init", "custom_register_nav_menu" );


add_filter( 'nav_menu_link_attributes', 'filter_function_name', 10, 3 );

function filter_function_name( $atts, $item, $args ) {
    if($item->title == "Login"){
		$atts["target"] = "_blank";
	}
    return $atts;
}

function custom_filter_menu($menu_items, $args){

	if($args->theme_location == "primary"){
		if(is_user_logged_in(  )){
		unset($menu_items[2]);
		unset($menu_items[3]);
		}
		if(!is_user_logged_in(  )){
		unset($menu_items[4]);
		}
	}
	return $menu_items;
}

add_filter( "wp_nav_menu_objects", "custom_filter_menu", 10, 2 );