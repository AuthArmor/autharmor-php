<?php

/**
 * AuthArmorMain Class
 * Manage all api call functions
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorMain' ) ) {

	class AuthArmorMain {

		/**
		 * GET API Function
		 * Api Version : V3
		 * @param    	$api_url|string
		 * @param    	$api_headers|array
		 * @return 		$result|array
		 */
		public function get( $api_url = '', $api_headers = array() ) {

			global $auth_armor_authentication;

			if( isset( $auth_armor_authentication->token ) && $auth_armor_authentication->token != '' ) {
				if( $api_url != '' ) {
					if( date( "Y-m-d H:i:s" ) > $auth_armor_authentication->token_expire ) {
						$auth_armor_authentication->refresh_token();
					}
					$headers = array(
						'accept: application/json',
						'Content-Type: application/json',
						'Authorization: Bearer '.$auth_armor_authentication->token
					);

					if ( !empty( $api_headers ) ){
						$headers = array_merge( $headers, $api_headers );
					}
					
					$ch = curl_init($api_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					$response = curl_exec ($ch);
			        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					$result = (array)json_decode($response);
			        $result['status_code'] = $status_code;
					curl_close($ch);

					if( $status_code != 200 ) {
						if( AUTHARMOR_API_LOG_ENABLE == true ){
							AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'get', 'data' => array(), 'message' => $result ) );
						}
					}
				} else {
		            $result = array(
		                        'api_url' => '$api_url is missing or empty',
		                        'status_code' => 500
		                    );
		            if( AUTHARMOR_API_LOG_ENABLE == true ){
		            	AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'get', 'data' => array(), 'message' => $result ) );
		            }
		        }
		    } else {
		    	$result = array(
		                        'token' => 'Authorization Token is missing',
		                        'status_code' => 500
		                    );
		    	if( AUTHARMOR_API_LOG_ENABLE == true ){
		    		AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'get', 'data' => array(), 'message' => $result ) );
		    	}
		    }

			return $result;
		}

		
		/**
		 * POST API Function
		 * Api Version : V3
		 * @param    	$api_url|string
		 * @param    	$args|array
		 * @return 		$result|array
		 */
		public function post( $api_url = '', $args = array() ) {

			global $auth_armor_authentication;

			if( isset( $auth_armor_authentication->token ) && $auth_armor_authentication->token != '' ) {
				if( $api_url != '' ) {
					if( date( "Y-m-d H:i:s" ) > $auth_armor_authentication->token_expire ) {
						$auth_armor_authentication->refresh_token();
					}

			        $params_json = json_encode( $args['params'] );

					$headers = array(
						'accept: application/json',
						'Content-Type: application/json',
						'Content-Length: '.strlen($params_json),
						'Authorization: Bearer '.$auth_armor_authentication->token
					);

					if ( !empty( $args['headers'] ) ){
						$headers = array_merge( $headers, $args['headers'] );
					}
					
					$ch = curl_init($api_url);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					$response = curl_exec ($ch);
			        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					$result = (array)json_decode($response);
			        $result['status_code'] = $status_code;
					curl_close($ch);

					if( $status_code != 200 ) {
						if( AUTHARMOR_API_LOG_ENABLE == true ){
							AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => $args['params'], 'message' => $result ) );
						}
					}

				} else {
		            $result = array(
		                        'api_url' => '$api_url is missing or empty',
		                        'status_code' => 500
		                    );
		            if( AUTHARMOR_API_LOG_ENABLE == true ){
						AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'post', 'data' => $args['params'], 'message' => $result ) );
					}
		        }
		    } else {
		    	$result = array(
		                        'token' => 'Authorization Token is missing',
		                        'status_code' => 500
		                    );
		    	if( AUTHARMOR_API_LOG_ENABLE == true ){
		    		AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'get', 'data' => array(), 'message' => $result ) );
		    	}
		    }

			return $result;
		}


		/**
		 * PUT API Function
		 * Api Version : V3
		 * @param    	$api_url|string
		 * @param    	$params|array
		 * @param    	$headers|array
		 * @return 		$result|array
		 */
		public function put( $api_url = '', $params = array(), $headers = array() ) {

			global $auth_armor_authentication;

			if( isset( $auth_armor_authentication->token ) && $auth_armor_authentication->token != '' ) {
				if( $api_url != '' && !empty( $params ) ) {

					if( date( "Y-m-d H:i:s" ) > $auth_armor_authentication->token_expire ) {
						$auth_armor_authentication->refresh_token();
					}

		            $params_json = json_encode( $params );
		            $all_headers = array(                                                                         
		                            'accept: application/json',
									'Content-Type: application/json',
									'Content-Length: '.strlen($params_json),
									'Authorization: Bearer '.$auth_armor_authentication->token
		                        );

		            if ( !empty( $headers ) ){
						$all_headers = array_merge( $all_headers, $headers );
					}
					$headers = $all_headers;

		            $ch = curl_init();
		            curl_setopt($ch, CURLOPT_URL, $api_url);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		            curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);           
		            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		            $response = curl_exec ($ch);
		            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		            $result = (array)json_decode($response);
			        $result['status_code'] = $status_code;
					curl_close($ch);

			        if( $status_code != 200 ){
			        	if( AUTHARMOR_API_LOG_ENABLE == true ){
							AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'put', 'data' => $params, 'message' => $result ) );
						}
					}

		        } else {

		            $result = array(
		                        'api_url' => '$api_url is missing or empty',
		                        'params' => '$params is missing or empty',
		                        'status_code' => 500
		                    );
		            if( AUTHARMOR_API_LOG_ENABLE == true ){
						AuthArmorLogs::generate_log( array( 'api_url' => $api_url, 'method' => 'put', 'data' => $params, 'message' => $result ) );
					}
		        }
		    } else {
		    	$result = array(
		                        'token' => 'Authorization Token is missing',
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