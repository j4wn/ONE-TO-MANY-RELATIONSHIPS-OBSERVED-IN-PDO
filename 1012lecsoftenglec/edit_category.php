<?php
require 'core/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $name = $_POST['category_name'];
    $desc = $_POST['description'];
    
    $update_stmt = $pdo->prepare("UPDATE categories SET category_name = ?, description = ? WHERE category_id = ?");
    $update_stmt->execute([$name, $desc, $id]);
    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Edit Category (Parent)</h2>
    <form method="POST">
        Category Name: <input type="text" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>" required> <br><br>
        Description: <input type="text" name="description" value="<?php echo htmlspecialchars($category['description']); ?>"> <br><br>
        <input type="submit" name="update" value="Update Category">
    </form>
    <br>
    <a href="index.php">Cancel</a>
</body>
</html>