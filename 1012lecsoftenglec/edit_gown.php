<?php
require 'core/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM gowns WHERE gown_id = ?");
$stmt->execute([$id]);
$gown = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $name = $_POST['gown_name'];
    $color = $_POST['color'];
    $price = $_POST['rental_price'];
    
    $update_stmt = $pdo->prepare("UPDATE gowns SET gown_name = ?, color = ?, rental_price = ? WHERE gown_id = ?");
    $update_stmt->execute([$name, $color, $price, $id]);
    
    header("Location: gowns.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gown Rental System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Edit Gown</h2>
    <form method="POST">
        Gown Name: <input type="text" name="gown_name" value="<?php echo $gown['gown_name']; ?>" required> <br><br>
        Color: <input type="text" name="color" value="<?php echo $gown['color']; ?>"> <br><br>
        Rental Price: <input type="number" name="rental_price" value="<?php echo $gown['rental_price']; ?>" required> <br><br>
        <input type="submit" name="update" value="Update Gown">
    </form>
</body>
</html>