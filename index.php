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
    require 'cookies.php';
    
    $username = $_POST['username'];
    $senha = $_POST['senha'];
    
    try {
        $conn = new mysqli($host, $db_username, $password, $database);
    }
    catch(Exception $e) {
        die("<strong> Falha de conexão: </strong>" . $e);
    }

    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        setcookie($cookieName, '', time() - 3600, '/');

        $isDeleted = deleteCookie($cookieName, $conn);

        if ($isDeleted) {
            header('Location: login.php');
            exit(); 
        } else {
            echo "Erro ao tentar deslogar. Tente novamente.";
        }
    }
    ?>

    <h1>hello world</h1>
    <a href="?action=logout">Sair</a>
</body>

</html>