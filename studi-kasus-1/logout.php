<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
header("Location: 1_halaman1-login.php");
exit;

?>