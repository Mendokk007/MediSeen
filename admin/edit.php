<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

// 1. Initialize ALL variables at the very top
$error = '';
$med = null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Fetch the medicine (Only if ID is valid)
if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM medicines WHERE id = ?");
    $stmt->execute([$id]);
    $med = $stmt->fetch(PDO::FETCH_ASSOC);
}

// 3. Handle POST request (Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $med) {
    $name = trim($_POST['name'] ?? '');
    $uses = trim($_POST['uses'] ?? '');
    $dosage = trim($_POST['dosage'] ?? '');
    $disclaimer = trim($_POST['disclaimer'] ?? '');

    if (empty($name) || empty($uses) || empty($dosage) || empty($disclaimer)) {
        $error = "All fields are required.";
    } else {
        $stmt = $pdo->prepare("UPDATE medicines SET name = ?, uses = ?, dosage = ?, disclaimer = ? WHERE id = ?");
        if ($stmt->execute([$name, $uses, $dosage, $disclaimer, $id])) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Failed to update medicine.";
        }
    }
}
?>

<?php if (!$med): ?>
    <!-- 4. Fallback UI if medicine doesn't exist -->
    <div class="form-container-wide" style="text-align: center;">
        <h2 style="border: none;">Medicine Not Found</h2>
        <p>The medicine you are trying to edit does not exist or has been deleted.</p>
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
    </div>
<?php else: ?>
    <!-- 5. The actual form (Only renders if $med exists) -->
    <div class="form-container-wide">
        <h2>Edit Medicine</h2>
        <?php if($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

        <form method="POST" action="">
            <label>Medicine Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($med['name']) ?>" required>
            
            <label>Uses</label>
            <textarea name="uses" rows="3" required><?= htmlspecialchars($med['uses']) ?></textarea>
            
            <label>Dosage</label>
            <textarea name="dosage" rows="3" required><?= htmlspecialchars($med['dosage']) ?></textarea>
            
            <label>Safety Disclaimer</label>
            <textarea name="disclaimer" rows="3" required><?= htmlspecialchars($med['disclaimer']) ?></textarea>
            
            <div class="flex-gap">
                <button type="submit">Update Medicine</button>
                <a href="dashboard.php" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>