<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';
// ... (keep all the PHP logic exactly the same) ...
?>
<div class="flex-between">
    <h2 style="margin-bottom: 0; border: none; padding: 0;">Medicine Directory</h2>
    <a href="create.php"><button class="btn-accent">+ Add New Medicine</button></a>
</div>

<table>
    <thead>
        <tr><th>Name</th><th>Uses</th><th>Dosage</th><th>Actions</th></tr>
    </thead>
    <tbody>
        <?php foreach($medicines as $med): ?>
        <tr>
            <td style="font-weight: 600; color: var(--trust-teal);"><?= htmlspecialchars($med['name']) ?></td>
            <td><?= htmlspecialchars($med['uses']) ?></td>
            <td><?= htmlspecialchars($med['dosage']) ?></td>
            <td>
                <a href="edit.php?id=<?= $med['id'] ?>" class="action-link">Edit</a> 
                <a href="dashboard.php?delete=<?= $med['id'] ?>" onclick="return confirm('Are you sure?')" class="delete-link">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($medicines)): ?>
        <tr><td colspan="4" class="empty-state">No medicines found. Click "Add New Medicine" to get started.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php require_once '../includes/footer.php'; ?>