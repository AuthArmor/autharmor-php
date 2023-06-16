<?php

/**
 * AuthMagicLinkEmail Class
 * Manage all auth functions using MagicLink Email Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthMagicLinkEmail' ) ) {

	class AuthMagicLinkEmail {

		/**
		 * Start auth request using Magiclink Email
		 * Api Version : V3
		 * @param    	$params|array
		 * @return 		$result|array
		 */
		public static function auth_request_start( $params = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/magiclink_email/start';
			$params['auth_redirect_url'] = AUTHARMOR_REDIRECT_URL;
			$params['timeout_in_seconds'] = AUTHARMOR_API_TIMEOUT;
			
			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}


		/**
		 * Validate auth request for Magiclink Email
		 * Api Version : V3
		 * @param    	$params|array 
		 * @return 		$result|array
		 */
		public static function validate_magiclink_auth_token( $params = array() ) {

			global $auth_armor_main;
			$args = array();
			$api_url = AUTHARMOR_API_URL.'/v3/auth/magiclink_email/validate';

			$args['params'] = $params;
			$result = $auth_armor_main->post( $api_url, $args );

			return $result;
		}

	} // End Of Class
}