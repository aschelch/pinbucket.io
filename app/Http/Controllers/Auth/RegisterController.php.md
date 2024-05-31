## RegisterController.php Documentation

**Table of Contents**

- [Overview](#overview)
- [Class Properties](#class-properties)
- [Class Methods](#class-methods)

### Overview 

This controller handles the registration of new users. It utilizes the `RegistersUsers` trait to provide the core functionality, including validation and user creation.

### Class Properties

| Property | Type | Description |
|---|---|---|
| `$redirectTo` | string | The URL to redirect users to after successful registration.  Defaults to `/home`. |

### Class Methods

#### `__construct()`

This method initializes the controller by setting up a middleware that ensures only unauthenticated users can access the registration process.

```php
public function __construct()
{
    $this->middleware('guest');
}
```

#### `validator(array $data)`

This method validates the incoming registration request data. It uses the Laravel Validator class to enforce the following rules:

| Field | Rules | Description |
|---|---|---|
| `name` | `required|string|max:255` | The user's name is required, must be a string, and cannot exceed 255 characters. |
| `email` | `required|string|email|max:255|unique:users` | The user's email is required, must be a string, must be a valid email address, cannot exceed 255 characters, and must be unique among registered users. |
| `password` | `required|string|min:6|confirmed` | The user's password is required, must be a string, must be at least 6 characters long, and must match the confirmation field. |

```php
protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);
}
```

#### `create(array $data)`

This method creates a new user instance after successful validation of the registration request.  It utilizes the `User` model to store the user data and generates a random API token for the new user.

```php
protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'api_token' => Str::random(60),
    ]);
}
``` 
