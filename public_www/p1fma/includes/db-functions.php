<?php
/**
 * This file (db-functions.php) contains all the functions related
 * to database management.
 * 
 * 
 * IMPORTANT NOTE:  the term "user object" refers to a "key => value" pairs array
 *                  containing the user key and respective values;
 * 
 * @author Nicola D'Aniello
 * @version 0.1
 */

/*
 * get_users();
 * 
 * Return ar array with each user contained in the database;
 * 
 * On success:     return array of user objects;
 * On error:       return FALSE if not user was found;
 * Exceptions:     in case of user file not found, or corrupted user object;
*/
function get_users() {
    $users = array();

    if (!file_exists(DB_FILE))
        throw new Exception('error: database file is missing.');

    $db_content = file_get_contents(DB_FILE);
    $db_lines = explode(DB_USER_DELIMETER, $db_content);

    for ($i = 0; $i < sizeof($db_lines); $i++) {
        $users[] = deserialize_user($db_lines[$i], $i);
    }
    return $users;
}
/*
 * get_user_by_username($username);
 * 
 * Return the user with the corresponding username;
 * 
 * params:
 *     $username:  the username string
 * 
 * On success:     return a user object;
 * On error:       return FALSE if no user is found;
 * Exceptions:      see get_user_by_username()
*/
function get_user_by_username($username) {
    $users = get_users();

    foreach ($users as $user) {
        if ($user['username'] === $username)
            return $user;
    }
    return false;
}
/*
 * create_user($user);
 * 
 * Insert a new user in the database. A unique username is required.
 * 
 * params:
 *     $user:  the user object
 * 
 * On success:     return TRUE;
 * On error:       return FALSE;
 * Exceptions:      see get_user_by_username();
*/
function create_user($user) {
    $username_taken = get_user_by_username($user['username']);
    if ($username_taken !== false)
        throw new Exception('Username not available. Please try a different username.');
    
    $user['is_admin'] = 0;

    $insert = file_put_contents(DB_FILE, serialize_user($user), FILE_APPEND);
    return !!$insert;
}
/*
 * serialize_user($user);
 * 
 * Format an user object into a string valid for database purposes;
 * 
 * params:
 *     $user:  the user object to serialize
 * 
 * On success:     return the serialized STRING;
*/
function serialize_user($user) {
    $values = array();
    foreach($user as $key => $value) {
        $remove_lines = str_replace(DB_USER_DELIMETER, '', $value);
        $replace_delimeter = str_replace(DB_LINE_DELIMETER, DB_LINE_DELIMETER_REPLACE, $remove_lines);
        $values[] = $replace_delimeter;
    }
    return DB_USER_DELIMETER.join(DB_LINE_DELIMETER, $values);
}
/*
 * deserialize_user($user);
 * 
 * Translate a given string into an user object;
 * 
 * params:
 *      $str:   the string to deserialize
 *      $line:  the line number in the db for the given string (for debug purpouses)
 * 
 * On success:      return the user object;
 * Exceptions:      Throws exception if a corrupted string is given;
*/
function deserialize_user($str, $line) {
    $values = explode(DB_LINE_DELIMETER, $str);
    if (sizeof($values) !== sizeof(USER_KEYS))
        throw new Exception('error: line '.$line.' in db is not formatted correctly. Make sure there are not empty lines.');

    $user = array_combine(USER_KEYS, $values);
    foreach($user as $key => $value) {
        $user[$key] = str_replace(DB_LINE_DELIMETER_REPLACE, DB_LINE_DELIMETER, $value);
    }

    return $user;
}

?>