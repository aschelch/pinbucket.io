## LoginController Documentation

**Table of Contents:**

* [Introduction](#introduction)
* [Class Definition](#class-definition)
* [Properties](#properties)
* [Methods](#methods)

### Introduction 

This document provides an overview of the `LoginController` class within the `App\Http\Controllers\Auth` namespace. This controller is responsible for handling user authentication and redirecting them to the appropriate location after successful login.

### Class Definition

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // ...
}
```

This code defines the `LoginController` class, which extends the `Controller` class and utilizes the `AuthenticatesUsers` trait. The `AuthenticatesUsers` trait provides convenient methods for handling user authentication, such as the `login()` method.

### Properties

| Property | Type | Description |
|---|---|---|
| `redirectTo` | string | Specifies the URL to redirect users to after successful login. By default, this is set to `/home`. |

### Methods

#### `__construct()`

```php
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
```

This constructor method sets up the middleware for the controller. It uses the `guest` middleware to ensure that only unauthenticated users can access the login routes. The `except('logout')` clause excludes the `logout` method from this middleware, allowing authenticated users to log out. 
