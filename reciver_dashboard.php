<?php
include 'includes/db_connect.php';
include 'includes/session.php';
ensureReceiver();
$rid = $_SESSION['receiver_id'];
$res = $conn->query("SELECT id,blood_group,location,request_date,status FROM blood_requests WHERE receiver_id=$rid");
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="css/style.css"><title>Receiver Dashboard</title></head><body>
<nav><a href="receiver_dashboard.php">Dashboard</a> | <a href="request_blood.php">Request Blood</a></nav>
<div class="container">
  <h2>Your Blood Requests</h2>
  <table><tr><th>ID</th><th>Group</th><th>Location</th><th>Date</th><th>Status</th></tr>
    <?php while($r = $res->fetch_assoc()){
      echo "<tr><td>{$r['id']}</td><td>{$r['blood_group']}</td><td>{$r['location']}</td><td>{$r['request_date']}</td><td>{$r['status']}</td></tr>";
    } ?>
  </table>
</div>
</body></html>