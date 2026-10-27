<?php
require 'core/db.php';

if (isset($_POST['submit'])) {
    $cat_id = $_POST['category_id'];
    $name = $_POST['gown_name'];
    $color = $_POST['color'];
    $price = $_POST['rental_price'];
    
    $stmt = $pdo->prepare("INSERT INTO gowns (category_id, gown_name, color, rental_price) VALUES (?, ?, ?, ?)");
    $stmt->execute([$cat_id, $name, $color, $price]);
    echo "<script>alert('Gown added successfully!');</script>";
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$gowns = $pdo->query("SELECT gowns.*, categories.category_name FROM gowns JOIN categories ON gowns.category_id = categories.category_id")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gown Rental System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Add New Gown</h2>
    <form method="POST">
        Category: 
        <select name="category_id" required>
            <option value="">Select Category</option>
            <?php foreach ($categories as $cat) { ?>
                <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
            <?php } ?>
        </select> <br><br>
        Gown Name: <input type="text" name="gown_name" required> <br><br>
        Color: <input type="text" name="color"> <br><br>
        Rental Price: <input type="number" name="rental_price" required> <br><br>
        <input type="submit" name="submit" value="Save Gown">
    </form>

    <hr>

    <h2>Gown Inventory</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Gown Name</th>
            <th>Color</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($gowns as $gown) { ?>
        <tr>
            <td><?php echo $gown['gown_id']; ?></td>
            <td><?php echo $gown['category_name']; ?></td>
            <td><?php echo $gown['gown_name']; ?></td>
            <td><?php echo $gown['color']; ?></td>
            <td><?php echo $gown['rental_price']; ?></td>
            <td>
                <a href="edit_gown.php?id=<?php echo $gown['gown_id']; ?>">Edit</a> | 
                <a href="delete_gown.php?id=<?php echo $gown['gown_id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="index.php">Back to Categories</a>
</body>
</html>