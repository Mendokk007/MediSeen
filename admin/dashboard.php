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

// Fetch all medicines (Read)
$stmt = $pdo->query("SELECT * FROM medicines ORDER BY name ASC");
$medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Admin Dashboard - Medicines</h2>
<a href="create.php"><button>+ Add New Medicine</button></a>

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
            <td><?= htmlspecialchars($med['name']) ?></td>
            <td><?= htmlspecialchars($med['uses']) ?></td>
            <td><?= htmlspecialchars($med['dosage']) ?></td>
            <td>
                <a href="edit.php?id=<?= $med['id'] ?>">Edit</a> | 
                <a href="dashboard.php?delete=<?= $med['id'] ?>" onclick="return confirm('Are you sure?')" style="color: red;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($medicines)): ?>
        <tr><td colspan="4">No medicines found in the database.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once '../includes/footer.php'; ?>