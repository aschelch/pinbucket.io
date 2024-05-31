# LoginController

## Table of Contents

* [Overview](#overview)
* [Methods](#methods)

## Overview

The `LoginController` handles user authentication for the application and redirects them to the home screen. It leverages the `AuthenticatesUsers` trait to provide its core functionality.

## Methods

### `__construct()`

This method initializes the `LoginController`. It ensures that only guest users can access the login process, except for the logout action. 

| Attribute | Description |
|---|---|
| `middleware` | The middleware that will be applied to the controller's methods. |
| `guest` | A middleware that ensures only unauthenticated users can access the route. |
| `except` | An array of methods that will be excluded from the middleware. In this case, it's the `logout` method. |

**Code:**

```php
public function __construct()
{
    $this->middleware('guest')->except('logout');
}
```

### `redirectTo`

This property defines the route that users will be redirected to after successful login.

| Attribute | Description |
|---|---|
| `redirectTo` | The route to redirect to after successful login. |

**Code:**

```php
protected $redirectTo = '/home';
```
