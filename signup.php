<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="public/favicon.jpeg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Kumbh+Sans:wght,YOPQ@100..900,116&family=Lexend+Mega:wght@100..900&family=Madimi+One&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Quicksand:wght@300..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Kumbh+Sans:wght,YOPQ@100..900,116&family=Lexend+Mega:wght@100..900&family=Madimi+One&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Quicksand:wght@300..700&display=swap');
    </style>
</head>
<body>
    
    <form action="signup.php" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" required/>

        <label for="email">E-mail:</label>
        <input type="email" name="email" required/>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required/>
        
        <input type="submit">
    </form>
</body>
</html> 