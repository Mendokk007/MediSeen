<?php
require_once '../includes/header.php';
?>

<h1>Welcome to MediSeen</h1>
<p>Your simple medicine information and symptom-based OTC recommendations.</p>
<div style="padding: 20px; background: #e9ecef; border-radius: 8px; margin-top: 20px;">
    <h3>Public Search (Anonymous)</h3>
    <p>Anonymous lookup will be implemented in the next phase.</p>
    <input type="text" placeholder="Search for a medicine or symptom..." disabled>
    <p><small><em>Note: You can log in to access the Admin CRUD dashboard.</em></small></p>
</div>

<?php require_once '../includes/footer.php'; ?>