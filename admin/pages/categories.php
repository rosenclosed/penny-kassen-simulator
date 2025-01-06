<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        executeQuery($pdo, "INSERT INTO Categories (name) VALUES (:name)", [':name' => $_POST['name']]);
    }
}
$categories = fetchAll($pdo, "SELECT * FROM Categories");
?>
<h1>Categories</h1>
<form method="POST" class="mb-3">
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= htmlspecialchars($category['id']) ?></td>
            <td><?= htmlspecialchars($category['name']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>