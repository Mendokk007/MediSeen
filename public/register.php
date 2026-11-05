<?php
require_once '../config/db.php';
require_once '../includes/header.php';

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

<h2>Create an Account</h2>
<?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>
<?php if($success): ?><p style="color: green;"><?= $success ?></p><?php endif; ?>

<form method="POST" action="">
    <label>Username</label>
    <input type="text" name="username" required minlength="3">
    
    <label>Password (min 6 chars)</label>
    <input type="password" name="password" required minlength="6">
    
    <button type="submit">Sign Up</button>
</form>

<?php require_once '../includes/footer.php'; ?>