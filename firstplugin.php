<?php
/**
 * Plugin Name: First Plugin
 * Description: Short description abt plugin
 */

 if( !defined("WPINC") ) die;


 function _firstplugin_admin_menu(){
     add_menu_page( "first Plugin", "First Plugin", "manage_options", "first_plugin", "firstplugin_html", "", 100 );
     add_submenu_page( "first_plugin", "First Submenu Page", "Submenu Page", "manage_options", "first_submenu", "first_submenu_html" );
 }
 add_action( "admin_menu", "_firstplugin_admin_menu");

 function firstplugin_html(){
     if(!current_user_can( "manage_options" )):
        return;
     endif;
     ?>
     <div class="wrap">
<h1><?php echo __(get_admin_page_title()); ?></h1>
<ul class="subsubsub">
	<li class="all">
		<a href="#" class="current">
			<?php _e('All'); ?> 
			<span class="count">(1)</span>
		</a> |
	</li>
	<li class="publish">
		<a href="#">
			<?php _e('Active'); ?> 
			<span class="count">(5)</span>
		</a>
	</li>
</ul>
<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
            <th class="manage-column column-title sortable">
                <a href="add_query_args_here">Sortable (but not sorted)</a>
            </th>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
			<th><?php _e('Column Name', 'pippinw'); ?></th>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<td><?php _e('Column Data', 'pippinw'); ?></td>
			<td><?php _e('Column Data', 'pippinw'); ?></td>
			<td><?php _e('Column Data', 'pippinw'); ?></td>
			<td><?php _e('Column Data', 'pippinw'); ?></td>
		</tr>
	</tbody>
</table>
</div>

<?php 
$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;


?>
<nav class="nav-tab-wrapper">
<a href="?page=first_plugin" class="nav-tab <?php if($tab===null): ?>nav-tab-active<?php endif; ?>">Default Tab</a>
    <a href="?page=first_plugin&tab=settings" class="nav-tab <?php if($tab==='settings'):?>nav-tab-active<?php endif; ?>">Settings</a>
    <a href="?page=first_plugin&tab=tools" class="nav-tab <?php if($tab==='tools'):?>nav-tab-active<?php endif; ?>">Tools</a>

</nav>
<div class="tab-content">
        <?php 
        switch($tab){
            case 'settings':
                echo "Setting";
            break;
            case 'tools':
                echo "Tools";
            break;
            default:
                echo "Default";
            break;
        }
        
        ?>
</div>

     <?php
 }


 function first_submenu_html(){
     ?>
     <div class="wrap">
<h1><?php echo get_admin_page_title(  ); ?><h1>
</div>
     <?php
 }


function first_plugin_filter_post_content($string){
    if( is_single() && is_main_query() ):
        $string = "<p>Saqib . </p>".$string;
    endif;
    return $string;
}
add_filter( "the_content", "first_plugin_filter_post_content");



function new_wp_login_url() {
    // return home_url()."/hello world";
}
add_filter('login_headerurl', 'new_wlp_login_url');


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
