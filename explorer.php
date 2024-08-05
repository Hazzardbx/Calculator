<?php
include 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;

$stmt = $conn->prepare("SELECT * FROM calculations WHERE id = ?");
$stmt->execute([$id]);
$calculation = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($calculation);
?>
