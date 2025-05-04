<?php
include '../includes/session.php'; include '../includes/db_connect.php'; ensureAdmin();
$rs = $conn->query("SELECT * FROM donors");
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="../css/style.css"><title>Manage Donors</title></head><body>
<nav><a href="dashboard.php">Back</a></nav><div class="container">
  <h2>Donors List</h2><table><tr><th>ID</th><th>Name</th><th>Email</th><th>Group</th><th>Location</th><th>Phone</th></tr>
  <?php while($d=$rs->fetch_assoc()) echo "<tr><td>{$d['id']}</td><td>{$d['name']}</td><td>{$d['email']}</td><td>{$d['blood_group']}</td><td>{$d['location']}</td><td>{$d['phone']}</td></tr>"; ?>
  </table></div></body></html>