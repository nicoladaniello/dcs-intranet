<?php
require_once '../../../bootstrap.php';
require_once __PUBLIC__."/includes/functions.php";

protected_user_only();

include __PUBLIC__."/includes/header.php";
include __PUBLIC__."/includes/navbar.php";
?>

<h1>Intranet</h1>

<p>Links:</p>
<ul>
  <li>
    <a href="DTresults.php">Introduction to Database Technology – DT Results</a>
  </li>
  <li>
    <a href="P1results.php">Web Programming using PHP - P1 Results</a>
  </li>
  <li>
    <a href="PfPresults.php">Problem Solving for Programming – PfP Results</a>
  </li>
</ul>

<?php
include __PUBLIC__."/includes/footer.php";
?>