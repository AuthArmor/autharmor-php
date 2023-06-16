<?php

/**
 * ********************************
 * 
 * Include all constants and files
 * Api Version : V3
 * 
 * ********************************
 */

/**
 * **********************************************************************************
 * 
 * Need to change constant values based on your configuration
 * For credentials : please visit https://dashboard.autharmor.com and select your project then
 * Get Client ID and Client Secret from API Keys tab - src/images/api_keys.png
 * Get WebAuthn client ID from WebAuthn tab - src/images/webauthn_client.png
 * Get Registration redirect URL from Magiclink Emails tab - src/images/magiclink_email_redirect.png
 * Get Auth redirect URL from Magiclink Emails tab - src/images/magiclink_email_redirect.png
 * 
 * **********************************************************************************
 */

$AUTHARMOR_CLIENT_ID = getenv('AUTHARMOR_CLIENT_ID'); // AuthArmour Client ID
$AUTHARMOR_CLIENT_SECRET = getenv('AUTHARMOR_CLIENT_SECRET'); // AuthArmour Client Secret
$AUTHARMOR_WEBAUTHN_CLIENT_ID = getenv('AUTHARMOR_WEBAUTHN_CLIENT_ID'); // AuthArmour WebAuth Client ID
$AUTHARMOR_API_REG_REDIRECT_URL = getenv('AUTHARMOR_API_REG_REDIRECT_URL'); // AuthArmour Redirection URL For Registrations
$AUTHARMOR_REDIRECT_URL = getenv('AUTHARMOR_REDIRECT_URL'); // AuthArmour Redirection URL

// AuthArmour Client ID
if ($AUTHARMOR_CLIENT_ID === false) {
    $response = array(
                    'message' => 'Error: AUTHARMOR_CLIENT_ID Variable not found.',
                    'errorMessage' => 'Error: AUTHARMOR_CLIENT_ID Variable not found.',
                    'status_code' => 404
                );
    echo json_encode( $response ); exit();
} else {
    if( empty($AUTHARMOR_CLIENT_ID) ) {
        $response = array(
                    'message' => 'Error: AUTHARMOR_CLIENT_ID Variable value is empty.',
                    'errorMessage' => 'Error: AUTHARMOR_CLIENT_ID Variable value is empty.',
                    'status_code' => 404
                );
        echo json_encode( $response ); exit();
    } else {
        if( !defined( 'AUTHARMOR_CLIENT_ID' ) ) {
            define( 'AUTHARMOR_CLIENT_ID', $AUTHARMOR_CLIENT_ID );
        }
    }
}

// AuthArmour Client Secret
if ($AUTHARMOR_CLIENT_SECRET === false) {
    $response = array(
                    'message' => 'Error: AUTHARMOR_CLIENT_SECRET Variable not found.',
                    'errorMessage' => 'Error: AUTHARMOR_CLIENT_SECRET Variable not found.',
                    'status_code' => 404
                );
    echo json_encode( $response ); exit();
} else {
    if( empty($AUTHARMOR_CLIENT_SECRET) ) {
        $response = array(
                    'message' => 'Error: AUTHARMOR_CLIENT_SECRET Variable value is empty.',
                    'errorMessage' => 'Error: AUTHARMOR_CLIENT_SECRET Variable value is empty.',
                    'status_code' => 404
                );
        echo json_encode( $response ); exit();
    } else {
        if( !defined( 'AUTHARMOR_CLIENT_SECRET' ) ) {
            define( 'AUTHARMOR_CLIENT_SECRET', $AUTHARMOR_CLIENT_SECRET );
        }
    }
}

// AuthArmour WebAuth Client ID
if ($AUTHARMOR_WEBAUTHN_CLIENT_ID === false) {
    $response = array(
                    'message' => 'Error: AUTHARMOR_WEBAUTHN_CLIENT_ID Variable not found.',
                    'errorMessage' => 'Error: AUTHARMOR_WEBAUTHN_CLIENT_ID Variable not found.',
                    'status_code' => 404
                );
    echo json_encode( $response ); exit();
} else {
    if( empty($AUTHARMOR_WEBAUTHN_CLIENT_ID) ) {
        $response = array(
                    'message' => 'Error: AUTHARMOR_WEBAUTHN_CLIENT_ID Variable value is empty.',
                    'errorMessage' => 'Error: AUTHARMOR_WEBAUTHN_CLIENT_ID Variable value is empty.',
                    'status_code' => 404
                );
        echo json_encode( $response ); exit();
    } else {
        if( !defined( 'AUTHARMOR_WEBAUTHN_CLIENT_ID' ) ) {
            define( 'AUTHARMOR_WEBAUTHN_CLIENT_ID', $AUTHARMOR_WEBAUTHN_CLIENT_ID );
        }
    }
}

// AuthArmour Redirection URL For Registrations
if ($AUTHARMOR_API_REG_REDIRECT_URL === false) {
    $response = array(
                    'message' => 'Error: AUTHARMOR_API_REG_REDIRECT_URL Variable not found.',
                    'errorMessage' => 'Error: AUTHARMOR_API_REG_REDIRECT_URL Variable not found.',
                    'status_code' => 404
                );
    echo json_encode( $response ); exit();
} else {
    if( empty($AUTHARMOR_API_REG_REDIRECT_URL) ) {
        $response = array(
                    'message' => 'Error: AUTHARMOR_API_REG_REDIRECT_URL Variable value is empty.',
                    'errorMessage' => 'Error: AUTHARMOR_API_REG_REDIRECT_URL Variable value is empty.',
                    'status_code' => 404
                );
        echo json_encode( $response ); exit();
    } else {
        if( !defined( 'AUTHARMOR_API_REG_REDIRECT_URL' ) ) {
            define( 'AUTHARMOR_API_REG_REDIRECT_URL', $AUTHARMOR_API_REG_REDIRECT_URL );
        }
    }
}

// AuthArmour Redirection URL
if ($AUTHARMOR_REDIRECT_URL === false) {
    $response = array(
                    'message' => 'Error: AUTHARMOR_REDIRECT_URL Variable not found',
                    'errorMessage' => 'Error: AUTHARMOR_REDIRECT_URL Variable not found',
                    'status_code' => 404
                );
    echo json_encode( $response ); exit();
} else {
    if( empty($AUTHARMOR_REDIRECT_URL) ) {
        $response = array(
                    'message' => 'Error: AUTHARMOR_REDIRECT_URL Variable value is empty.',
                    'errorMessage' => 'Error: AUTHARMOR_REDIRECT_URL Variable value is empty.',
                    'status_code' => 404
                );
        echo json_encode( $response ); exit();
    } else {
        if( !defined( 'AUTHARMOR_REDIRECT_URL' ) ) {
            define( 'AUTHARMOR_REDIRECT_URL', $AUTHARMOR_REDIRECT_URL );
        }
    }
}

// AuthArmour Timeout In Seconds :: Default 300
if( !defined( 'AUTHARMOR_API_TIMEOUT' ) ) {
    if ( getenv( 'AUTHARMOR_API_TIMEOUT' ) !== false || !empty(getenv( 'AUTHARMOR_API_TIMEOUT' )) ) {
        define( 'AUTHARMOR_API_TIMEOUT', getenv( 'AUTHARMOR_API_TIMEOUT' ) );
    } else {
        define( 'AUTHARMOR_API_TIMEOUT', 300 );
    }
}

// Enable Log :: Default true
if( !defined( 'AUTHARMOR_API_LOG_ENABLE' ) ) {
    if ( getenv( 'AUTHARMOR_API_LOG_ENABLE' ) !== false || !empty(getenv( 'AUTHARMOR_API_LOG_ENABLE' )) ) {
        define( 'AUTHARMOR_API_LOG_ENABLE', getenv( 'AUTHARMOR_API_LOG_ENABLE' ) );
    } else {
        define( 'AUTHARMOR_API_LOG_ENABLE', true ); // Enable API error log
    }
}

/**
 * *****************************************
 * 
 * Do not change the below constant values
 * 
 * *****************************************
 */

if( !defined( 'AUTHARMOR_API_URL' ) ) {
    define( 'AUTHARMOR_API_URL', 'https://api.autharmor.com' );
}
if( AUTHARMOR_API_LOG_ENABLE == true ){
	if( !defined( 'AUTHARMOR_API_LOG_FILE_PATH' ) ) {
	    define( 'AUTHARMOR_API_LOG_FILE_PATH', dirname(__FILE__).'/logs.txt' );
	}
	require_once( 'src/AuthArmorLogs.php' ); // Manage API logs
}

global $auth_armor_authentication, $auth_armor_main; // Global declaration

require_once( 'src/AuthArmorAuthentication.php' ); // Manage authentication functions
$auth_armor_authentication = new AuthArmorAuthentication();

require_once( 'src/AuthArmorMain.php' ); // Manage api call functions
$auth_armor_main = new AuthArmorMain();

require_once( 'src/AuthArmorUsers.php' ); // Manage users functions
require_once( 'src/AuthArmorUsersWebAuthn.php' ); // Manage user's Registration/Login using WebAuthn Auth Method
require_once( 'src/AuthArmorUsersMagicLinkEmail.php' ); // Manage user's Registration/Login/Update using Magiclink Email Auth Method
require_once( 'src/AuthArmorUsersAuthenticator.php' ); // Manage user's Registration/Login using Authenticator Auth Method
require_once( 'src/AuthWebAuthn.php' ); // Manage auth functions using WebAuthn Auth method
require_once( 'src/AuthMagicLinkEmail.php' ); // Manage auth functions using Magiclink Email Auth method
require_once( 'src/AuthAuthenticator.php' ); // Manage auth functions using Authenticator Auth method
require_once( 'src/AuthInfo.php' ); // Get Auth Info