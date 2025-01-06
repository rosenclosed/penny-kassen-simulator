<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        executeQuery($pdo, "INSERT INTO Products (name) VALUES (:name)", [':name' => $_POST['name']]);
    }
}
$products = fetchAll($pdo, "SELECT * FROM Products");
?>
<h1>Products</h1>
<form method="POST" class="mb-3">
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Cat. ID</th>
            <th>Price</th>
            <th>EAN-13</th>
            <th>EAN-8</th>
            <th>NAN</th>
            <th>PLU</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['id'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['name'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['category_id'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['price'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['ean_13'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['ean_8'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['nan'] ?? '') ?></td>
            <td><?= htmlspecialchars($product['plu'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>