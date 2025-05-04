<?php
include '../includes/session.php'; include '../includes/db_connect.php'; ensureAdmin();
$rs = $conn->query("SELECT blood_group,location,COUNT(*) as cnt FROM donors GROUP BY blood_group,location");
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="../css/style.css"><title>Inventory</title></head><body>
<nav><a href="dashboard.php">Back</a></nav><div class="container">
  <h2>Blood Inventory</h2><table><tr><th>Group</th><th>Location</th><th>Donors</th></tr>
  <?php while($i=$rs->fetch_assoc()) echo "<tr><td>{$i['blood_group']}</td><td>{$i['location']}</td><td>{$i['cnt']}</td></tr>"; ?>
  </table></div></body></html>