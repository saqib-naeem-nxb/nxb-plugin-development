<?php
/**
 * Plugin Name: First Plugin
 * Description: Short description abt plugin
 * Text Domain: fp
 */

 if( !defined("WPINC") ) die;



// function first_plugin_filter_post_content($string){
//     if( is_single() && is_main_query() ):
//         $string = "<p>Saqib . </p>".$string;
//     endif;
//     return $string;
// }
// add_filter( "the_content", "first_plugin_filter_post_content");




// function firtplugin_body_open(){
//     echo  "Saqib Naeem";
// }
// add_action( "wp_body_open", "firtplugin_body_open" );

//  register_activation_hook( __FILE__, "activation_hook_callback" );
//  function activation_hook_callback(){
     
//  }
//  register_deactivation_hook( __FILE__, "deactivation_hook_callback" );
//  function deactivation_hook_callback(){
    
//  }
//  register_activation_hook( __FILE__, "activation_hook_callback" );
//  function activation_hook_callback(){

//  }

// $e_data = "xyz";
// function xyz($data){
//     $z = $data;
//     $if = 1;
//     echo apply_filters( "xyz", $z, $if );
// }

// add_filter( "xyz", "xyz_filter", 10, 2);

// function xyz_filter($string, $a1){
//     if(is_page()):

//         if($a1){
//             $string = "Name: ". $string;
//         }
//     endif;
//     return $string;
// }

if(is_admin(  )){
	require_once plugin_dir_path( __FILE__ )."includes/admin/firstplugin-page.php";
	require_once plugin_dir_path( __FILE__ )."includes/admin/post-types.php";
	require_once plugin_dir_path( __FILE__ )."includes/admin/books-metaboxes.php";
}
require_once plugin_dir_path( __FILE__ )."includes/the_content-filter.php";
require_once plugin_dir_path( __FILE__ )."includes/after-body-tag.php";
require_once plugin_dir_path( __FILE__ )."includes/registration-login.php";
require_once plugin_dir_path( __FILE__ )."includes/dashboard.php";
require_once plugin_dir_path( __FILE__ )."includes/menu-filter.php";