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
    <title>Entrar os cadastrar-se no Interlines</title>
</head>

<body>
    <?php
    require_once('bd/connect.php');
    require 'cookies.php';

    validCookie($cookieName, $conn)
    ?>
    <div class="container-login">
        <div class="login-box">
            <h1>Bem-vindo de volta!<br>Entre na Interlines e<br>retome a diversão!</h1>
            <form action="loginPOST.php" method="POST">
                <div class="text-form">
                    <div class="inputs-login">
                        <div class="input-individualy">
                            <label for="username">Username</label>
                            <br>
                            <input type="text" name="username" required />
                            <p id="error" class="error-text"></p>
                        </div>
                        <br>
                        <div class="input-individualy">
                            <label for="senha">Senha</label>
                            <br>
                            <input type="password" name="senha" required />
                        </div>
                    </div>
                    <input class="button" value="Entrar" type="submit">
                </div>
                <br>
            </form>
        </div>
        <p>Ainda não tem conta?
            <a href="signup.php">Cadastre-se agora</a>
        </p>
    </div>

    <script>
        function setErrorParam() {
            const params = new URLSearchParams(window.location.search);
            const errorParam = params.get('erro');

            if (errorParam) {
                document.getElementById('error').innerText = errorParam
            }
        };

        setErrorParam()
    </script>
</body>

</html>