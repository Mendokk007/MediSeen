<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediSeen</title>
    <!-- The Single Source of Truth for Design -->
    <link rel="stylesheet" href="/mediseen/assets/style.css">
</head>
<body>
    <nav>
        <div class="logo">
            Medi<span>Seen</span>
        </div>
        <div class="nav-links">
            <a href="/mediseen/public/index.php">Home</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="/mediseen/admin/dashboard.php">Dashboard</a>
                <span class="user-greeting">Hello, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="/mediseen/public/logout.php" class="nav-btn-logout">Logout</a>
            <?php else: ?>
                <a href="/mediseen/public/login.php">Login</a>
                <a href="/mediseen/public/register.php" class="nav-btn-primary">Register</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container">