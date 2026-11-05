<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';
// ... (keep all the PHP logic exactly the same) ...
?>
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
<?php require_once '../includes/footer.php'; ?>