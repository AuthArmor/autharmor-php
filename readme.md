# AuthArmor PHP API

## Using the AuthArmor class

Place your AuthArmor API credentials in the `autharmor_creds.php` file then instantiate an AuthArmor object:

```php
require('./AuthArmor.php');
$AuthArmor = new AuthArmor();
```

### Perform an invite

```php
$api_response = $AuthArmor->invite_request("myusername", "myreferenceid");
```

### Confirm an invite

```php
$api_response = $AuthArmor->auth_request("my_auth_profile_id", "Confirm Setup", "Please confirm setup has worked");
if($api_response->authorized == 'true') {
    $response = 'Confirmed';
} else {
    $response = 'Declined';
}
```

### Perform an authorization

```php
$response = $AuthArmor->auth_request("my_auth_profile_id", "Auth Request", "Requesting authorization for mysite.com");
```

### Notes

See the `AuthArmor.php` file for a full list of required and optional parameters for the `invite_request()` and `auth_request()` functions. The generic `call()` function can also be used to call any valid endpoint on the AuthArmor API.

Your application should maintain a database that ties your user's username to their AuthArmor `auth_profile_id`. See the `example/Model.php` file for an example implementation.

## Using with the AuthArmor Javascript Client-side SDK

The client-side SDK can be found here:
https://github.com/AuthArmor/autharmor-jsclient-sdk

To support the client-side SDK your application should support the following URLs:

```
/auth/autharmor/invite
/auth/autharmor/invite/confirm
/auth/autharmor/auth
```

See the `example/endpoints.php` file for an example implementation in PHP that supports these endpoints. The `example/.htaccess` file contains an example configuration for using the Apache web server's mod_rewrite directives to redirect these paths to the `index.php` file.

See the `example/index.html` file for an example implementation of the client-side SDK that uses these endpoints.

