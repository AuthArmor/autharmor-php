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
		require(__DIR__ . '/autharmor_creds.php');
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
	 * @return stdClass Return the JSON result from the AuthArmor API
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
		$result->http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return $result;
	}
	
	/**
	 * Generic function for making GET calls to the AuthArmor API
	 * @param string $path AuthArmor API path
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function call_get(string $path) : stdClass {
		if(new DateTime() > $this->token_expire) {
			$this->refresh_token();
		}
		$path = 'https://api.autharmor.com'.$path;
		$headers = array(
			'accept: text/plain',
			'Authorization: Bearer '.$this->token->access_token
		);
		
		$ch = curl_init($path);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		$result = json_decode(curl_exec($ch));
		$result->http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return $result;
	}
	
	/**
	 * Invite user
	 * @param string $nickname The user's nickname/username
	 * @param string|null $reference_id Optional. A reference ID for the user
	 * @param bool $reset_and_reinvite Optional. Reset and re-invite the user
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function invite_request(string $nickname, string $reference_id = null, bool $reset_and_reinvite = false) : stdClass {
		$post = new stdClass();
		$post->nickname = $nickname;
		if($reference_id) {
			$post->reference_id = $reference_id;
		}
		$post->reset_and_reinvite = $reset_and_reinvite;
		
		return $this->call('/v2/invite/request', $post);
	}
	
	/**
	 * Perform and authorization
	 * @param string $nickname The user's nickname/username. Any unique identifier
	 * @param string $action_name The action you are sending an auth request for. Min length 2, max length 25
	 * @param string $short_msg A short message that will appear in the AuthArmor app
	 * @param int|null $timeout_in_seconds Optional. Override the timeout for approval
	 * @param array|null $origin_location_data Optional. Set the location to be displayed in the AuthArmor app
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function auth_request(string $nickname, string $action_name, string $short_msg, int $timeout_in_seconds = null, array $origin_location_data = null) : stdClass {
		$post = new stdClass();
		$post->nickname = $nickname;
		$post->action_name = $action_name;
		$post->short_msg = $short_msg;
		if($timeout_in_seconds) {
			$post->timeout_in_seconds = $timeout_in_seconds;
		}
		if($origin_location_data) {
			$post->origin_location_data->latitude = $origin_location_data['latitude'];
			$post->origin_location_data->longitude = $origin_location_data['longitude'];
			$post->origin_location_data->ip_address = $origin_location_data['ip_address'];
		}
		
		return $this->call('/v2/auth/request', $post);
	}

	/**
	 * Perform and authorization asynchronously
	 * @param string $nickname The user's nickname/username. Any unique identifier
	 * @param string $action_name The action you are sending an auth request for. Min length 2, max length 25
	 * @param string $short_msg A short message that will appear in the AuthArmor app
	 * @param int|null $timeout_in_seconds Optional. Override the timeout for approval
	 * @param array|null $origin_location_data Optional. Set the location to be displayed in the AuthArmor app
	 * @param bool|null $send_push. Whether or not to send a push message
	 * @param bool|null $use_visual_verify. Include visual verify code
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function auth_request_async(string $nickname, string $action_name, string $short_msg, int $timeout_in_seconds = null, array $origin_location_data = null, bool $send_push = true, bool $use_visual_verify = null) : stdClass {
		$post = new stdClass();
		$post->nickname = $nickname;
		$post->action_name = $action_name;
		$post->short_msg = $short_msg;
		if($timeout_in_seconds) {
			$post->timeout_in_seconds = $timeout_in_seconds;
		}
		if($origin_location_data) {
			$post->origin_location_data->latitude = $origin_location_data['latitude'];
			$post->origin_location_data->longitude = $origin_location_data['longitude'];
			$post->origin_location_data->ip_address = $origin_location_data['ip_address'];
		} else {
			$post->origin_location_data->ip_address = $_SERVER['REMOTE_ADDR'];
		}
		if($send_push) {
			$post->send_push = $send_push;
		}
		if($use_visual_verify) {
			$post->use_visual_verify = $use_visual_verify;
		}
		
		return $this->call('/v2/auth/request/async', $post);
	}

	/**
	 * Get authorization information
	 * @param string $auth_request_id The auth_request_id to get info for
	 * @return stdClass Return the JSON result from the AuthArmor API
	 */
	public function get_auth_info(string $auth_request_id) {
		return $this->call_get('/v2/auth/request/'.$auth_request_id);
	}
}
