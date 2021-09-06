<?php
// This page should support the following URLs:
//   auth/autharmor/invite
//   auth/autharmor/invite/confirm
//   auth/autharmor/auth
// An .htaccess file for use with Apache that enables these URL rewrites is included.
require('../AuthArmor.php');
require('../example/Model.php');
$AuthArmor = new AuthArmor();
$MyModel = new Model();
header('Content-type: application/json');
$request = file_get_contents('php://input');
$data = json_decode(utf8_encode($request));

switch($_GET['p']) {
	case '/invite':
		if($data->nickname && $data->referenceId) {
			$api_response = $AuthArmor->invite_request($data->nickname, $data->referenceId);
			// Store $api_response->auth_profile_id in your DB tied to this user
			//$MyModel->setAuthProfileIdForUsername($data->nickname, $api_response->auth_profile_id);
			http_response_code($api_response->http_status);
			echo json_encode($api_response);
		}
		break;
	case '/authenticate':
		if($data->nickname) {
			// Get the auth_profile_id tied to this username from your DB
			//$auth_profile_id = $MyModel->getAuthProfileIdForUsername($data->username);
			$api_response = $AuthArmor->auth_request_async($data->nickname, 'Auth Request', 'Requesting authorization for phpdemo.autharmor.com');
			http_response_code($api_response->http_status);
			echo json_encode($api_response);
		}
		break;
	case '/authenticate/status':
		$guid = $_GET['guid'];
		if($guid) {
			// Get auth info by guid
			$api_response = $AuthArmor->get_auth_info($guid);
			while($api_response->status_name == 'Pending') {
				$api_response = $AuthArmor->get_auth_info($guid);
				sleep(1);
			}
			if($api_response->auth_request_status_name == 'Completed') {
				if($api_response->auth_response->authorized = 'true') {
					// Auth successful, log user into your system and redirect
					header("Location: /loggedin");
					exit;
				}
			}
			$auth_info_response = new stdClass();
			$auth_info_response->response = $api_response;
			$auth_info_response->metadata = '';
			http_response_code($api_response->http_status);
			echo json_encode($auth_info_response);
		}
		break;
	case '/loggedin':
		echo "You are now logged in.";
		break;
}
