<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
require 'bd/connect.php'; 

$username = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$conn = new mysqli($host, $db_username, $password, $database);

if ($conn->connect_error) {
    die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
}

$sql = "INSERT INTO users (username, email, senha) values ('$username', '$email', '$senha')";

if ($result = $conn->query($sql)) {
    echo "<p> Conta feita com sucesso! </p>";
} else {
    echo "<p> Erro executando INSERT: ". $conn->connect_error . "</p>";
}
$conn->close();
?>
</body>
</html>
