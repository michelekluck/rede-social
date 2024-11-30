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
    <title>Cadastre-se | Interlines</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="public/favicon.jpeg">
</head>

<body>
    <div class="container-login">
        <div class="signup-box">
            <h1>Entre na Interlines e<br>compartilhe sua voz com o poder das palavras!</h1>
            <form action="signupPOST.php" method="POST" id="signupForm">
                <div class="text-form">
                    <div class="inputs-login">
                        <div class="input-individualy">
                            <label for="username">*Username</label>
                            <input
                                type="text"
                                name="username"
                                minlength="5"
                                maxlength="15"
                                required />
                        </div>
                        <br>
                        <div class="input-individualy">
                            <label for="email">*E-mail</label>
                            <input type="email" name="email" required />
                        </div>
                        <br>
                        <div class="input-individualy">
                            <label for="senha">*Senha</label>
                            <input type="password" name="senha" required />
                        </div>
                    </div>
                    <input class="button" value="Cadastre-se" type="submit">
                </div>
            </form>
        </div>
        <p>Ja tem conta na Interlines?
            <a href="login.php">Entrar</a>
        </p>
    </div>
</body>

<script src="scripts/script.js"></script>

</html>