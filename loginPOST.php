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
require 'cookies.php';

$username = $_POST['username'];
$senha = $_POST['senha'];

$sql = "SELECT senha, id FROM users WHERE username = '$username'";

try {
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row["senha"])) {
        $user_id = $row["id"];
        createCookie($user_id, $conn, $cookieName);
        header('location: index.php');
    } else {
        header(sprintf('location: %s?erro=senha ou usuario invalido', $_SERVER['HTTP_REFERER']));
        die();
    }
}catch(Exception $e) {
    echo "<p> Erro executando SELECT: ". $e . "</p>";
}
?>

</body>
</html>
