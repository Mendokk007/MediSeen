<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

// Initialize variable to prevent "Undefined variable" warning
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

<div class="form-container-wide">
    <h2>Add New Medicine</h2>
    <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="POST" action="">
        <label>Medicine Name</label>
        <input type="text" name="name" required placeholder="e.g., Paracetamol">
        
        <label>Uses</label>
        <textarea name="uses" rows="3" required placeholder="e.g., Fever, mild to moderate pain"></textarea>
        
        <label>Dosage</label>
        <textarea name="dosage" rows="3" required placeholder="e.g., 500mg every 4-6 hours"></textarea>
        
        <label>Safety Disclaimer</label>
        <textarea name="disclaimer" rows="3" required placeholder="e.g., Do not exceed 4g per day. Consult a doctor if symptoms persist."></textarea>
        
        <div class="flex-gap">
            <button type="submit">Save Medicine</button>
            <a href="dashboard.php" class="btn btn-cancel">Cancel</a>
        </div>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>