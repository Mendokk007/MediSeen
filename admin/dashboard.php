<?php
require_once '../includes/auth.php'; // Route Protection
require_once '../config/db.php';
require_once '../includes/header.php';

// Handle Delete request
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM medicines WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php");
    exit();
}

// Initialize variables
$medicines = [];

// Fetch all medicines (Read)
$stmt = $pdo->query("SELECT * FROM medicines ORDER BY name ASC");
if ($stmt) {
    $medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="flex-between">
    <h2 style="margin-bottom: 0; border: none; padding: 0;">Medicine Directory</h2>
    <a href="create.php"><button class="btn-accent">+ Add New Medicine</button></a>
</div>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Uses</th>
            <th>Dosage</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($medicines as $med): ?>
        <tr>
            <td style="font-weight: 600; color: var(--trust-teal);"><?= htmlspecialchars($med['name']) ?></td>
            <td><?= htmlspecialchars($med['uses']) ?></td>
            <td><?= htmlspecialchars($med['dosage']) ?></td>
            <td>
                <a href="edit.php?id=<?= $med['id'] ?>" class="action-link">Edit</a> 
                <a href="dashboard.php?delete=<?= $med['id'] ?>" onclick="return confirm('Are you sure you want to delete this medicine?')" class="delete-link">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($medicines)): ?>
        <tr><td colspan="4" class="empty-state">No medicines found in the database. Click "Add New Medicine" to get started.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once '../includes/footer.php'; ?>