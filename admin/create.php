<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $uses = trim($_POST['uses']);
    $dosage = trim($_POST['dosage']);
    $disclaimer = trim($_POST['disclaimer']);

    if (empty($name) || empty($uses) || empty($dosage) || empty($disclaimer)) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO medicines (name, uses, dosage, disclaimer) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $uses, $dosage, $disclaimer])) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Failed to add medicine.";
        }
    }
}
?>

<h2>Add New Medicine</h2>
<?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>

<form method="POST" action="">
    <label>Medicine Name</label>
    <input type="text" name="name" required>
    
    <label>Uses</label>
    <textarea name="uses" rows="3" required></textarea>
    
    <label>Dosage</label>
    <textarea name="dosage" rows="3" required></textarea>
    
    <label>Safety Disclaimer</label>
    <textarea name="disclaimer" rows="3" required></textarea>
    
    <button type="submit">Save Medicine</button>
</form>

<?php require_once '../includes/footer.php'; ?>