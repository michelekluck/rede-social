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

O que foi feito até agora (25/11):
- No arquivo cookies.php criei a função validCookie que irá verificar a existencia de cookie do browser do usuario para, caso sim, seja feito um "login automatico" que direciona o usuario para o index.php e caso nao, não faz nada.
  linha 28. verificamos se existe um cookie com o nome do nosso cookie, no caso pegando o valor do primeiro parametro da função -> $cookieName
  linha 29. damos um return para que nada aconteça
  linha 31. atribui o valor de $cookieName na variavel $cookieValue
  linha 33. fazemos uma instrução SQL para que seja selecionado o campo valor da tabela cookies onde o campo value seja igual ao $cookieValue definido acima
  linha 34. realizamos a instrução no banco de dados
  linha 36. verificamos se o resultado da instrução é verdadeiro ($result irá retornar true se a consulta for bem sucedida) e se o $result retornar alguma coisa do banco (ou seja, encontrar um value que seja igual $cookieValue)
  linha 37. se for encontrado, redirecionamos o usuario para o index.php
  linha 38. terminamos a execução do script após o redirecionamento
  linha 39. caso nenhum valor for encontrado, nada é feito.
- No arquvo login.php foi adicionado uma tag PHP e nela fazemos o conexão com o banco de dados (igual nas outras paginas)
  antes mesmo do formulario, eu chamo a função validCookie, passando como parametro a variavel $cookieName (seu valor esta no arquivo cookies.php) e $conn que tem o valor atribuido na linha 17
  Assim, antes mesmo de aparecer a tela de login, o usuario anteriormente logado irá ser redirecionado para a tela principal
  
