<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
require_once '../includes/header.php';
// ... (keep all the PHP logic exactly the same) ...
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
        <textarea name="disclaimer" rows="3" required placeholder="e.g., Do not exceed 4g per day."></textarea>
        <div class="flex-gap">
            <button type="submit">Save Medicine</button>
            <a href="dashboard.php" class="btn btn-cancel">Cancel</a>
        </div>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>