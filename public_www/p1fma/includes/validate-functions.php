<?php
/**
 * This file (validate-functions.php) contains all the form and inputs validation functions.
 * 
 * IMPORTANT NOTE:  the term "credentials object" and "user object" refers to "key => value" pairs array
 *                  containing the user or credentials key and respective values;
 * 
 * @author Nicola D'Aniello
 * @version 0.1
 */

/* function name:   validate_login_credentials();
* 
* Return the login credentials sent by POST method, after being validated.
*
* On success:       return a credentials object with valid inputs;
* Exceptions:         return exception(error_message);
*/
function validate_login_credentials() {
    $inputs = ['username', 'password'];

    $credentials = clean_post_inputs($inputs);
    validate_username($credentials['username']);
    validate_password($credentials['password']);
    
    return $credentials;
}
/* function name:   validate_user_values();
* 
* Return the user details (needed to create a new user) sent by POST method, after being validated.
*
* On success:       return an user object with valid inputs;
* Exceptions:         return exception(error_message);
*/
function validate_user_values() {
    $inputs = ['title', 'first_name', 'surname', 'email', 'username', 'password'];
    $user_values = clean_post_inputs($inputs);
  
    validate_title($user_values['title']);
    validate_first_name($user_values['first_name']);
    validate_surname($user_values['surname']);
    validate_email($user_values['email']);
    validate_username($user_values['username']);
    validate_password($user_values['password']);
  
    return $user_values;
}
/* function name:   clean_post_inputs($keys);
* 
* Apply 
*
* On success:       return an user object with valid inputs;
* Exceptions:         return exception(error_message);
*/
function clean_post_inputs($keys) {
    $result = array();
    foreach($keys as $key) {
        $result[$key] = '';
        $result[$key] = $_POST[$key];
        $result[$key] = test_input($result[$key]);
    }
    return $result;
}

function test_input($data) {
    $data = trim($data);
    return $data;
}

function validate_title($value) {
    if ($value === '')
        throw new Exception('Title is required and cannot be empty.');

    $accepted = ['mr', 'ms', 'miss'];
    if (!in_array($value, $accepted))
        throw new Exception('Please select a valid title.');
}

function validate_first_name($value) {
    if ($value === '') {
        throw new Exception('First name is required and cannot be empty.');
    }
    if (strlen($value) < 2) {
        throw new Exception('First name must be more then 1 character.');
    }
    if (strlen($value) > 21) {
        throw new Exception('First name must be less then 20 characters.');
    }
    if (strpos($value, ' ') !== false) {
        throw new Exception('First name cannot contain spaces.');
    }
}

function validate_surname($value) {
    if ($value === '') {
        throw new Exception('Surname is required and cannot be empty.');
    }
    if (strlen($value) < 2) {
        throw new Exception('Surname must be more then 1 character.');
    }
    if (strlen($value) > 21) {
        throw new Exception('Surname must be less then 20 characters.');
    }
    if (strpos($value, ' ') !== false) {
        throw new Exception('Surname cannot contain spaces.');
    }
}

function validate_email($value) {
    if ($value === '') {
        throw new Exception('Email is required and cannot be empty.');
    }
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('The email given is not valid.');
    }
}

function validate_username($value) {
    if ($value === '') {
        throw new Exception('Username is required and cannot be empty.');
    }
    if (strlen($value) < 2) {
        throw new Exception('Username must be more then 1 character.');
    }
    if (strlen($value) > 21) {
        throw new Exception('Username must be less then 20 characters.');
    }
    // if (strpos($value, ' ') !== false) {
    //     throw new Exception('Username cannot contain spaces.');
    // }
}

function validate_password($value) {
    if ($value === '') {
        throw new Exception('Password is required and cannot be empty.');
    }
    if (strlen($value) < 2) {
        throw new Exception('Password must be more then 1 character.');
    }
    if (strlen($value) > 21) {
        throw new Exception('Password must be less then 20 characters.');
    }
}
?>