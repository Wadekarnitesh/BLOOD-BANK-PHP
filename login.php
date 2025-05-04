<?php
include 'includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass  = $_POST['password'];
    $role  = $_POST['role']; // donor or receiver

    if ($role === 'donor') {
        $stmt = $conn->prepare("SELECT id,password FROM donors WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT id,password FROM receivers WHERE email = ?");
    }
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    if ($stmt->fetch() && password_verify($pass, $hash)) {
        if ($role === 'donor') $_SESSION['donor_id'] = $id;
        else              $_SESSION['receiver_id'] = $id;
        header("Location: {($role==='donor'?'donor_dashboard':'receiver_dashboard')}.php"); exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="css/style.css"><title>Login</title></head><body>
<div class="container">
  <h2>Login</h2>
  <?php if(!empty($error)) echo "<p style='color:red;'>$error</p>";?>
  <form method="POST">
    <label>Email</label><input type="email" name="email" required>
    <label>Password</label><input type="password" name="password" required>
    <label>Role</label>
    <select name="role">
      <option value="donor">Donor</option>
      <option value="receiver">Receiver</option>
    </select>
    <button type="submit">Login</button>
  </form>
</div>
</body></html>