<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "calculator_db";

ini_set('memory_limit', '512M');


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM calculations LIMIT 100";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
    }
    $result->free();
} else {
    echo "Erro na consulta: " . $conn->error;
}

$conn->close();
?>
