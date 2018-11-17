<?php
  setcookie('username', null, time() - 3600, '/');
  unset($_COOKIE['username']);
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Location: login.php");
  exit();
?>