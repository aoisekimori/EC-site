<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false) {
  header('Location:staff_login.php');
  exit();
} else {
  header('Location:staff_top.php');
  exit();
}
?>
