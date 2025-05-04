<?php
session_start();

function isDonor() {
    return isset($_SESSION['donor_id']);
}
function isReceiver() {
    return isset($_SESSION['receiver_id']);
}
function isAdmin() {
    return isset($_SESSION['is_admin']);
}

function ensureLoggedIn() {
    if (!isDonor() && !isReceiver() && !isAdmin()) {
        header('Location: login.php');
        exit;
    }
}
?>