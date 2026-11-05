<?php
require_once '../config/db.php';
require_once '../includes/header.php';

// Initialize variable to prevent "Undefined variable" warnings
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password_hash'])) {
            // Success: Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: /mediseen/admin/dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
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