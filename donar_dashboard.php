<?php
include 'includes/db_connect.php';
include 'includes/session.php';
ensureDonor();
$did = $_SESSION['donor_id'];
// Fetch donor info
$dqr = $conn->query("SELECT blood_group,location FROM donors WHERE id=$did");
$dr  = $dqr->fetch_assoc();
// Fetch matching requests
$stmt = $conn->prepare("SELECT br.id, r.name, br.request_date, br.status
    FROM blood_requests br
    JOIN receivers r ON r.id = br.receiver_id
    WHERE br.blood_group = ? AND br.location = ?");
$stmt->bind_param('ss', $dr['blood_group'], $dr['location']);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html><head><link rel="stylesheet" href="css/style.css"><title>Donor Dashboard</title></head><body>
<nav><a href="donor_dashboard.php">Dashboard</a> | <a href="index.php">Logout</a></nav>
<div class="container">
  <h2>Welcome, Donor</h2>
  <h3>Blood Requests for <?php echo $dr['blood_group'];?> at <?php echo $dr['location'];?></h3>
  <table><tr><th>ID</th><th>Receiver</th><th>Date</th><th>Status</th></tr>
  <?php while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['request_date']}</td><td>{$row['status']}</td></tr>";
  } ?>
  </table>
</div>
</body></html>