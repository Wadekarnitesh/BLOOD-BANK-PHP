<?php
include 'includes/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $location = trim($_POST['location']);
    $phone    = trim($_POST['phone']);

    // Prepare and execute insertion
    $stmt = $conn->prepare(
        "INSERT INTO receivers (name, email, password, location, phone) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param('sssss', $name, $email, $password, $location, $phone);

    if ($stmt->execute()) {
        // Redirect to login on successful registration
        header('Location: login.php');
        exit;
    } else {
        // Display error if email already exists or other DB issues
        $error = "Registration error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Receiver Registration</title>
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="register_donor.php">Donor Signup</a>
    <a href="register_receiver.php">Receiver Signup</a>
    <a href="login.php">Login</a>
</nav>

<div class="container">
  <h2>Receiver Registration</h2>
  <?php if (!empty(\$error)) echo "<p style='color:red;'>\$error</p>"; ?>
  <form method="POST" action="register_receiver.php">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>

    <label for="location">Location</label>
    <input type="text" name="location" id="location" required>

    <label for="phone">Phone</label>
    <input type="text" name="phone" id="phone" required>

    <button type="submit">Register</button>
  </form>
</div>
</body>
</html>
