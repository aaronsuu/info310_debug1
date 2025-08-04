<?php
session_start();
include './components/loggly-logger.php';

// Try to get username from cookie (if still present)
$username = $_SESSION['authenticated'] ?? 'unknown';
$time = date("Y-m-d H:i:s");  // ← moved this above
$logger->info("User $username logged out at $time");

// Expire the authentication cookie
unset($_SESSION['authenticated']);

// Expire the Administrator cookie
unset($_SESSION['isSiteAdministrator']); 
// Redirect to the login page
header('Location: login.php');
exit();
?>