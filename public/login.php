<?php
require_once '../config/db.php';
require_once '../includes/header.php';
// ... (keep all the PHP logic exactly the same) ...
?>
<div class="form-container">
    <h2>Welcome Back</h2>
    <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="POST" action="">
        <label>Username</label>
        <input type="text" name="username" required placeholder="Enter your username">
        <label>Password</label>
        <input type="password" name="password" required placeholder="Enter your password">
        <button type="submit" class="btn-full">Sign In</button>
    </form>

    <p class="text-center">Don't have an account? <a href="register.php" class="text-link">Register here</a>.</p>
</div>
<?php require_once '../includes/footer.php'; ?>