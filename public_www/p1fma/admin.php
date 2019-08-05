<?php
require_once '../../bootstrap.php';
require_once __PUBLIC__.'/includes/functions.php';
/**
 * Restrict access to administrators only
 */
admin_user_only();

$form_submitted = isset($_POST['register']);
$registered = false;
$errors = array();
$user_values = array();
$self = htmlentities($_SERVER['PHP_SELF']);
/**
 * If the form is submitted register the new user;
 * In case of success display a success message,
 * otherwise display any error message available;
 * In any case, redisplay the registration form
 */
if ($form_submitted) {
    try {
        $user_values = validate_user_values();
        $registered = register_new_user($user_values);
    }
    catch(Exception $e) {
        $errors[] = $e->getMessage();
    }
}
/**
 * print form with any error or success message
 */
include __PUBLIC__."/includes/header.php";
include __PUBLIC__."/includes/navbar.php";
include __PUBLIC__."/includes/register-form.php";

if ($registered)
    echo '<div class="alert alert-success">New user with username <b>'.htmlentities($user_values['username']).'</b> registered successfully!</div>';

if (isset($errors) && sizeof($errors) > 0) {
  foreach($errors as $errorMessage) {
    echo '<div class="alert alert-error">'.$errorMessage.'</div>';
  }
}

include __PUBLIC__."/includes/footer.php";

?>