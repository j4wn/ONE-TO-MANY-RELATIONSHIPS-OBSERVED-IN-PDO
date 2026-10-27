<?php
require 'core/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM gowns WHERE gown_id = ?");
$stmt->execute([$id]);

header("Location: gowns.php");
?>