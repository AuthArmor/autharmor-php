<?php

/**
 * AuthArmorLogs Class
 * Manage all API logs
 * Api Version : V3
 */

if( !class_exists( 'AuthArmorLogs' ) ) {

	class AuthArmorLogs {

		/**
		 * Generate Logs
		 * Api Version : V3
		 * @param 		$message|string
		 */
		public static function generate_log( $message ) {
			if( is_array( $message ) ) { 
	            $message = json_encode( $message ); 
	        } 

	        $file = fopen( AUTHARMOR_API_LOG_FILE_PATH, 'a' ); 
	        fwrite( $file, "\n" . date('Y-m-d h:i:s') . " :: " . $message ); 
	        fclose( $file );
		}

	} // End Of Class
}