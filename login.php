<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="loginPOST.php" method="POST">
    <label for="username">Username: </label>
        <input type="text" name="username" required/>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required/>
        
        <input type="submit">
    </form>

    <p id="error"></p>

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