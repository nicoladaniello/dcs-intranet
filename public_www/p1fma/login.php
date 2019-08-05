<?php
require_once '../../bootstrap.php';
require_once __PUBLIC__."/includes/functions.php";

$form_submitted = isset($_POST['login']);
$logged_in = is_logged_in();
$errors = array();
$credentials = array();
$page_ref = isset($_GET['ref']) ? $_GET['ref'] : 'index.php';

/**
 * Redirect to previous page if logged in
 */
if ($logged_in) {
  redirect($page_ref);
  exit;
}
/**
 * If the form is submitted try to login;
 * In case of success redirect to previous page;
 * Otherwise redisplay the form and display any error message available
 */
if ($form_submitted) {
  try {
    $credentials = validate_login_credentials();
    $logged_in = login_with_credentials($credentials);
    if ($logged_in) {
      redirect($page_ref);
      exit;
    }
    $errors[] = 'Incorrect username or password, please try again.';
  }
  catch(Exception $e) {
    $errors[] = $e->getMessage();
  }

}
/**
 * print form with any errors
 */
include __PUBLIC__."/includes/header.php";
include __PUBLIC__."/includes/navbar.php";
include __PUBLIC__."/includes/login-form.php";

if (sizeof($errors) > 0) {
  foreach($errors as $errorMessage) {
    echo "<div class=\"alert alert-error\">".$errorMessage."</div>";
  }
}

include __PUBLIC__."/includes/footer.php";

?>