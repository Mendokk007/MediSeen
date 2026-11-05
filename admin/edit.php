<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$error = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch existing medicine data
$stmt = $pdo->prepare("SELECT * FROM medicines WHERE id = ?");
$stmt->execute([$id]);
$med = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$med) {
    die("Medicine not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $uses = trim($_POST['uses']);
    $dosage = trim($_POST['dosage']);
    $disclaimer = trim($_POST['disclaimer']);

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

<h2>Edit Medicine</h2>
<?php if($error): ?><p class="error"><?= $error ?></p><?php endif; ?>

<form method="POST" action="">
    <label>Medicine Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($med['name']) ?>" required>
    
    <label>Uses</label>
    <textarea name="uses" rows="3" required><?= htmlspecialchars($med['uses']) ?></textarea>
    
    <label>Dosage</label>
    <textarea name="dosage" rows="3" required><?= htmlspecialchars($med['dosage']) ?></textarea>
    
    <label>Safety Disclaimer</label>
    <textarea name="disclaimer" rows="3" required><?= htmlspecialchars($med['disclaimer']) ?></textarea>
    
    <button type="submit">Update Medicine</button>
</form>

<?php require_once '../includes/footer.php'; ?>