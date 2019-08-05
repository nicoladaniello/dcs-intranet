<?php
$self = isset($self) ? $self : htmlentities($_SERVER['PHP_SELF']);
$title          = (isset($_POST)  && isset($_POST['title']))        ? trim($_POST['title'])       : '';
$first_name     = (isset($_POST)  && isset($_POST['first_name']))   ? trim($_POST['first_name'])  : '';
$surname        = (isset($_POST)  && isset($_POST['surname']))      ? trim($_POST['surname'])     : '';
$email          = (isset($_POST)  && isset($_POST['email']))        ? trim($_POST['email'])       : '';
$username       = (isset($_POST)  && isset($_POST['username']))     ? trim($_POST['username'])    : '';
$password       = (isset($_POST)  && isset($_POST['password']))     ? trim($_POST['password'])    : '';
?>
<h1>Administration</h1>
<p>Register a new user</p>
<form action="<?php echo $self; ?>" method="POST">
    <label for="title">Title:</label>
    <select name="title" id="title" required>
        <option value=""></option>
        <option value="mr" <?php if($title === 'mr') echo 'selected'?>>Mr</option>
        <option value="ms" <?php if($title === 'ms') echo 'selected'?>>Ms</option>
        <option value="miss" <?php if($title === 'miss') echo 'selected'?>>Miss</option>
    </select>
    <label for="first_name">First name:</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo htmlentities($first_name) ?>" autocomplete="new-password" require />
    <label for="surname">Surname:</label>
    <input type="text" name="surname" id="surname" value="<?php echo htmlentities($surname) ?>" autocomplete="new-password" require />
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" value="<?php echo htmlentities($email) ?>" autocomplete="new-password" require />
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo htmlentities($username) ?>" autocomplete="new-password" require />
    <label for="password">Password:</label>
    <input type="text" name="password" id="password" value="<?php echo htmlentities($password) ?>" autocomplete="new-password" require />
    <input type="submit" name="register" value="register" />
</form>
