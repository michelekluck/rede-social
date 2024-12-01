<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Kumbh+Sans:wght,YOPQ@100..900,116&family=Lexend+Mega:wght@100..900&family=Madimi+One&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Quicksand:wght@300..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Kumbh+Sans:wght,YOPQ@100..900,116&family=Lexend+Mega:wght@100..900&family=Madimi+One&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Quicksand:wght@300..700&display=swap');
    </style>
    <title>Interlines</title>
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

    // define uma sessão pro usuário
    setUserSession($cookieName, $conn);

    // verifica qual usuário está logado
    // verifica se há um campo com user_id na session
    // verifica se há um campo com username na session
    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        // se existir
        $username = $_SESSION['username'];
        $user_id = $_SESSION['user_name'];
    } else {
        $user_name = 'usuário desconhecido';
        $user_id = 'id não disponivel';
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
    ?>

    <!-- HEADER -->
    <header class="header">
        <div class="container-index">
            <p>Bem-vindo, <?php echo $username; ?>!</p>
            <a href="action=logout" id="sair">Sair</a>
        </div>
    </header>

    <div class="post-box">
        <form action="postAction.php" method="POST" class="post-form">
            <textarea type="text" name="content" placeholder="No que você está pensando?"></textarea>
            <input type="submit" value="Postar">
        </form>
    </div>

    <div class="posts">
        <!-- POSTS -->
        <?php
        // mostra o array de posts
        foreach ($postsRepository->getAll() as $post) { // foreach -> percorre o array
            $content = $post["content"];
            $post_id = $post["id"];
            $user_id = $post["user_id"];
        ?>
            <div class="englobatudo">
                <div class="published">
                    <p><?= $content ?></p>
                </div>
                <?php if ($_SESSION['user_id'] == $user_id): ?>
                    <div>
                        <form action='postDelete.php' method='POST'>
                            <input type='number' name='id' value='$post_id' style='display: none'>
                            <input type='submit' value='X' class="button-delete">
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>