<?php

/**
 * AuthInfo Class
 * Get Auth Info using Auth Method
 * Api Version : V3
 */

if( !class_exists( 'AuthInfo' ) ) {

	class AuthInfo {

		/**
		 * Get Auth Info
		 * Get specific user data Using get API
		 * Api Version : V3
		 * @param    	$auth_request_id|string
		 * @return 		$result|array
		 */
		public function get_auth_info( $auth_request_id = '' ) {

			global $auth_armor_main;		
			$api_url = AUTHARMOR_API_URL.'/v3/auth/'.$auth_request_id;

			if ( !empty( $auth_request_id ) ){
				$result = $auth_armor_main->get( $api_url );
			} else {
	            $result = array(
	                        'auth_request_id' => '$auth_request_id is missing or empty',
	                        'status_code' => 500
	                    );
	            if( AUTHARMOR_API_LOG_ENABLE == true ){
	            	AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => array(), 'message' => $result ) );
	            }
	        }

			return $result;
		}

	} // End Of Class
}
