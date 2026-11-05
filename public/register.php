<?php
require_once '../config/db.php';
require_once '../includes/header.php';

// Initialize variables to prevent "Undefined variable" warnings
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // 1. Backend Validation
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // 2. Check if username exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Username is already taken.";
        } else {
            // 3. Hash password and insert
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
            if ($stmt->execute([$username, $hash])) {
                $success = "Registration successful! You can now <a href='login.php'>Login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
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