<?php

/**
 * AuthAuthenticator Class
 * Manage all auth functions using Authenticator Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthAuthenticator' ) ) {

	class AuthAuthenticator {

		/**
		 * Start auth request using Authenticator
		 * Api Version : V3
		 * @param    	$params|array
		 * @return 		$result|array
		 */
		public function auth_request_start( $params = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/authenticator/start';
			$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Validate auth request for Auth Armor Authenticator
		 * Api Version : V3
		 * @param    	$params|array 
		 * @return 		$result|array
		 */
		public function validate_authenticator_auth_token( $params = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/authenticator/validate';

			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}

	} // End Of Class
}