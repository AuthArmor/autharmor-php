
# AuthArmor PHP SDK V3

You can integrate the AuthArmor PHP SDK into your website by installing the package: 

# 🏁 Installation

You need to download the **[AuthArmor-PHP-SDK.zip](https://google.com)** file from here and unzip in your website ```/library/third-party/asset/``` folder.


# 🧭 Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`AUTHARMOR_CLIENT_ID`
`AUTHARMOR_CLIENT_SECRET`
`AUTHARMOR_WEBAUTHN_CLIENT_ID`
`AUTHARMOR_API_REG_REDIRECT_URL`
`AUTHARMOR_REDIRECT_URL`
`AUTHARMOR_API_TIMEOUT`
`AUTHARMOR_API_LOG_ENABLE`

To set an environment variable specifically for PHP, you have a couple of options depending on your specific requirements and the server configuration:

Using ```.htaccess``` file: If you're using Apache as your web server, you can use the .htaccess file to set environment variables. Create or modify the .htaccess file in the root directory of your PHP application and add the following line:

```code
SetEnv AUTHARMOR_CLIENT_ID xxxxxx-xxxx-xxxx-xxxx-xxxxxxxx
SetEnv AUTHARMOR_CLIENT_SECRET xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
SetEnv AUTHARMOR_WEBAUTHN_CLIENT_ID xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxx
SetEnv AUTHARMOR_API_REG_REDIRECT_URL https://<WEBSITE_REDIRECT_URL>
SetEnv AUTHARMOR_REDIRECT_URL https://<WEBSITE_REDIRECT_URL>
SetEnv AUTHARMOR_API_TIMEOUT 300
SetEnv AUTHARMOR_API_LOG_ENABLE 1
```
Using PHP configuration files: If you have access to the PHP configuration files (php.ini), you can set environment variables globally for PHP. Open the php.ini file and look for the following line:

```code
env.AUTHARMOR_CLIENT_ID = xxxxxx-xxxx-xxxx-xxxx-xxxxxxxx
env.AUTHARMOR_CLIENT_SECRET = xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
env.AUTHARMOR_WEBAUTHN_CLIENT_ID = xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxx
env.AUTHARMOR_API_REG_REDIRECT_URL = https://<WEBSITE_REDIRECT_URL>
env.AUTHARMOR_REDIRECT_URL = https://<WEBSITE_REDIRECT_URL>
env.AUTHARMOR_API_TIMEOUT = 300
env.AUTHARMOR_API_LOG_ENABLE = 1
```

# 🚀 Usage

## Initializing the SDK
You need to include ```Main.php``` file in your code file where you building the logic for registartion and login.

i.e: ```require_once( '../Main.php' );```

## Authenticator App Register

```php
// $email is post input value from user (email or username)
$user_params = array( 'username' => $email ); 
$response = AuthArmorUsersAuthenticator::new_user_register_start( $user_params );
```

## Magic Link Email Register

```php
$action_name = 'Create Account'; // Email action name text content

// Email message title content 
$short_msg = 'Welcome!! Please verify your email address to create an account.';

// $email is post input value from user (must be a valid email)
$user_params = array( 
                    'email_address' => $email,
                    'action_name' => $action_name, 
                    'short_msg' => $short_msg 
                );

$response = AuthArmorUsersMagicLinkEmail::user_register_start( $user_params );
```
User (```$email```) will get the email with tokenized varification link. Once user click on that link then you need to verify it by calling the below function: 

```php
// You will get registration_validation_token from the email link
$registration_validation_token = $_GET['registration_validation_token'];
$user_params = array( 'registration_validation_token' => $registration_validation_token );
$response = AuthArmorUsersMagicLinkEmail::validate_magiclink_registration_token( $user_params );
```

## Webauthn Register

```php
// $username is post input value from user (email or username)
$user_params = array( 'username' => $username );
$response = AuthArmorUsersWebAuthn::new_user_register_start( $user_params );
```
You need to pass the above response to [AuthArmor WebAuthn SDK](https://github.com/AuthArmor/autharmor-webauthn).

You'll get the response from Javascript SDK as the below

```javascript 
const payload = await SDK.create(fido2Challenge);
// Send payload to your backend for verification using the AuthArmor backend SDK!
```
and send the response to the below php code.
```php
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
```

## Authenticator App Login

```php
$action_name = 'Login'; // Action name text content

// Message title content 
$short_msg = 'Magic Login Requested - Click to accept and login';

// $username is post input value from user (email or username)
$user_params = array( 
                    'username' => $username, 
                    'action_name' => $action_name, 
                    'short_msg' => $short_msg, 
                    'send_push' => true 
                );

$response = AuthAuthenticator::auth_request_start( $user_params );
```

## Magic Link Email Login

```php
$action_name = 'Login'; // Action name text content

// Message title content 
$short_msg = 'Magic Login Requested - Click to accept and login';

// $username is post input value from user (email or username)
$user_params = array( 
                    'username' => $email, 
                    'action_name' => $action_name, 
                    'short_msg' => $short_msg 
                );

$response = AuthMagicLinkEmail::auth_request_start( $user_params );
```
User (```$email```) will get the email with tokenized varification link. Once user click on that link then you need to verify it by calling the below function: 

```php
// You will get auth_validation_token from the email link
$auth_validation_token = $_GET['auth_validation_token'];
// You will get auth_request_id from the email link
$auth_request_id = $_GET['auth_request_id'];

$user_params = array( 
                    'auth_validation_token' => $auth_validation_token, 
                    'auth_request_id' => $auth_request_id 
                );

$response = AuthMagicLinkEmail::validate_magiclink_auth_token( $user_params );
```

## Webauthn Login

```php
$action_name = 'Login'; // Action name text content

// Message title content 
$short_msg = 'Webauthn Login Requested';

// $username is post input value from user (email or username)
$user_params = array(
                    'username' => $username,
                    'action_name' => $action_name,
                    'short_msg' => $short_msg
                );
                
$response = AuthWebAuthn::auth_request_start( $user_params );
```
You need to pass the above response to [AuthArmor WebAuthn SDK](https://github.com/AuthArmor/autharmor-webauthn).

You'll get the response from Javascript SDK as the below

```javascript 
const payload = await SDK.get(challenge.fido2_json_response);
// Send payload to your backend for verification using the AuthArmor backend SDK!
```
and send the response to the below php code.

```php
$user_params = array(
                    "aa_sig" => $payload['aa_sig'],
                    "auth_request_id" => $payload['auth_request_id'],
                    "webauthn_client_id" => $payload['webauthn_client_id'],
                    "authenticator_response_data" => json_encode($payload['authenticator_response_data'])
                );

$response = AuthWebAuthn::auth_request_finish( $user_params );
```
Once you get the response from above then send it to the below php code.

```php
$user_params = array(
                    "auth_request_id" => $response['auth_request_id'],
                    "auth_validation_token" => $response['auth_validation_token']
                );

$response = AuthWebAuthn::validate_webauthn_auth_token( $user_params );
```

# 🎲 Example

Run the URL ```<YOUR_WEBSITE_URL>/autharmor/examples```.
