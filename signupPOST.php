<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
require_once ('bd/connect.php');  

$username = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['senha'];

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($host, $db_username, $password, $database);
}
catch(Exception $e) {
    die("<strong>Falha de conexão:</strong> " . $e->getMessage());
}

$hash_password = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, senha) values ('$username', '$email', '$hash_password')";

try {
    $result = $conn->query($sql);
    echo "<p> Conta feita com sucesso! </p>";
}catch(Exception $e) {
    echo "<p> Erro executando INSERT: ". $e . "</p>";
}
?>
</body>
</html>
