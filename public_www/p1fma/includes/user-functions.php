<?php
/**
 * This file (user-functions.php) contains all the functions
 * needed to needed to manage user sessions.
 * 
 * IMPORTANT NOTE:  the term "session object" is used to describe a key=>value pair array
 *                  containing sessions key=>value data; Same applies for a "credentials object".
 * 
 * @author:     Nicola D'Aniello
 * @version:    0.1
 */

 require_once __PUBLIC__.'/includes/db-functions.php';

/**
 * function: login_with_credentials($credentials)
 * 
 * Login an user with credentials by php sessions
 * 
 * params:
 *      $credentials:   a credentials object containing the user credentials;
 * 
 * On success:      login the user and return TRUE;
 * On error:        return FALSE if the credentials are not correct;
 * Exceptions:      see get_user_by_username();
 */
function login_with_credentials($credentials) {
    $user = get_user_by_username($credentials['username']);
    if (!$user || $credentials['password'] !== $user['password'])
        return false;

    $session = [
        'username' => $user['username'],
        'is_admin' => filter_var($user['is_admin'], FILTER_VALIDATE_BOOLEAN)
    ];
    init_user_session($session);
    return true;
}
/**
 * function: init_user_session($session)
 * 
 * Initialize the user session with session variables.
 * 
 * params:
 *      $session:   a session object containing the user session values;
 */
function init_user_session($session) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $session['username'];
    $_SESSION['is_admin'] = $session['is_admin'] || false;
}
/**
 * function: register_new_user()
 * 
 * Register a new user in the database.
 * 
 * params:
 *      $user:   an array of key => value pairs containing the user values;
 * 
 * On success:      return TRUE;
 * On error:        return FALSE;
 * Exceptions:      see create_user();
 */
function register_new_user($user) {
    return create_user($user);
}
/**
 * function: is_logged_in()
 * 
 * Return true or false based on the user authentication status.
 */
function is_logged_in() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}
/**
 * function: is_logged_in()
 * 
 * Return true for administrator user, false otherwise.
 */
function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}
?>