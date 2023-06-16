<?php

/**
 * AuthArmorUsersMagicLinkEmail Class
 * Manage user's Registration/Login/Update using Magiclink Email Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorUsersMagicLinkEmail' ) ) {

	class AuthArmorUsersMagicLinkEmail {

		/**
		 * Start User Registration for MagicLink
		 * Api Version : V3
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 * When you register the user through the MagicLink Email method then you must have to validate the
		 * user through validate_magiclink_registration_token function.
		 * You need to pass the registration_validation_token in parameters when you validate the user through the MagicLink Email method. 
		 */
		public function user_register_start( $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/users/magiclink_email/register/start';
			$params['registration_redirect_url'] = AUTHARMOR_API_REG_REDIRECT_URL;
			$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Start Change Users Email Address
		 * Api Version : V3
		 * @param    	$user_id|string 
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 * When you change the user email through the MagicLink Email method then you must have to validate
		 * the user through validate_magiclink_registration_token function.
		 * You need to pass the registration_validation_token in parameters when you validate the user through the MagicLink Email method. 
		 */
		public function change_user_email_start( $user_id = '', $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/users/'.$user_id.'/magiclink_email/update/start';

			if ( !empty( $user_id ) ){
				$args = array();
				if( !empty( $headers ) ){
					$args['headers'] = $headers;
				}
				$params['registration_redirect_url'] = AUTHARMOR_API_REG_REDIRECT_URL;
				$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
				
				$args['params'] = $params;
				$result = $auth_armor_main->post( $api_url, $args );
			} else {
	            $result = array(
	                        'user_id' => '$user_id is missing or empty',
	                        'status_code' => 500
	                    );
	            if( AUTHARMOR_API_LOG_ENABLE == true ){
	            	AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => $params, 'message' => $result ) );
	            }
	        }

			return $result;
		}


		/**
		 * Create Magiclink Email Record for existing user
		 * Api Version : V3
		 * @param    	$user_id|string 
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function create_magiclink_email_existing_user( $user_id = '', $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/users/'.$user_id.'/magiclink_email/register/start';
			
			if ( !empty( $user_id ) ){
				$args = array();
				if( !empty( $headers ) ){
					$args['headers'] = $headers;
				}
				$params['registration_redirect_url'] = AUTHARMOR_API_REG_REDIRECT_URL;
				$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
				
				$args['params'] = $params;
				$result = $auth_armor_main->post( $api_url, $args );
			} else {
	            $result = array(
	                        'user_id' => '$user_id is missing or empty',
	                        'status_code' => 500
	                    );
	            if( AUTHARMOR_API_LOG_ENABLE == true ){
	            	AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => $params, 'message' => $result ) );
	            }
	        }

			return $result;
		}


		/**
		 * Validate MagicLink Registration Token
		 * Api Version : V3
		 * @param    	$params|array
		 * @return 		$result|array
		 */
		public function validate_magiclink_registration_token( $params = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/users/register/magiclink_email/validate';
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}

	} // End Of Class
}