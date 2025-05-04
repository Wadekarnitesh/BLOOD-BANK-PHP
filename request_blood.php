<?php
include 'includes/db_connect.php';
include 'includes/session.php';
ensureReceiver();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $rid = $_SESSION['receiver_id'];
    $bg  = $_POST['blood_group'];
    $loc = $_POST['location'];
    $stmt = $conn->prepare("INSERT INTO blood_requests(receiver_id,blood_group,location) VALUES(?,?,?)");
    $stmt->bind_param('iss',$rid,$bg,$loc);
    if($stmt->execute()) header('Location: receiver_dashboard.php');
}
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="css/style.css"><title>Request Blood</title></head><body>
<nav><a href="receiver_dashboard.php">Dashboard</a></nav>
<div class="container">
  <h2>Request Blood</h2>
  <form method="POST">
    <label>Blood Group</label>
    <select name="blood_group" required>
      <option value="A+">A+</option><option value="A-">A-</option>
      <option value="B+">B+</option><option value="B-">B-</option>
      <option value="O+">O+</option><option value="O-">O-</option>
      <option value="AB+">AB+</option><option value="AB-">AB-</option>
    </select>
    <label>Location</label><input type="text" name="location" required>
    <button type="submit">Submit Request</button>
  </form>
</div>
</body></html>