<?php
// This page should support the following URLs:
//   auth/autharmor/invite
//   auth/autharmor/invite/confirm
//   auth/autharmor/auth
// An .htaccess file for use with Apache that enables these URL rewrites is included.
require('./AuthArmor.php');
require('./example/Model.php');
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
			$MyModel->setAuthProfileIdForUsername($data->nickname, $api_response->auth_profile_id);
			echo json_encode($api_response);
		}
		break;
	case '/invite/confirm':
		if($data->auth_profile_id) {
			$response = new stdClass();
			$api_response = $AuthArmor->auth_request($data->auth_profile_id, 'Confirm Setup', 'Please confirm setup has worked');
			if($api_response->authorized == 'true') {
				$response->invite_status = 'Confirmed';
			} else {
				$response->invite_status = 'Declined';
			}
			echo json_encode($response);
		}
		break;
	case '/auth':
		if($data->username) {
			// Get the auth_profile_id tied to this username from your DB
			$auth_profile_id = $MyModel->getAuthProfileIdForUsername($data->username);
			$response = $AuthArmor->auth_request($auth_profile_id, 'Auth Request', 'Requesting authorization for mysite.com');
			echo json_encode($response);
		}
		break;
}
