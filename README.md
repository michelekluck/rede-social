O que foi feito até agora (24/11):
1. Criamos o banco de dados no utilizando os comandos do arquivo redeSocial.sql;
2. Conectamos ao banco de dados no arquivo connect.php
3. No arquivo signup.php está o formulário de inscrição, o form action direcionando para o arquivo signuPOST.php;
4. No arquivo signupPOST.php inserimos o conteudo do arquivo connect.php;
   - Guardamos em variaveis os dados que o usuario digitar em username, email e senha;
   - Try-catch -> o mysqli_report configura como o mysqli deve lidar com os erros. As flags MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT intrui o mysqli a lançar exceções quando um erro acontecer;
     O bloco tenta criar uma conexão ao banco de dados;
     Se algum erro acontecer uma exceção é lançada e capturada no catch
     O objeto $e no catch contém detalhes sobre o erro.
   - Criamos um hash seguro da senha do usuario antes de armazenar no banco de dados, utilizando a função password_hash;
   - em $sql damos uma instrução SQL para inserir dados na tabela users no banco de dados, usando os valores armazenados nas variaveis $username, $email e $hash_password;
   - Try-catch -> Tenta executar o INSERT SQL da variavel $sql e captura qualquer erro que pode ocorrer;
     $conn->query($sql) = $conn é a variavel que representa a conexão com o banco de dados;
       query() é o método da classe mysqli usado para executar instruções SQL
       $sql é uma string contendo o comando SQL a ser executado
     Se houver um erro (como tabela inexistente ou valores invalidos) uma exceção é lançada e capturada no catch;
     O objeto $e contem detalhes sobre o erro
5. No arquivo cookies.php estou criando funções para criar, validar e excluir cookies;
   - criamos duas variaveis globais chamadas $conn e $cookieName = "PHPCOOKIE"
   - a função createCookie, cria cookies(usuarios logando pela primeira vez) e tem como parametros 3 variaveis, $user_id (que remete ao id do usuario), $conn (que remete a conexão com o banco de dados) e $cookieName (nome do cookie)
     dentro da função geramos um valor aletorio e unico utilizando a função md5(rand()) e guardamos na variavel $cookieValue;
     em $sql armazenamos uma instrução INSERT SQL, onde irá inserir na tabela cookies, nos campos user_id e value os valores armazenados na variaveis $user_id e $cookieValue (valor gerado na linha acima)
     conectamos ao banco de dados e setamos o cookie com a função setcookie, passando como parametros a variavel $cookieName (passada no parametro da função createCookie que é PHPCOOKIE) e $cookieValue que tem o valor gerado acima
   - comecei a criar a função validCookie que irá verificar no banco se ja há um cookie armazenado no browser daquele usario
6. No arquivo login.php criamos um formulario para o usuario entrar na sua conta, pedindo username e senha
   - no script, temos uma função chamada setErrorParam que seta um parametro de erro
     nela temos uma const que em window.location.search retorna a query string da URL atual, e new URLSearchParams() cria um objeto que permite manipular os parametros da query string
     temos uma const que "pega" o parametro "erro" da query string
     no if, verificamos se há uma query string com a chave "erro" e se tiver, adicionamos o texto do valor da chave "erro" na tela (no lugar do <p id="error"> abaixo do formulario) utiliando o getElementById;
     se nao tiver, não é feito nada.
7. No arquivo loginPOST.php fazemos um try-catch igual do arquivo signupPOST.php
   - aqui, no $sql, fazemos um SELECT SQL, onde selecionamos a linha senha da tabela users onde o username seja igual ao username passado pelo usuario no campo do formulário;
   - try-catch -> conectamos ao banco de dados e realizamos a instrução passada para $sql;
       $row = $result->fetch_assoc() -> é utilizado para recuperar uma linha de dados de um resultado de consulta (query) em um banco de dados
         if -> password_verify($senha, $row["senha"] -> verifica se uma senha fornecida ($senha) corresponde a uma senha armazenada no banco de dados (armazenada como hash)
           $user_id = $row["id"] -> recuperamos o id armazenado na linha id da tabela users e armazenamos na variavel $user_id
           chamamos a função createCookie passando como parametros a variavel $user_id (id do usuario da tabela users), $conn (feito dentro do try nesse arquivo) e $cookieName (do arquivo cookies.php)
           então, SE a senha e o usuario estiverem corretas, redirecionamos o usuario para o index.php
         else -> SE NÃO, redirecionamos o usuario para a mesma pagina (a de login) so que com a mensagem de erro "senha ou usuario invalido"
       o catch captura algum tipo de erro que pode acontecer na consulta SQL SELECT e retorna na tela
