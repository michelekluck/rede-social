<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
session_start(); // inicia a sessão e armazena

require_once ('bd/connect.php');  
require 'cookies.php';

$username = $_POST['username'];
$senha = $_POST['senha'];

$sql = "SELECT senha, id FROM users WHERE username = '$username'";

try {
    $result = $conn->query($sql); // realiza a consulta no banco
    $row = $result->fetch_assoc(); //fetch_assoc() faz um array associativo com os dados do bd
    if (password_verify($senha, $row["senha"])) { // verificamos se a senha enviada pelo usuário é igual a "senha" do bd, $row porque estamos olhando a partir do array que o fatch criou, e "senha" lá, é uma linha
        $user_id = $row["id"]; // guardamos o valor do id da tabela users na variavel $user_id

        // o id_user se refere ao campo sendo criado em session
        // o $user_id se refere ao retorno do id do bd
        $_SESSION['user_id'] = $user_id; // guarda o id do usuario na session
        $_SESSION['username'] = $username; // guarda o username na session
        // esse username se refere ao campo sendo criado em session
        // $username se refere ao retorno do username do bd

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
