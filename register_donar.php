<?php
include 'includes/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("INSERT INTO donors (name,email,password,blood_group,location,phone) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param('ssssss',$name,$email,$password,$blood_group,$location,$phone);
    if ($stmt->execute()) {
        header('Location: login.php'); exit;
    } else echo "Error: " . $stmt->error;
}
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="css/style.css"><title>Donor Registration</title></head><body>
<div class="container">
  <h2>Donor Registration</h2>
  <form method="POST">
    <label>Name</label><input type="text" name="name" required>
    <label>Email</label><input type="email" name="email" required>
    <label>Password</label><input type="password" name="password" required>
    <label>Blood Group</label>
    <select name="blood_group" required>
      <option value="A+">A+</option><option value="A-">A-</option>
      <option value="B+">B+</option><option value="B-">B-</option>
      <option value="O+">O+</option><option value="O-">O-</option>
      <option value="AB+">AB+</option><option value="AB-">AB-</option>
    </select>
    <label>Location</label><input type="text" name="location" required>
    <label>Phone</label><input type="text" name="phone" required>
    <button type="submit">Register</button>
  </form>
</div>
</body></html>