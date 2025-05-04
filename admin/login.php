<?php
include '../includes/db_connect.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    if($_POST['user']=='admin' && $_POST['pass']=='admin123'){
        $_SESSION['is_admin']=true;
        header('Location: dashboard.php'); exit;
    } else $err="Invalid admin creds";
}
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="../css/style.css"><title>Admin Login</title></head><body>
<div class="container"><h2>Admin Login</h2><?php if(!empty($err)) echo "<p style='color:red;'>$err</p>"; ?>
<form method="POST"><label>Username</label><input type="text" name="user" required>
<label>Password</label><input type="password" name="pass" required>
<button>Login</button></form></div></body></html>