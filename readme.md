# AuthArmor PHP API

## Using the AuthArmor class

Place your AuthArmor API credentials in the `autharmor_creds.php` file then instantiate an AuthArmor object:

```php
require('./AuthArmor.php');
$AuthArmor = new AuthArmor();
```

### Perform an invite

Invite a user to register their account with the AuthArmor app:

```php
$api_response = $AuthArmor->invite_request("myusername", "myreferenceid");
```

### Confirm an invite

After inviting a user you should send an auth request to verify they have configured their app correctly:

```php
$api_response = $AuthArmor->auth_request("myusername", "Confirm Setup", "Please confirm setup for MySiteName");
if($api_response->authorized == 'true') {
    // User accepted the confirmation
} else {
    // User declined the confirmation or it timed out
}
```

### Perform an authorization

```php
$api_response = $AuthArmor->auth_request("myusername", "Auth Request", "Requesting authorization for MySiteName");
if($api_response->authorized == 'true') {
    // User accepted the auth
} else {
    // User declined the auth or it timed out
}
```

You can perform more actions based on the values that are returned in the `$api_response`. For more information see the [AuthArmor API documentation](https://docs.autharmor.com/api/).

### Notes

See the `AuthArmor.php` file for a full list of required and optional parameters for the `invite_request()` and `auth_request()` functions. The generic `call()` function can also be used to call any valid endpoint on the AuthArmor API.

## Using with the AuthArmor Javascript Client-side SDK

The client-side SDK can be found here:
https://github.com/AuthArmor/autharmor-jsclient-sdk

To support the client-side SDK your application should support the following URLs:

```
/auth/autharmor/invite
/auth/autharmor/invite/confirm
/auth/autharmor/auth
```

See the `example/endpoints.php` file for an example implementation in PHP that supports these endpoints. The `example/.htaccess` file contains an example configuration for using the Apache web server's mod_rewrite directives to redirect these paths to the `endpoints.php` file.

See the `example/index.html` file for an example implementation of the client-side SDK that uses these endpoints.

