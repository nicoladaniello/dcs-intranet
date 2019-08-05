<?php
/**
 * This file (settings.php) contains the general settings for the script.
 * 
 * @author Nicola D'Aniello
 * @version 0.1
 */

/**
 * 
 * 
 * GLOBALS
 * 
 * 
*/
define('__ROOT__', __DIR__, true);                          // root directory
define('__PUBLIC__', __ROOT__.'/public_www/p1fma', true);   // public directory
define('__PRIVATE__', __ROOT__.'/private', true);           // private directory
/**
 * 
 * 
 * Change the following lines to change from localhost to server
 * 
 * 
 */
// $HOST = 'http://localhost:8888';                                                                // host name on LOCALHOST
$HOST = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];         // host name on SERVER

// $HOME = '/ndanie03-p1fma/public_www/p1fma/';                // hone path on LOCALHOST
$HOME = '/~ndanie03/p1fma/';                                // home path on SERVER
/**
 * 
 * 
 * 
 */
define('__HOST__', $HOST);                                  // host name
define('__HOME__', $HOME);                                  // home path
define('__BASEURL__', __HOST__.__HOME__, true);             // base url
/**
 * 
 * 
 * DATABASE GLOBALS
 * 
 * 
*/
define("DB_FILE", __PRIVATE__.'/users-db.txt', true);       // database file
define("DB_USER_DELIMETER", PHP_EOL, true);                 // string that delimits tables in db.
define("DB_LINE_DELIMETER", ',', true);                     // string that delimits fields in db
define("DB_LINE_DELIMETER_REPLACE", '##COMMA', true);       // replace delimeter values with this value before inserting in db;

$USER_KEYS_ARRAY = ['title', 'first_name', 'surname', 'email', 'username', 'password', 'is_admin'];

define("USER_KEYS", $USER_KEYS_ARRAY, true);                // array of fields keys for each user

?>