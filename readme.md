# AuthArmor PHP API

## Using the AuthArmor class

Place your AuthArmor API credentials in autharmor_creds.php then include and instantiate an AuthArmor object.

```php
require('./AuthArmor.php');
$AuthArmor = new AuthArmor();
```

### Perform an invite to register the user's device

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

Your application should maintain a database that ties your user's username to their AuthArmor auth_profile_id. See the `example/Model.php` file for an example implementation.

## Using with the AuthArmor Javascript Client-side SDK

The client-side SDK can be found here:
https://github.com/AuthArmor/autharmor-jsclient-sdk

To support the client-side SDK your application should support the following URLs:

```
/auth/autharmor/invite
/auth/autharmor/invite/confirm
/auth/autharmor/auth
```

See the `index.php` file for an example implementation in PHP that supports these endpoints. See the `example/` folder for an example implementation of the client-side SDK that uses these endpoints.

