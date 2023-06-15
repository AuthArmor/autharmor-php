<?php
// Retrieve the value of the environment variable
$AUTHARMOR_CLIENT_ID = getenv('AUTHARMOR_CLIENT_ID');
$AUTHARMOR_CLIENT_SECRET = getenv('AUTHARMOR_CLIENT_SECRET');
$AUTHARMOR_WEBAUTHN_CLIENT_ID = getenv('AUTHARMOR_WEBAUTHN_CLIENT_ID');
$AUTHARMOR_API_REG_REDIRECT_URL = getenv('AUTHARMOR_API_REG_REDIRECT_URL');
$AUTHARMOR_REDIRECT_URL = getenv('AUTHARMOR_REDIRECT_URL');

if ($AUTHARMOR_CLIENT_ID === false) {
    echo '<pre>'; print_r('AUTHARMOR_CLIENT_ID Variable not found.'); echo '</pre>'; exit();
} else {
	if( empty($AUTHARMOR_CLIENT_ID) ) {
		echo '<pre>'; print_r('AUTHARMOR_CLIENT_ID Variable value is empty.'); echo '</pre>'; exit();
	}
}

if ($AUTHARMOR_CLIENT_SECRET === false) {
    echo '<pre>'; print_r('AUTHARMOR_CLIENT_SECRET Variable not found'); echo '</pre>'; exit();
} else {
	if( empty($AUTHARMOR_CLIENT_SECRET) ) {
		echo '<pre>'; print_r('AUTHARMOR_CLIENT_SECRET Variable value is empty.'); echo '</pre>'; exit();
	}
}

if ($AUTHARMOR_WEBAUTHN_CLIENT_ID === false) {
    echo '<pre>'; print_r('AUTHARMOR_WEBAUTHN_CLIENT_ID Variable not found'); echo '</pre>'; exit();
} else {
	if( empty($AUTHARMOR_WEBAUTHN_CLIENT_ID) ) {
		echo '<pre>'; print_r('AUTHARMOR_WEBAUTHN_CLIENT_ID Variable value is empty.'); echo '</pre>'; exit();
	}
}

if ($AUTHARMOR_API_REG_REDIRECT_URL === false) {
    echo '<pre>'; print_r('AUTHARMOR_API_REG_REDIRECT_URL Variable not found'); echo '</pre>'; exit();
} else {
	if( empty($AUTHARMOR_API_REG_REDIRECT_URL) ) {
		echo '<pre>'; print_r('AUTHARMOR_API_REG_REDIRECT_URL Variable value is empty.'); echo '</pre>'; exit();
	}
}

if ($AUTHARMOR_REDIRECT_URL === false) {
    echo '<pre>'; print_r('AUTHARMOR_REDIRECT_URL Variable not found'); echo '</pre>'; exit();
} else {
	if( empty($AUTHARMOR_REDIRECT_URL) ) {
		echo '<pre>'; print_r('AUTHARMOR_REDIRECT_URL Variable value is empty.'); echo '</pre>'; exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>AuthArmor PHP SDK</title>
  		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<script src="https://cdn.autharmor.com/scripts/autharmor-webauthn-sdk/v3.0.0/autharmor-webauthn-sdk.js"></script>
		<script type="text/javascript">
			// AuthArmour WebAuth Client ID Here
		    let webauthnClientId = '<?php echo $AUTHARMOR_WEBAUTHN_CLIENT_ID; ?>'; // For SDK JS file :: Usage in script.js
		</script>
		<script src="script.js"></script>
	</head>
	<body>
		<div class="login-register-demo-main">
			<div class="login-register-demo">
				<div class="login-register-form">
					<div class="tab">
						<button class="tablinks active" data-class="Login" >Login</button>
						<button class="tablinks" data-class="Register">Register</button>
					</div>

					<div id="Login" class="tabcontent" style="display: block;">
						<div class="login-main">
							<h3>Sign in with your Username</h3>
							<form name="login_form" id="login_form" method="post">
								<input type="hidden" name="flag" id="flag" value="auth_requestMLE">
								<div class="user-row">
									<label for="username">Username</label>
									<input type="text" name="username" id="username" class="login-username">
								</div>
								<br>
								<input type="button" class="button" name="submit" id="Submit" value="Login">
							</form>
						</div>
					</div>

					<div id="Register" class="tabcontent">
						<div class="register-main">
							<h3>Sign up with your Username</h3>
							<form name="register_form" id="register_form" method="post">
								<input type="hidden" name="flag" id="flag" value="auth_requestMLE">
								<div class="user-row">
									<label for="username">Username</label>
									<input type="text" name="username" id="username" class="register-username">
								</div>
								<br>
								<input type="button" class="register-button" name="submit" id="Submit" value="Register">
							</form>
						</div>
					</div>
				</div>
				<div class="popup">
					<div class="popuptext" id="myPopup">
					</div>
				</div>

				<div class="popup-success">
					<div class="popuptext-success" id="myPopup-success">
					</div>
				</div>

				<div class="popup-register">
					<div class="popuptext-register" id="myPopup-register">
						<div class="popuptext-main">
							<p class="popuptext-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg></p>
							<h2>Pick your auth method</h2>
							<div class="auth-methods-list">
								<div class="push-authentication auth-method" data-action-type="register_authenticator" data-class="register">
									<span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 15.4 27.4" style="enable-background:new 0 0 15.4 27.4;" xml:space="preserve">
									<style type="text/css">
										.st0{fill:#FFFFFF;}
									</style>
									<g>
										<path class="st0" d="M13.5,0H1.9c-1.1,0-2,0.9-2,2v23.4c0,1.1,0.9,2,2,2h11.5c1.1,0,2-0.9,2-2V2C15.5,0.9,14.6,0,13.5,0z M4.9,1.2   h5.7c0.1,0,0.3,0.2,0.3,0.5s-0.1,0.5-0.3,0.5H4.9C4.7,2.2,4.6,2,4.6,1.7C4.6,1.4,4.7,1.2,4.9,1.2z M7.7,25.5   c-0.7,0-1.3-0.6-1.3-1.3s0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3S8.4,25.5,7.7,25.5z M14,21.1H1.4V3.4H14C14,3.4,14,21.1,14,21.1z"/>
									</g>
									</svg></span>	
									<span class="title"><h3>Authenticator App Register</h3></span>
									<span class="text">Scan QR code to register</span>
								</div>
								<div class="magic-link-login-email auth-method" data-action-type="register_magiclinkemail" data-class="register">
									<span class="icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 104.2 79.3" style="enable-background:new 0 0 104.2 79.3;" xml:space="preserve">
									<style type="text/css">
										.st0{fill:#FFFFFF;}
									</style>
									<path class="st0" d="M52.3,0.2h-0.5h-52v4.9v74.1h52h0.5h52V5.1V0.2H52.3z M51.9,7.2h0.5h40.1L54.5,45c-0.9,0.7-1.7,1-2.4,1.1  c-0.8-0.1-1.6-0.4-2.4-1.1L11.8,7.2H51.9z M6.8,12.1l27.5,27.6L6.8,67.2V12.1z M52.3,72.2h-0.5H11.8l27.5-27.5l5.8,5.8  c2.2,1.7,4.4,2.6,6.7,2.8v0c0.1,0,0.2,0,0.2,0c0.1,0,0.2,0,0.2,0v0c2.3-0.1,4.6-1,6.7-2.8l5.8-5.8l27.5,27.5H52.3z M97.4,67.2  L69.8,39.7l27.5-27.6V67.2z"/>
									</svg></span>							
									<span class="title"><h3>Magic Link Email Register</h3></span>
									<span class="text">Send me a magic link email to register</span>
								</div>
								<div class="web-authn auth-method" data-action-type="register_webauthn" data-class="register">
									<span class="icon"><svg id="Icons" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#FFFFFF;}</style></defs><path class="cls-1" d="M22.814,9.216l-.826-5.368A1,1,0,0,0,21,3C15.533,3,12.731.316,12.707.293a1,1,0,0,0-1.41,0C11.269.316,8.467,3,3,3a1,1,0,0,0-.988.848L1.186,9.216A12.033,12.033,0,0,0,7.3,21.576l4.22,2.3a1,1,0,0,0,.958,0l4.22-2.3A12.033,12.033,0,0,0,22.814,9.216Zm-7.072,10.6L12,21.861,8.258,19.82a10.029,10.029,0,0,1-5.1-10.3l.7-4.541A14.717,14.717,0,0,0,12,2.3,14.717,14.717,0,0,0,20.139,4.98l.7,4.54A10.029,10.029,0,0,1,15.742,19.82Z"/><path class="cls-1" d="M15.293,8.293,10,13.586,8.707,12.293a1,1,0,1,0-1.414,1.414l2,2a1,1,0,0,0,1.414,0l6-6a1,1,0,0,0-1.414-1.414Z"/></svg></span>	
									<span class="title"><h3>Webauthn</h3></span>
									<span class="text">Register using Webauthn</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="popup-success-register">
					<div class="popuptext-success-register" id="myPopup-success-register">
					</div>
				</div>
			</div>
		</div>
	</body>
</html>