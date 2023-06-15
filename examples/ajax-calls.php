<?php 

require_once( '../Main.php' );

/**
 * *****************************************
 * Validate MagicLink Registration Token
 * *****************************************
 */
if( !empty( $_GET['registration_validation_token'] ) ){
	$registration_validation_token = $_GET['registration_validation_token'];
	$user_params = array( 'registration_validation_token' => $registration_validation_token );
	$response = AuthArmorUsersMagicLinkEmail::validate_magiclink_registration_token( $user_params );
	if( $response['status_code'] == 200 ){
		?>
		<style type="text/css">
			#container {
			    width: 100%;
			    height: 100%;
			    position: absolute;
			    visibility: visible;
			    display: block;
			}
			.reveal-modal {
		        background: #2a2d35;
			    color: white;
			    margin: 0 auto;
			    text-align: center;
			    width: 300px;
			    position: relative;
			    z-index: 41;
			    top: 25%;
			    padding: 30px;
			    -webkit-box-shadow:0 0 10px rgba(0,0,0,0.4);
			    -moz-box-shadow:0 0 10px rgba(0,0,0,0.4); 
			    box-shadow:0 0 10px rgba(0,0,0,0.4);
		    	margin-top: 300px;
			}
			.popupmodal:after {
			    content: "";
			    position: fixed;
			    left: 0;
			    top: 0;
			    width: 100%;
			    height: 100%;
			    background: #000;
			    opacity: 0.7;
			    z-index: 9;
			}
			.popupmodal .reveal-modal {
			    z-index: 99;
			}
		</style>
			<div id="container">
				<div class="popupmodal">
				    <div id="exampleModal" class="reveal-modal">
				    	Successfully Registered!!
			    	</div>
			    </div>
			</div>
		<?php
	}
	else{
		?>
		<style type="text/css">
			#container {
			    width: 100%;
			    height: 100%;
			    position: absolute;
			    visibility: visible;
			    display: block;
			}
			.reveal-modal {
		        background: #2a2d35;
			    color: white;
			    margin: 0 auto;
			    text-align: center;
			    width: 500px;
			    position: relative;
			    z-index: 41;
			    top: 25%;
			    padding: 30px;
			    -webkit-box-shadow:0 0 10px rgba(0,0,0,0.4);
			    -moz-box-shadow:0 0 10px rgba(0,0,0,0.4); 
			    box-shadow:0 0 10px rgba(0,0,0,0.4);
		    	margin-top: 300px;
			}
			.popupmodal:after {
			    content: "";
			    position: fixed;
			    left: 0;
			    top: 0;
			    width: 100%;
			    height: 100%;
			    background: #000;
			    opacity: 0.7;
			    z-index: 9;
			}
			.popupmodal .reveal-modal {
			    z-index: 99;
			}
			.popupmodal .reveal-modal.orange {
				color: orange;
			}
		</style>
		<div id="container">
			<div class="popupmodal">
			    <div id="exampleModal" class="reveal-modal orange">
			    	<?php echo $response['errorMessage']; ?>
		    	</div>
		    </div>
		</div>
		<?php
	}
}

/**
 * *****************************************
 *   Validate auth request for Magiclink Email
 * *****************************************
 */
if( !empty( $_GET['auth_validation_token'] ) && !empty( $_GET['auth_request_id'] ) ){
	$auth_validation_token = $_GET['auth_validation_token'];
	$auth_request_id = $_GET['auth_request_id'];
	$user_params = array( 'auth_validation_token' => $auth_validation_token, 'auth_request_id' => $auth_request_id );
	$response = AuthMagicLinkEmail::validate_magiclink_auth_token( $user_params );
	if( $response['status_code'] == 200 ){
		?>
		<style type="text/css">
		#container {
		    width: 100%;
		    height: 100%;
		    position: absolute;
		    visibility: visible;
		    display: block;
		}
		.reveal-modal {
	        background: #2a2d35;
		    color: white;
		    margin: 0 auto;
		    text-align: center;
		    width: 300px;
		    position: relative;
		    z-index: 41;
		    top: 25%;
		    padding: 30px;
		    -webkit-box-shadow:0 0 10px rgba(0,0,0,0.4);
		    -moz-box-shadow:0 0 10px rgba(0,0,0,0.4); 
		    box-shadow:0 0 10px rgba(0,0,0,0.4);
		    margin-top: 300px;
		}
		.popupmodal:after {
		    content: "";
		    position: fixed;
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 100%;
		    background: #000;
		    opacity: 0.7;
		    z-index: 9;
		}
		.popupmodal .reveal-modal {
		    z-index: 99;
		}
		</style>
		<div id="container">
			<div class="popupmodal">
			    <div id="exampleModal" class="reveal-modal">
			    	Successfully Loggedin!!
		    	</div>
		    </div>
		</div>
		<?php
	}
	else{
		?>
		<style type="text/css">
		#container {
		    width: 100%;
		    height: 100%;
		    position: absolute;
		    visibility: visible;
		    display: block;
		}
		.reveal-modal {
	        background: #2a2d35;
		    color: white;
		    margin: 0 auto;
		    text-align: center;
		    width: 500px;
		    position: relative;
		    z-index: 41;
		    top: 25%;
		    padding: 30px;
		    -webkit-box-shadow:0 0 10px rgba(0,0,0,0.4);
		    -moz-box-shadow:0 0 10px rgba(0,0,0,0.4); 
		    box-shadow:0 0 10px rgba(0,0,0,0.4);
		    margin-top: 300px;
		}
		.popupmodal:after {
		    content: "";
		    position: fixed;
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 100%;
		    background: #000;
		    opacity: 0.7;
		    z-index: 9;
		}
		.popupmodal .reveal-modal {
		    z-index: 99;
		}
		.popupmodal .reveal-modal.orange {
			color: orange;
		}
		</style>
		<div id="container">
			<div class="popupmodal">
			    <div id="exampleModal" class="reveal-modal orange">
			    	<?php echo $response['errorMessage']; ?>
		    	</div>
		    </div>
		</div>
		<?php
	}
}

if( !empty( $_POST['flag'] ) ){

	/**
	 * *****************************************
	 * Register Process for Authenticator method
	 * *****************************************
	 */
	if( $_POST['flag'] == 'register_authenticator' ) {
		if( !empty( trim( $_POST['username'] ) ) ){

			$email = trim($_POST["username"]);
			$user_params = array( 'username' => $email );
			$response = AuthArmorUsersAuthenticator::new_user_register_start( $user_params );

			if( $response['status_code'] == 200 && !empty( trim($response['qr_code_data']) ) ) {
				$qr_code_data = trim($response['qr_code_data']);
				$link = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".urlencode($qr_code_data)."&choe=UTF-8";
				$response = array(
							'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="authenticator-response"><div class="authenticator-response-first"><img src="'.$link.'" /><br><br><br><br><br>Please scan the code with the Autharmor app.<br><br>Waiting for device.</div></div></div>',
	                        'status_code' => 200
	                    );
			}
		} else {
			$response = array(
		                        'message' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}
	
	/**
	 * *****************************************
	 * Login Process for Authenticator method
	 * *****************************************
	 */
	if( $_POST['flag'] == 'login_authenticator' ) {
		if( !empty( trim($_POST['username']) ) ){
			$action_name = 'Login';
			$short_msg = 'Magic Login Requested - Click to accept and login';
			$user_params = array( 'username' => trim($_POST['username']), 'action_name' => $action_name, 'short_msg' => $short_msg, 'send_push' => true );
			$response = AuthAuthenticator::auth_request_start( $user_params );
			if( $response['status_code'] == 200 && !empty( trim($response['qr_code_data']) ) ) {
				$qr_code_data = trim($response['qr_code_data']);
				$auth_request_id = trim($response['auth_request_id']);
				$auth_validation_token = trim($response['auth_validation_token']);
				$link = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".urlencode($qr_code_data)."&choe=UTF-8";
				$response = array(
							'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="authenticator-response"><div class="authenticator-response-first"><p>We\'ve sent a push message to your device(s).<br><br>Waiting for device.</p><a class="show_qr">Didn\'t get the push notification? Click here to scan a QR code instead</a></div><div class="qr-code-image-show"><span class="hide-popup-qrcode-btn">Hide QR Code</span><img src="'.$link.'" /><br><br><br><br><br>Please scan the code with the Autharmor app<input type="hidden" name="auth_request_id" id="auth_request_id" class="auth_request_id" value="'.$auth_request_id.'"><input type="hidden" name="auth_validation_token" id="auth_validation_token" class="auth_validation_token" value="'.$auth_validation_token.'"></div></div></div>',
	                        'status_code' => 200
	                    );
			}
		} else {
			$response = array(
		                        'message' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}
	
	/**
	 * *****************************************
	 * Register Process for MagicLinkEmail method
	 * *****************************************
	 */
	if( $_POST['flag'] == 'register_magiclinkemail' ) {

		if( !empty( trim( $_POST['username'] ) ) ){

			$email = trim($_POST["username"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $response = array(
		                        'errorMessage' => 'Invalid email format',
		                        'status_code' => 500
		                    );
			}else{
				$action_name = 'Create Account';
				$short_msg = 'Welcome!! Please verify your email address to create an account.';
				$user_params = array( 'email_address' => $email, 'action_name' => $action_name, 'short_msg' => $short_msg );
				$response = AuthArmorUsersMagicLinkEmail::user_register_start( $user_params );

				if( $response['status_code'] == 200 ) {
					$response = array(
								'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>We\'ve sent you an email. <br><br>Please click the link to finish creating an account.</div>',
		                        'status_code' => 200
		                    );
				}
			}
		} else {
			$response = array(
		                        'errorMessage' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}

	/**
	 * *****************************************
	 * Login Process for MagicLinkEmail method
	 * *****************************************
	 */
	if( $_POST['flag'] == 'login_magiclinkemail' ) {

		if( !empty( trim($_POST['username']) ) ){
			$action_name = 'Login';
			$short_msg = 'Magic Login Requested - Click to accept and login';
			$user_params = array( 'username' => trim($_POST['username']), 'action_name' => $action_name, 'short_msg' => $short_msg );
			$response = AuthMagicLinkEmail::auth_request_start( $user_params );
			if( $response['status_code'] == 200 ) {
				$response = array(
								'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>We\'ve sent a magic link to your email. <br><br>Please check your email.</div>',
		                        'status_code' => 200
		                    );
			}
		} else {
			$response = array(
		                        'message' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}

	/**
	 * *****************************************
	 * Register Process for webauthn method
	 * *****************************************
	 */
	if( $_POST['flag'] == 'register_webauthn' ) {

		if( !empty( trim( $_POST['username'] ) ) ){

			$username = trim($_POST["username"]);
			
			$user_params = array( 'username' => $username );
			if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
				$user_params['email'] = $username;
			}

			$response = AuthArmorUsersWebAuthn::new_user_register_start( $user_params );
		} else {
			$response = array(
		                        'message' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}

	/**
	 * *****************************************
	 * Login Process for webauthn method
	 * *****************************************
	 */
	if( $_POST['flag'] == 'login_webauthn' ) {

		if( !empty( trim($_POST['username']) ) ){
			$action_name = 'Login';
			$short_msg = 'Webauthn Login Requested';
			$user_params = array( 'username' => trim($_POST['username']), 'action_name' => $action_name, 'short_msg' => $short_msg );
			$response = AuthWebAuthn::auth_request_start( $user_params );
			
		} else {
			$response = array(
		                        'message' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}

	/**
	 * *****************************************
	 * While Login display auth methods list based on username entered and registration method type
	 * *****************************************
	 */
	if( $_POST['flag'] == 'check_login_type' ) {

		if( !empty( trim($_POST['username']) ) ){
			$username = trim($_POST['username']);
			$user_id = !empty( trim($_POST['user_id']) ) ? trim($_POST['user_id']) : '00000000-0000-0000-0000-000000000000';

			$headers = array( 'X-AuthArmor-UsernameValue:'.$username );
			$html = '';
			$response = AuthArmorUsers::get_user_by_id( $user_id, $headers );
			if( $response['status_code'] == 200 ){
				if( !empty( $response['enrolled_auth_methods'] ) ){
					$html .= '<div class="popuptext-main">
						<p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>
						<h2>Pick your auth method</h2>
						<div class="auth-methods-list">';
						foreach( $response['enrolled_auth_methods'] as $methods ){
							$auth_method_name = $methods->auth_method_name;
							if( $auth_method_name == 'AuthArmorAuthenticator') {
								$html .='<div class="push-authentication auth-method" data-action-type="login_authenticator" data-class="login">
									<span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 15.4 27.4" style="enable-background:new 0 0 15.4 27.4;" xml:space="preserve">
									<style type="text/css">
										.st0{fill:#FFFFFF;}
									</style>
									<g>
										<path class="st0" d="M13.5,0H1.9c-1.1,0-2,0.9-2,2v23.4c0,1.1,0.9,2,2,2h11.5c1.1,0,2-0.9,2-2V2C15.5,0.9,14.6,0,13.5,0z M4.9,1.2   h5.7c0.1,0,0.3,0.2,0.3,0.5s-0.1,0.5-0.3,0.5H4.9C4.7,2.2,4.6,2,4.6,1.7C4.6,1.4,4.7,1.2,4.9,1.2z M7.7,25.5   c-0.7,0-1.3-0.6-1.3-1.3s0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3S8.4,25.5,7.7,25.5z M14,21.1H1.4V3.4H14C14,3.4,14,21.1,14,21.1z"/>
									</g>
									</svg></span>	
									<span class="title"><h3>Push Authentication</h3></span>
									<span class="text">Send me a push message to my Auth Armor authenticator to login</span>
								</div>';
							}
							if( $auth_method_name == 'Magiclink_Email') {
								$html .='<div class="magic-link-login-email auth-method" data-action-type="login_magiclinkemail" data-class="login">
									<span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 104.2 79.3" style="enable-background:new 0 0 104.2 79.3;" xml:space="preserve">
									<style type="text/css">
										.st0{fill:#FFFFFF;}
									</style>
									<path class="st0" d="M52.3,0.2h-0.5h-52v4.9v74.1h52h0.5h52V5.1V0.2H52.3z M51.9,7.2h0.5h40.1L54.5,45c-0.9,0.7-1.7,1-2.4,1.1  c-0.8-0.1-1.6-0.4-2.4-1.1L11.8,7.2H51.9z M6.8,12.1l27.5,27.6L6.8,67.2V12.1z M52.3,72.2h-0.5H11.8l27.5-27.5l5.8,5.8  c2.2,1.7,4.4,2.6,6.7,2.8v0c0.1,0,0.2,0,0.2,0c0.1,0,0.2,0,0.2,0v0c2.3-0.1,4.6-1,6.7-2.8l5.8-5.8l27.5,27.5H52.3z M97.4,67.2  L69.8,39.7l27.5-27.6V67.2z"/>
									</svg></span>							
									<span class="title"><h3>Magic Link Login Email</h3></span>
									<span class="text">Send me a magic link email to login</span>
								</div>';
							}
							if( $auth_method_name == 'WebAuthN') {
								$html .='<div class="web-authn auth-method" data-action-type="login_webauthn" data-class="login">
									<span class="icon"><svg id="Icons" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#FFFFFF;}</style></defs><path class="cls-1" d="M22.814,9.216l-.826-5.368A1,1,0,0,0,21,3C15.533,3,12.731.316,12.707.293a1,1,0,0,0-1.41,0C11.269.316,8.467,3,3,3a1,1,0,0,0-.988.848L1.186,9.216A12.033,12.033,0,0,0,7.3,21.576l4.22,2.3a1,1,0,0,0,.958,0l4.22-2.3A12.033,12.033,0,0,0,22.814,9.216Zm-7.072,10.6L12,21.861,8.258,19.82a10.029,10.029,0,0,1-5.1-10.3l.7-4.541A14.717,14.717,0,0,0,12,2.3,14.717,14.717,0,0,0,20.139,4.98l.7,4.54A10.029,10.029,0,0,1,15.742,19.82Z"/><path class="cls-1" d="M15.293,8.293,10,13.586,8.707,12.293a1,1,0,1,0-1.414,1.414l2,2a1,1,0,0,0,1.414,0l6-6a1,1,0,0,0-1.414-1.414Z"/></svg></span>	
									<span class="title"><h3>Webauthn</h3></span>
									<span class="text">Login using Webauthn</span>
								</div>';
							}
						}
						$html .= '</div></div>';	
						$response = array(
	                        'message' => $html,
	                        'status_code' => 200
	                    );				
				}else{
					$response = array(
	                        'errorMessage' => 'This user is not enrolled for any authentication method.',
	                        'status_code' => 500
	                    );
				}
			}
			
		} else {
			$response = array(
		                        'errorMessage' => 'Username is a required field.',
		                        'status_code' => 500
		                    );
		}
		echo json_encode( $response );
	}

	/**
	 * *****************************************
	 * Automatically check if user is created ( scan QR successfully ) and displayed message
	 * *****************************************
	 */
	if( $_POST['flag'] == 'check_user_status_by_username' ) {
		$username = trim($_POST['username']);
		$user_id = !empty( trim($_POST['user_id']) ) ? trim($_POST['user_id']) : '00000000-0000-0000-0000-000000000000';

		$headers = array( 'X-AuthArmor-UsernameValue:'.$username );
		$time = 5;
		$flag = true;
		while($flag == true){
			if( $time <= 200 ) {
				$response = AuthArmorUsers::get_user_by_id( $user_id, $headers );
				if( $response['status_code'] == 200 && !empty( $response['enrolled_auth_methods'] ) ){
					$method_flag = false;
					foreach( $response['enrolled_auth_methods'] as $methods ){
						$auth_method_name = $methods->auth_method_name;
						if( $auth_method_name == 'AuthArmorAuthenticator') {
							$method_flag = true;
						}
					}
					if( $method_flag == true ){
						break;
					}
				}
				sleep(5);
				$time += 5;
			}else{
				$flag = false;
			}
		}
		if( $response['status_code'] == 200 ){
			$response = array(
                        'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>Successfully Registered!!</div>',
                        'status_code' => 200
                    );
		} else{
			$response = array(
                        'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="response-data orange">Timeout</div></div>',
                        'status_code' => 500
                    );
		}
		echo json_encode($response);
	}

	/**
	 * *****************************************
	 * Automatically check if user is logged in ( scan QR successfully ) and displayed message 
	 * *****************************************
	 */
	if( $_POST['flag'] == 'check_user_status_by_username_login' ) {
		$username = trim($_POST['username']);
		$user_id = !empty( trim($_POST['user_id']) ) ? trim($_POST['user_id']) : '00000000-0000-0000-0000-000000000000';

		$headers = array( 'X-AuthArmor-UsernameValue:'.$username );
		$time = 5;
		$flag = true;
		while($flag == true){
			if( $time <= 200 ) {
				$response = AuthInfo::get_auth_info( trim($_POST['auth_request_id']) );
				if( $response['auth_request_status_id'] == 4 ){
					break;
				}
				sleep(5);
				$time += 5;
			}else{
				$flag = false;
			}
		}
		if( $response['auth_request_status_id'] == 4 ){
			$auth_validation_token = trim($_POST['auth_validation_token']);
			$auth_request_id = trim($_POST['auth_request_id']);
			$user_params = array( 'auth_validation_token' => $auth_validation_token, 'auth_request_id' => $auth_request_id );
			$response = AuthAuthenticator::validate_authenticator_auth_token( $user_params );
			if( $response['status_code'] == 200 ) {
				$response = array(
							'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>Loggedin Successfully!!</div>',
	                        'status_code' => 200
	                    );
			}else{
				$response = array(
                        'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="response-data orange">Timeout</div></div>',
                        'status_code' => 500
                    );
			}
		} else{
			$response = array(
                        'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p><div class="response-data orange">Timeout</div></div>',
                        'status_code' => 500
                    );
		}
		echo json_encode($response);
	}

	/**
	 * *****************************************
	 * Webauthn user register finish process after getting success response from SDK payload
	 * *****************************************
	 */
	if( $_POST['flag'] == 'register_webauthn_finish_call' ) {
		$payload = $_POST['payload'];
		$authenticator_response_data = array(
										"id" => $payload['authenticator_response_data']['id'],
										"attestation_object" => $payload['authenticator_response_data']['attestation_object'],
										"client_data" => $payload['authenticator_response_data']['client_data']
									);
		$user_params = array(
						"registration_id" => $payload['registration_id'],
						"aa_sig" => $payload['aa_sig'],
						"authenticator_response_data" => $payload['authenticator_response_data'],
						"webauthn_client_id" => $payload['webauthn_client_id']
					);

		$response = AuthArmorUsersWebAuthn::new_user_register_finish( $user_params );
		if( $response['status_code'] == 200 ) {
			$response = array(
						'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>Registered Successfully!!</div>',
                        'status_code' => 200
                    );
		}
		echo json_encode($response);
	}

	/**
	 * *****************************************
	 * Webauthn user login finish process after get the payload success from SDK
	 * *****************************************
	 */
	if( $_POST['flag'] == 'login_webauthn_finish_call' ) {
		$payload = $_POST['payload'];
		$user_params = array(
						"aa_sig" => $payload['aa_sig'],
						"auth_request_id" => $payload['auth_request_id'],
						"webauthn_client_id" => $payload['webauthn_client_id'],
						"authenticator_response_data" => json_encode($payload['authenticator_response_data'])
					);

		$response = AuthWebAuthn::auth_request_finish( $user_params );

		if( $response['status_code'] == 200 && !empty( $response['auth_validation_token'] ) && !empty( $response['auth_request_id'] ) ) {
			$user_params = array(
							"auth_request_id" => $response['auth_request_id'],
							"auth_validation_token" => $response['auth_validation_token']
						);

			$response = AuthWebAuthn::validate_webauthn_auth_token( $user_params );

			if( $response['status_code'] == 200 ) {
				$response = array(
							'message' => '<div class="popuptext-main"><p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>Loggedin Successfully!!</div>',
	                        'status_code' => 200
	                    );
			}
		}
		echo json_encode($response);
	}
	
	/**
	 * *****************************************
	 * Get All Users
	 * *****************************************
	 */
	if( $_POST['flag'] == 'get_users' ) {
		$username = !empty( $_POST['username'] ) ? $_POST['username'] : ''; 
		$response = AuthArmorUsers::get_users();
		echo "<pre><code>";print_r( $response );echo"</code></pre>";
	}

	/**
	 * *****************************************
	 * Get User By Id
	 * *****************************************
	 */
	if( $_POST['flag'] == 'get_user_by_id' ) {	
		/* Get User By Id start */
		$response = AuthArmorUsers::get_user_by_id( $_POST['user_id'] );
		echo "<pre><code>";print_r( $response );echo"</code></pre>";
	}

	/**
	 * *****************************************
	 * Get Auth History for User
	 * *****************************************
	 */
	if( $_POST['flag'] == 'get_auth_history' ) {
		$response = AuthArmorUsers::get_auth_history_by_userid( $_POST['user_id'] );
		echo "<pre><code>";print_r( $response );echo"</code></pre>";
	}
}
?>