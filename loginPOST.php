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
$senha = $_POST['senha'];

try {
    $conn = new mysqli($host, $db_username, $password, $database);
}
catch(Exception $e) {
    die("<strong> Falha de conexão: </strong>" . $e);
}

$sql = "SELECT senha FROM users WHERE username = '$username'";

try {
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row["senha"])) {
        echo "<p> Usuario e senha corretos! </p>";
    } else {
        header(sprintf('location: %s?erro=senha ou usuario invalido', $_SERVER['HTTP_REFERER']));
        exit;
    }
}catch(Exception $e) {
    echo "<p> Erro executando SELECT: ". $e . "</p>";
}
?>

</body>
</html>
