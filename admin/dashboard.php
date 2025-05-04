<?php
include '../includes/session.php'; include '../includes/db_connect.php';
ensureAdmin();
$tot_d = $conn->query("SELECT COUNT(*) as c FROM donors")->fetch_assoc()['c'];
$tot_r = $conn->query("SELECT COUNT(*) as c FROM receivers")->fetch_assoc()['c'];
$pend  = $conn->query("SELECT COUNT(*) as c FROM blood_requests WHERE status='Pending'")->fetch_assoc()['c'];
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="../css/style.css"><title>Admin Dashboard</title></head><body>
<nav><a href="dashboard.php">Home</a> | <a href="manage_donors.php">Donors</a> | <a href="manage_requests.php">Requests</a> | <a href="inventory.php">Inventory</a></nav>
<div class="container"><h2>Admin Dashboard</h2>
<p>Total Donors: <?php echo $tot_d;?></p><p>Total Receivers: <?php echo $tot_r;?></p><p>Pending Requests: <?php echo $pend;?></p>
</div></body></html>