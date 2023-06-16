<?php

/**
 * AuthArmorUsersAuthenticator Class
 * Manage user's Registration/Login using Authenticator Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorUsersAuthenticator' ) ) {

	class AuthArmorUsersAuthenticator {

		/**
		 * Start User Registration for Authenticator
		 * Api Version : V3
		 * @param    	$params|array
		 * @return 		$result|array
		 */
		public static function new_user_register_start( $params = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/users/authenticator/register/start';
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Start Authenticator Registration for existing user
		 * Api Version : V3
		 * @param    	$user_id|string
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public static function existing_user_register_start( $user_id = '', $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/users/'.$user_id.'/authenticator/register/start';

			if ( !empty( $user_id ) ){
				$args = array();
				
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