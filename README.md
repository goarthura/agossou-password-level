# Password Level

## Description
Checks password level security, generate secure password.
### Feats:
(1)- Password security level checking 

Returns a value between 0 and 6. The minimum level is 1 if the password contains 8 characters. The level increases according to the combinations of upper case characters, lower case characters, numbers and symbols in addition to the length of the string. Level 6 is extremely secure.

(2)- Secure password generation

## Compatibility

This library requires **PHP v4.3** or higher.

## Installation

Use the below code to install the wrapper:

`composer require agosssou/password-level`

If you are not using [Composer](https://getcomposer.org/), clone or download [this repository](https://github.com/goarthura/password-level) that already contains the `vendor/autoload.php` file. If you encounter an issue, please post it here and not on the mirror repository.

## Using Password Level in your project

```php
<?php
use Agossou\PasswordLevel\PasswordLevel;

// check the security level of a password
$level = PasswordLevel::checkLevel($password);

or 

$level = \Agossou\PasswordLevel\PasswordLevel::checkLevel($password);

// generate secure password
$secure_password = SecurePassword::generate();

or 

$secure_password = \Agossou\PasswordLevel\SecurePassword::generate();
```