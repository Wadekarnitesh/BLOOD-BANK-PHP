<?php
include '../includes/session.php'; include '../includes/db_connect.php'; ensureAdmin();
$rs = $conn->query("SELECT br.id,r.name,br.blood_group,br.location,br.request_date,br.status FROM blood_requests br JOIN receivers r ON r.id=br.receiver_id");
if(isset($_GET['action'],$_GET['id'])){
    $st = ($_GET['action']=='approve')?'Approved':'Rejected';
    $conn->query("UPDATE blood_requests SET status='$st' WHERE id=".(int)$_GET['id']);
    header('Location: manage_requests.php'); exit;
}
?>
<!DOCTYPE html><html><head><link rel="stylesheet" href="../css/style.css"><title>Manage Requests</title></head><body>
<nav><a href="dashboard.php">Back</a></nav><div class="container">
  <h2>Requests</h2><table><tr><th>ID</th><th>Receiver</th><th>Group</th><th>Location</th><th>Date</th><th>Status</th><th>Action</th></tr>
  <?php while($r=$rs->fetch_assoc()){
    echo "<tr><td>{$r['id']}</td><td>{$r['name']}</td><td>{$r['blood_group']}</td><td>{$r['location']}</td><td>{$r['request_date']}</td><td>{$r['status']}</td><td>";
    if($r['status']=='Pending') echo "<a href='?action=approve&id={$r['id']}'>Approve</a> | <a href='?action=reject&id={$r['id']}'>Reject</a>";
    echo "</td></tr>";
  } ?>