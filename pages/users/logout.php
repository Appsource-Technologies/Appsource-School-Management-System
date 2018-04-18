<?php
session_start();
unset($_SESSION['school_user_role']);
unset($_SESSION['school_username']);
unset($_SESSION['school_user_id']);
$user=new User();
$user->logout();
Redirect::to('index.php?page=login');
?>