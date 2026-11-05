<?php
// includes/auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user_id is not set in the session, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: /mediseen/public/login.php");
    exit();
}
?>