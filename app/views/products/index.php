<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background: #f1f1f1;
        }

        a {
            text-decoration: none;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h2>Product Management</h2>

<p>
    <a href="/products/create">Add Product</a>
    <a href="/logout">Logout</a>
</p>

<table>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>

    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product['id'] ?></td>
        <td><?= $product['product_name'] ?></td>
        <td><?= $product['description'] ?></td>
        <td><?= $product['price'] ?></td>
        <td><?= $product['quantity'] ?></td>
        <td><?= $product['created_at'] ?></td>
        <td>
            <a href="/products/edit/<?= $product['id'] ?>">Edit</a>

            <a href="/products/delete/<?= $product['id'] ?>"
               onclick="return confirm('Delete this product?')">
                Delete
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>