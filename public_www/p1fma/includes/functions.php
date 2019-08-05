<?php
/**
 * This file (functions.php) includes all the functions available,
 * and contains extra common functionalities.
 * 
 * @author Nicola D'Aniello
 * @version 0.1
 */

 /**
  * Required files
  */
require_once __PUBLIC__."/includes/validate-functions.php";
require_once __PUBLIC__."/includes/user-functions.php";

/*
 * protected_user_only();
 * 
 * Allows access only to logged in users.
 * To place on top of any page content to be protected.
 * 
*/
function protected_user_only() {
    if (!is_logged_in()) {
        $location = str_replace(__HOME__, '', $_SERVER['REQUEST_URI']);
        redirect('login.php?&ref='.$location);
        exit;
    }
}
/*
 * admin_user_only();
 * 
 * Allows access only to admin accounts.
 * To place on top of any page content to be protected.
 * 
*/
function admin_user_only() {
    if (!is_admin()) {
        if (!is_logged_in()) {
            $location = str_replace(__HOME__, '', $_SERVER['REQUEST_URI']);
            redirect('login.php?&ref='.$location);
            exit;
        }
        echo '<div class="alert alert-error">';
        echo 'You are not authorized to access this area.';
        echo ' <a href="'.__BASEURL__.'">Go back</a>.';
        echo '</div>';
        exit;
    }
}
/*
 * redirect($url);
 * 
 * Common redirect function
 * 
 * params:
 *      $url: the URI to be redirected to. If empty redirects to home page.
*/
function redirect($url = '') {
    header('location: '.__BASEURL__.$url);
}

?>