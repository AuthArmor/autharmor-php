<?php

/**
 * AuthWebAuthn Class
 * Manage all auth functions using Webauthn Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthWebAuthn' ) ) {

	class AuthWebAuthn {

		/**
		 * Start auth request using Webauthn
		 * Api Version : V3
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function auth_request_start( $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/webauthn/start';
			$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
			$params['webauthn_client_id'] = AUTHARMOR_WEBAUTHN_CLIENT_ID;
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Finish auth request using WebAuthn
		 * Api Version : V3
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function auth_request_finish( $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/webauthn/finish';
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Validate auth request for WebAuthn
		 * Api Version : V3
		 * @param    	$params|array	
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public function validate_webauthn_auth_token( $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/webauthn/validate';

			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}

	} // End Of Class
}