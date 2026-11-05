<?php
require_once '../includes/header.php';
?>
<div class="page-hero">
    <h1 class="hero-title">Welcome to MediSeen</h1>
    <p class="hero-subtitle">Your simple, anonymous medicine information and symptom-based OTC recommendations. No registration required to lookup.</p>
    <div class="search-wrapper">
        <input type="text" placeholder="Search for a medicine or symptom..." disabled class="search-input">
        <p class="search-note">* Public lookup engine coming in Phase 3</p>
    </div>
</div>
<div class="feature-grid">
    <div class="feature-card">
        <h3 class="feature-title" style="color: var(--trust-teal);">100% Anonymous</h3>
        <p class="feature-text">Look up medicines without an account.</p>
    </div>
    <div class="feature-card">
        <h3 class="feature-title" style="color: var(--trust-teal-light);">Secure Admin</h3>
        <p class="feature-text">Curated by medical professionals.</p>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>