<?php
require_once __PUBLIC__."/includes/functions.php";
if(!isset($_SESSION)) 
  session_start();
?>
<nav class="navbar">
  <ul>
    <li>
      <a href="<?php echo __BASEURL__ ?>index.php">home</a>
    </li>
    <li>
      <a href="<?php echo __BASEURL__ ?>secured/index.php">intranet</a>
    </li>
    <?php
    if (is_admin()) {
    ?>
    <li>
      <a href="<?php echo __BASEURL__ ?>admin.php">administrator</a>
    </li>
    <?php
    }
    if (!is_logged_in()) {
    ?><li>
      <a href="<?php echo __BASEURL__ ?>login.php">login</a>
    </li>
    <?php
    } else {
    ?>
    <li>
      <a href="<?php echo __BASEURL__ ?>logout.php">logout</a>
    </li>
    <li>
      Welcome back <b><?php echo htmlentities($_SESSION['username']) ?></b>
    </li>
    <?php
    }
    ?>
  </ul>
</nav>
