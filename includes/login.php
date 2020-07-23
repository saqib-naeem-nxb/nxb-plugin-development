<?php 
/**
 * custom login function 
 * Author: Saqib Naeem
 * 07/22/2020
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

?>