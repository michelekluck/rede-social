<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p></p>
    <form action="loginPOST.php" method="POST">
    <label for="username">Username: </label>
        <input type="text" name="username" required/>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required/>
        
        <input type="submit">
    </form>

    <script>
        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('erro');
        }
    </script>
</body>
</html>