<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        require_once('bd/connect.php');
        require 'cookies.php';
    
        $post_id = $_POST['id'];
        $content = $_POST['content'];

        // Verificando se o conteúdo foi enviado via POST
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            echo "<p>Erro: o id não existe</p>";
            exit();  // Impede a execução do restante do código
        }
    
        // Verifica se o usuário está logado
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            echo "<p>Erro: usuário não está logado!</p>";
            exit();
        }
        // Pega o user_id da sessão
        $user_id = $_SESSION['user_id']; 
        
        try {
            // edita o post
            $postsRepository->update($post_id, $content);
            header('location: index.php');
        } catch (Exception $e) {
            echo "<p>Erro: " . $e->getMessage() . "</p>";
        }
    ?>

</body>
</html>