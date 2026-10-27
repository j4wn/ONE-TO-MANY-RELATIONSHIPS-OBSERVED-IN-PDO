<?php
require 'core/db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['category_name'];
    $desc = $_POST['description'];
    
    $stmt = $pdo->prepare("INSERT INTO categories (category_name, description) VALUES (?, ?)");
    $stmt->execute([$name, $desc]);
    echo "<script>alert('Category added successfully!');</script>";
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gown Rental System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Add New Category</h2>
    <form method="POST">
        Category Name: <input type="text" name="category_name" required> <br><br>
        Description: <input type="text" name="description"> <br><br>
        <input type="submit" name="submit" value="Save Category">
    </form>

    <hr>

    <h2>Category List</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Action</th> <!-- Added Action header -->
        </tr>
        <?php foreach ($categories as $cat) { ?>
        <tr>
            <td><?php echo $cat['category_id']; ?></td>
            <td><?php echo $cat['category_name']; ?></td>
            <td><?php echo $cat['description']; ?></td>
            <td>
                <!-- Added Edit and Delete links -->
                <a href="edit_category.php?id=<?php echo $cat['category_id']; ?>">Edit</a> | 
                <a href="delete_category.php?id=<?php echo $cat['category_id']; ?>" onclick="return confirm('WARNING: Deleting this will also delete ALL gowns inside this category. Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="gowns.php">Manage Gowns Inventory</a>
</body>
</html>