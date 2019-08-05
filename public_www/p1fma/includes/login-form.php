<?php
$self = htmlentities($_SERVER['REQUEST_URI']);
$username = (isset($_POST) && isset($_POST['username'])) ? trim($_POST['username']) : '';
$password = (isset($_POST) && isset($_POST['password'])) ? trim($_POST['password']) : '';
?>
<form action="<?php echo $self; ?>" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo htmlentities($username) ?>" autocomplete="new-password" required />
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" value="<?php echo htmlentities($password) ?>" autocomplete="new-password" required />
    <input type="submit" name="login" value="login" />
</form>
