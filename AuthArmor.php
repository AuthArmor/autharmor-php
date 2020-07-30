<?php
// Place your credentials in autharmor_creds.php. File should contain the following 3 lines:
// <?php
// $this->client_id = "YourClientID";
// $this->client_secret = "YourClientSecret";

class AuthArmor {
	private $client_id;
	private $client_secret;
	private $token;
	private $token_expire;
	
	public function __construct() {
		require('./autharmor_creds.php');
		$this->refresh_token();
	}
	
	private function refresh_token() : void {
		$ch = curl_init('https://login.autharmor.com/connect/token');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('grant_type' => 'client_credentials'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, $this->client_id.':'.$this->client_secret);
		
		$this->token = json_decode(curl_exec($ch));
		$this->token_expire = new DateTime('+'.($this->token->expires_in - 100).' seconds');
		
		curl_close($ch);
	}
	
	/**
	 * Generic function for making any call to the AuthArmor API
	 * @param string $path AuthArmor API path
	 * @param stdClass $post JSON Request payload
	 * @return stdClass JSON result
	 */
	public function call(string $path, stdClass $post) : stdClass {
		if(new DateTime() > $this->token_expire) {
			$this->refresh_token();
		}
		$post = json_encode($post);
		$path = 'https://api.autharmor.com'.$path;
		$headers = array(
			'accept: text/plain',
			'Content-Type: application/json',
			'Content-Length: '.strlen($post),
			'Authorization: Bearer '.$this->token->access_token
		);
		
		$ch = curl_init($path);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = json_decode(curl_exec($ch));
		curl_close($ch);
		return $result;
	}
	
	/**
	 * Invite user
	 * @param string $nickname The user's nickname/username
	 * @param string|null $reference_id Optional. A reference ID for the user
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function invite_request(string $nickname, string $reference_id = null) : stdClass {
		$post = new stdClass();
		$post->nickname = $nickname;
		if($reference_id) {
			$post->reference_id = $reference_id;
		}
		
		return $this->call('/v1/invite/request', $post);
	}
	
	/**
	 * Perform and authorization
	 * @param string $auth_profile_id The user's auth_profile_id. Store and fetch this from your local database
	 * @param string $action_name The action you are sending an auth request for. Min length 2, amx length 25
	 * @param string $short_msg A short message that will appear in the AuthArmor app
	 * @param int|null $timeout_in_seconds Optional. Override the timeout for approval
	 * @param array|null $accepted_auth_methods Optional. Accepted auth methods include biometric, security key, or PIN
	 * @param array|null $client_location_data Optional. Set the location to be displayed in the AuthArmor app
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function auth_request(string $auth_profile_id, string $action_name, string $short_msg, int $timeout_in_seconds = null, array $accepted_auth_methods = null, array $client_location_data = null) : stdClass {
		$post = new stdClass();
		$post->auth_profile_id = $auth_profile_id;
		$post->action_name = $action_name;
		$post->short_msg = $short_msg;
		if($timeout_in_seconds) {
			$post->timeout_in_seconds = $timeout_in_seconds;
		}
		if($accepted_auth_methods) {
			$accepted_auth_methods_count = 0;
			foreach($accepted_auth_methods as $accepted_auth_method) {
				$post->accepted_auth_methods[$accepted_auth_methods_count]->name = $accepted_auth_method['name'];
				$rules_count = 0;
				foreach($accepted_auth_methods[$accepted_auth_methods_count]['rules'] as $name => $value) {
					$post->accepted_auth_methods[$accepted_auth_methods_count]->rules[$rules_count]->name = $name;
					$post->accepted_auth_methods[$accepted_auth_methods_count]->rules[$rules_count]->value = $value;
					$rules_count++;
				}
				$accepted_auth_methods_count++;
			}
		}
		if($client_location_data) {
			$post->client_location_data->latitude = $client_location_data['latitude'];
			$post->client_location_data->longitude = $client_location_data['longitude'];
		}
		
		return $this->call('/v1/auth/request', $post);
	}
}
