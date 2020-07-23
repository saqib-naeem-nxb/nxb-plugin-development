<?php
/**
 * creating custom user registration form
 * FrontEnd
 * Author: Saqib Naeem
 * 07/22/2020
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

?>