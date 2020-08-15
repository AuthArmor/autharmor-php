<?php
// This page should support the following URLs:
//   auth/autharmor/invite
//   auth/autharmor/invite/confirm
//   auth/autharmor/auth
// An .htaccess file for use with Apache that enables these URL rewrites is included.
require('../AuthArmor.php');
$AuthArmor = new AuthArmor();
header('Content-type: application/json');
$request = file_get_contents('php://input');
$data = json_decode(utf8_encode($request));

switch($_GET['p']) {
	case '/invite':
		if($data->nickname && $data->referenceId) {
			$api_response = $AuthArmor->invite_request($data->nickname, $data->referenceId);
			http_response_code($api_response->http_status);
			echo json_encode($api_response);
		}
		break;
	case '/invite/confirm':
		if($data->nickname) {
			$api_response = $AuthArmor->auth_request($data->nickname, 'Confirm Setup', 'Please confirm setup MySiteName');
			http_response_code($api_response->http_status);
			echo json_encode($api_response);
		}
		break;
	case '/auth':
		if($data->username) {
			$api_response = $AuthArmor->auth_request($data->username, 'Auth Request', 'Requesting authorization for MySiteName');
			http_response_code($api_response->http_status);
			echo json_encode($api_response);
		}
		break;
}

