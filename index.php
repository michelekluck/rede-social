<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start(); // inicia a sessão = acessa informações de sessão

    require_once('bd/connect.php');
    require 'cookies.php';

    // conexta com o bd
    try {
        $conn = new mysqli($host, $db_username, $password, $database);
    } catch (Exception $e) {
        die("<strong> Falha de conexão: </strong>" . $e);
    }

    setUserSession($cookieName, $conn);

    // verifica se há um campo com user_id na session
    // verifica se há um campo com username na session
    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        // se existir
        echo "<h2>Bem-vindo, " . $_SESSION['username'] . "!</h2>";
        echo "<p>ID do usuário: " . $_SESSION['user_id'] . "</p>";
    } else {
        echo "<p>erro no index.php</p>";
    }

    // logout - sair (apaga o cookie -> desloga o usuario)
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

    // mostra o array de posts
    foreach ($postsRepository->getAll() as $post) { // foreach -> percorre o array
        $content = $post["content"];
        $post_id = $post["id"];

        echo 
        "<div>
        <div><p>$content</p></div>
        <form action='postDelete.php' method='POST'>
        <input type='number' value='$post_id' name='id' style='display: none'>
        <input type='submit' value='Excluir'>
        </form>
        </div>";
    }
    ?>

    <h1>hello world</h1>

    <form action="postAction.php" method="POST">
        <label for="content">
            <textarea type="text" name="content" placeholder="No que você está pensando?"></textarea>
        </label>

        <input type="submit">
    </form>

    <a href="?action=logout">Sair</a>
</body>

</html>