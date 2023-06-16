<?php

/**
 * AuthArmorAuthentication Class
 * Manage all authentication functions
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorAuthentication' ) ) {

	class AuthArmorAuthentication {

		public $token;
		public $token_expire;

		public function __construct() {
			$this->refresh_token();
		}
		

		/**
		 * Authorization token
		 * Set Authorization token
		 * Api Version : V3
		 */
		public function refresh_token() {

			$api_url = 'https://login.autharmor.com/connect/token';

			$ch = curl_init($api_url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, array('grant_type' => 'client_credentials'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, AUTHARMOR_CLIENT_ID.':'.AUTHARMOR_CLIENT_SECRET);
			$result = curl_exec ($ch);
	        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$response = (array)json_decode($result);
		    $response['status_code'] = $status_code;
			curl_close($ch);

	 		if( isset( $response['error'] ) ){
				if( AUTHARMOR_API_LOG_ENABLE == true ){
					AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => array(), 'message' => $response['error'] ) );
				}
			} else {
		 		if ( !empty ( $response['access_token'] ) ){
					$this->token = $response['access_token'];
			 		if( !empty( $response['expires_in'] ) ){
						$this->token_expire = date( "Y-m-d H:i:s", ( strtotime( date( "Y-m-d H:i:s" ) ) + $response['expires_in'] ) );
			 		}
					else {
						$this->token_expire = date( "Y-m-d H:i:s", ( strtotime( date( "Y-m-d H:i:s" ) ) + 600 ) );
					}
				} else {
					if( AUTHARMOR_API_LOG_ENABLE == true ){
						AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => array(), 'message' => 'Token not generated.' ) );
					}
				}
			}
		}
		
	} // End Of Class
}