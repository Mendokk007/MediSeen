<?php
require_once '../config/db.php';
require_once '../includes/header.php';
// ... (keep all the PHP logic exactly the same) ...
?>
<div class="form-container">
    <h2>Create an Account</h2>
    <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>
    <?php if($success): ?><div class="success"><?= $success ?></div><?php endif; ?>

    <form method="POST" action="">
        <label>Username</label>
        <input type="text" name="username" required minlength="3" placeholder="Enter your username">
        <label>Password (min 6 chars)</label>
        <input type="password" name="password" required minlength="6" placeholder="Create a password">
        <button type="submit" class="btn-full">Sign Up</button>
    </form>
    
    <p class="text-center">Already have an account? <a href="login.php" class="text-link">Log in here</a>.</p>
</div>
<?php require_once '../includes/footer.php'; ?>