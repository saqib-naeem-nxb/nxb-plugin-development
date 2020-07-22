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


function mnp($content){
	if(!is_single( )){
		return $content;
	}

	$ad = "<div class='background-blue;padding:12px;'>AD SHOWS HERE</div>";
	return mnp_func($ad, 2, $content);
}
add_filter( "the_content", "mnp" );

function mnp_func($ad, $p, $content){
	$break = '</p>';
	$paragraphs = explode($break, $content);

	foreach($paragraphs as $i=>$paragraph){
		if(trim($paragraph)){
			$final .= $break;
		}
		if($p == $i+1){
			$paragraphs[$i] .= $ad;
		}
	}
	return implode("", $paragraphs);
}

/**
 * Add script imideately after <body>
 */

 function firstplugin_after_opening_body_tag(){
	 echo "Something";
 }
 add_action( "wp_body_open", "firstplugin_after_opening_body_tag" );


/**
 * creating custom registration form
 * FrontEnd
 */


function registration_validation($firstname, $lastname, $username, $email, $password){
	global $reg_errors;
	$reg_errors = new WP_Error;
	if(empty($firstname) OR empty($lastname) OR empty($username) OR empty($email) OR empty($password) ){
		$reg_errors->add("field_required", "This field is required and must not be empty");
	}
	if((strlen($firstname) < 3) || (strlen($lastname) < 3) || (strlen($username) < 3) || (strlen($password) < 5) ){
		$reg_errors->add("field_length", "This field is required and must not be emptyy");
	}
	if(username_exists( $username )){
		$reg_errors->add("username_already_exist", "This username already existed in our system, please try another one");
	}
	if(!validate_username( $username )){
		$reg_errors->add("invalid_username", "Invalid Username");
	}
	if(5 > strlen($password)){
		$reg_errors->add("password_length", "Password length is too short, must be atleast 6 charactors");
	}
	if( !is_email( $email ) || email_exists( $email ) ){
		$reg_errors->add("email_validation", "Invalid Email or Already Exist");
	}

	if(is_wp_error( $reg_errors )){
		foreach($reg_errors->get_error_messages() as $message){
			echo "<div>";
			echo $message;
			echo "</div>";
		}
	}
}

function complete_registration(){
	global $reg_errors, $firstname, $lastname, $username, $email, $password;

	if(1 > count($reg_errors->get_error_messages()) ){
		$user_data = array(
			"user_login" 	=> $username,
			"user_email"	=> $email,
			"user_pass"		=> $password,
			"first_name"	=> $firstname,
			"last_name"		=> $lastname,
	

		);
		$user = wp_insert_user( $user_data );
		echo "<pre>";
		print_r($user);
		echo "</pre>";

		if(isset($user)){

			$logged_in = wp_signon( array($username, $password, false ) );
		}
	
	}

}


function  registration_form($firstname, $lastname, $username, $email, $password){
	?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
<div>
<?php echo '<label>First Name *</label>'; ?>
<input type="text" name="first_name" placeholder="First Name" 
    value="<?php echo ( isset($_POST['first_name']) ) ? $firstname : null;  ?>">
</div>
<div>
<label>Last Name *</label>
<input type="text" name="last_name" placeholder="Last Name" 
    value="<?php echo ( isset($_POST['last_name']) ) ? $lastname : null;  ?>">
</div>
<div>
<label>Username *</label>
<input type="text" name="user_name" placeholder="e.g. user_name" 
    value="<?php echo ( isset($_POST['user_name']) ) ? $username : null;  ?>">
</div>
<div>
<label>Email Address *</label>
<input type="email" name="email" placeholder="e.g. email@gmail.com" 
    value="<?php echo ( isset($_POST['email']) ) ? $email : null;  ?>">
<p>An email will be sent to this email containing your password</p>
</div>
<div>
<label>Password *</label>
<input type="password" name="password" placeholder="Type Password" 
    value="<?php echo ( isset($_POST['password']) ) ? $password : null;  ?>">
</div>

<div>
<input type="submit" name="register" value="register">
</div>
</form>
	<?php 
}


function custom_registrat_function(){
	if(isset($_POST['register'])){
		registration_validation(
			$_POST['first_name'],
			$_POST['last_name'],
			$_POST['user_name'],
			$_POST['email'],
			$_POST['password'],
		);

		global $firstname, $lastname, $username, $email, $password;
		$firstname	= sanitize_text_field( $_POST['first_name'] );
		$lastname	= sanitize_text_field( $_POST['last_name'] );
		$username	= sanitize_user( $_POST['user_name'] );
		$email		= sanitize_email( $_POST['email'] );
		$password	= esc_attr( $_POST['password'] );

		complete_registration($firstname, $lastname, $username, $email, $password);

	}
	if(!is_user_logged_in(  ))
		registration_form($firstname, $lastname, $username, $email, $password);

}


/**
 * custom login function 
 */


function custom_login_function(){
	if( isset($_POST['login']) ){
		$username = $_POST['user_name'];
		$password = $_POST['user_name'];
		
		$result = wp_authenticate( $username, $password );
		echo "<pre>";
		print_r($result);
		echo "</pre>";
	}
	
	wp_login_form(array(
		"redirect" => (is_ssl(  ) ? "https://" : "http://").$_SERVER["HTTP_HOST"]."/web/wordpress/dashboard",
	));
}



/**
 * Custom dashboard functions
 */

function custom_dashboard(){
	echo "Welcome to the dashbaord";
}

 
/**
 * custom filters 
 * menu filter
 * remove login and register links if user is logged in
 * 
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