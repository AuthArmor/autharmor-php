<?php

/**
 * AuthArmorUsers Class
 * Manage users functions
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorUsers' ) ) {

	class AuthArmorUsers {

		/**
		 * Update User
		 * Update user data Using PUT API
		 * Api Version : V3
		 * @param    	$user_id|string
		 * @param    	$params|array	 
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public static function update_user( $user_id = '', $params = array(), $headers = array() ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/users/'.$user_id;

			if ( !empty( $user_id ) ){
				$result = $auth_armor_main->put( $api_url, $params, $headers );
			} else {
	            $result = array(
	                        'user_id' => '$user_id is missing or empty',
	                        'status_code' => 500
	                    );

	            if( AUTHARMOR_API_LOG_ENABLE == true ){
					AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'put', 'data' => $params, 'message' => $result ) );
				}
	        }

			return $result;
		}


		/**
		 * Get users
		 * Get user data Using get API
		 * Api Version : V3
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public static function get_users( $headers = array(), $query_string = '' ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/users';
			if( !empty( $query_string ) ){
				$api_url .= $query_string;
			}

			$result = $auth_armor_main->get( $api_url, $headers );

			return $result;
		}


		/**
		 * Get User By Id
		 * Get specific user data Using get API
		 * Api Version : V3
		 * @param    	$user_id|string 
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public static function get_user_by_id( $user_id = '', $headers = array() ) {

			global $auth_armor_main;		
			$api_url = AUTHARMOR_API_URL.'/v3/users/'.$user_id;

			if ( !empty( $user_id ) ){
				$result = $auth_armor_main->get( $api_url, $headers );
			} else {
	            $result = array(
	                        'user_id' => '$user_id is missing or empty',
	                        'status_code' => 500
	                    );
	            if( AUTHARMOR_API_LOG_ENABLE == true ){
	            	AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => array(), 'message' => $result ) );
	            }
	        }

			return $result;
		}
		

		/**
		 * Get Auth History for User
		 * Get auth history using get API
		 * Api Version : V3
		 * @param    	$user_id|string 
		 * @param    	$headers|array	 
		 * @return 		$result|array
		 */
		public static function get_auth_history_by_userid( $user_id = '', $headers = array(), $query_string = '' ) {

			global $auth_armor_main;
			$api_url = AUTHARMOR_API_URL.'/v3/users/'.$user_id.'/auth_history';
			if( !empty( $query_string ) ){
				$api_url .= $query_string;
			}

			if ( !empty( $user_id ) ){
				$result = $auth_armor_main->get( $api_url, $headers );
			} else {
	            $result = array(
	                        'user_id' => '$user_id is missing or empty',
	                        'status_code' => 500
	                    );
	            if( AUTHARMOR_API_LOG_ENABLE == true ){
	            	AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'get', 'data' => array(), 'message' => $result ) );
	            }
	        }
	        return $result;
		}
	
	} // End Of Class
}