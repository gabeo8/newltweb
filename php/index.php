<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if(isset($_COOKIE['username'])) {
  header("Location: profile.php");
  exit;
} else {
  header("Location: register.php");
  exit;
}
?>