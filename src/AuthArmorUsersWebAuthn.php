<?php

/**
 * AuthArmorUsersWebAuthn Class
 * Manage user's Registration/Login using WebAuthn Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorUsersWebAuthn' ) ) {

	class AuthArmorUsersWebAuthn {

		/**
		 * Start WebAuthn Registration for new user
		 * Api Version : V3
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function new_user_register_start( $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/users/webauthn/register/start';
			$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
			$params['webauthn_client_id'] = AUTHARMOR_WEBAUTHN_CLIENT_ID;
			$params['attachment_type'] = 'Any';
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Start WebAuthn Registration for existing user
		 * Api Version : V3
		 * @param    	$user_id|string 
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function existing_user_register_start( $user_id = '', $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/'.$user_id.'/users/webauthn/register/start';

			if ( !empty( $user_id ) ){
				$args = array();			
				if( !empty( $headers ) ){
					$args['headers'] = $headers;
				}
				$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
				$params['webauthn_client_id'] = AUTHARMOR_WEBAUTHN_CLIENT_ID;
				$params['attachment_type'] = 'Any';
				
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
		 * Finish WebAuthn Registration for new user
		 * Api Version : V3
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function new_user_register_finish( $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/users/webauthn/register/finish';

			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}
		

		/**
		 * Finish WebAuthn Registration for existing user
		 * Api Version : V3
		 * @param    	$user_id|string 
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function existing_user_register_finish( $user_id = '', $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/'.$user_id.'/users/webauthn/register/finish';

			if ( !empty( $user_id ) ){
				$args = array();
				if( !empty( $headers ) ){
					$args['headers'] = $headers;
				}

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

	} // End Of Class
}