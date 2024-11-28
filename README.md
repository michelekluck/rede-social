O que foi feito até agora (24/11):
1. Criamos o banco de dados no utilizando os comandos do arquivo redeSocial.sql;<br>
2. Conectamos ao banco de dados no arquivo connect.php<br>
3. No arquivo signup.php está o formulário de inscrição, o form action direcionando para o arquivo signuPOST.php;<br>
4. No arquivo signupPOST.php inserimos o conteudo do arquivo connect.php;<br>
   - Guardamos em variaveis os dados que o usuario digitar em username, email e senha;<br>
   - Try-catch -> o mysqli_report configura como o mysqli deve lidar com os erros. As flags MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT intrui o mysqli a lançar<br> exceções quando um erro acontecer;<br>
     O bloco tenta criar uma conexão ao banco de dados;<br>
     Se algum erro acontecer uma exceção é lançada e capturada no catch<br>
     O objeto $e no catch contém detalhes sobre o erro.<br>
   - Criamos um hash seguro da senha do usuario antes de armazenar no banco de dados, utilizando a função password_hash;<br>
   - em $sql damos uma instrução SQL para inserir dados na tabela users no banco de dados, usando os valores armazenados nas variaveis $username, $email e $hash_password;<br>
   - Try-catch -> Tenta executar o INSERT SQL da variavel $sql e captura qualquer erro que pode ocorrer;<br>
     $conn->query($sql) = $conn é a variavel que representa a conexão com o banco de dados;<br>
       query() é o método da classe mysqli usado para executar instruções SQL<br>
       $sql é uma string contendo o comando SQL a ser executado<br>
     Se houver um erro (como tabela inexistente ou valores invalidos) uma exceção é lançada e capturada no catch;<br>
     O objeto $e contem detalhes sobre o erro<br>
5. No arquivo cookies.php estou criando funções para criar, validar e excluir cookies;<br>
   - criamos duas variaveis globais chamadas $conn e $cookieName = "PHPCOOKIE"<br>
   - a função createCookie, cria cookies(usuarios logando pela primeira vez) e tem como parametros 3 variaveis, $user_id (que remete ao id do usuario), $conn (que remete a conexão com o banco de dados) e $cookieName (nome do cookie)<br>
     dentro da função geramos um valor aletorio e unico utilizando a função md5(rand()) e guardamos na variavel $cookieValue;<br>
     em $sql armazenamos uma instrução INSERT SQL, onde irá inserir na tabela cookies, nos campos user_id e value os valores armazenados na variaveis $user_id e $cookieValue (valor gerado na linha acima)<br>
     conectamos ao banco de dados e setamos o cookie com a função setcookie, passando como parametros a variavel $cookieName (passada no parametro da função createCookie que é PHPCOOKIE) e $cookieValue que tem o valor gerado acima<br>
   - comecei a criar a função validCookie que irá verificar no banco se ja há um cookie armazenado no browser daquele usario<br>
6. No arquivo login.php criamos um formulario para o usuario entrar na sua conta, pedindo username e senha<br>
   - no script, temos uma função chamada setErrorParam que seta um parametro de erro<br>
     nela temos uma const que em window.location.search retorna a query string da URL atual, e new URLSearchParams() cria um objeto que permite manipular os parametros da query string<br>
     temos uma const que "pega" o parametro "erro" da query string<br>
     no if, verificamos se há uma query string com a chave "erro" e se tiver, adicionamos o texto do valor da chave "erro" na tela (no lugar do <p id="error"> abaixo do formulario) utiliando o getElementById;<br>
     se nao tiver, não é feito nada.<br>
7. No arquivo loginPOST.php fazemos um try-catch igual do arquivo signupPOST.php<br>
   - aqui, no $sql, fazemos um SELECT SQL, onde selecionamos a linha senha da tabela users onde o username seja igual ao username passado pelo usuario no campo do formulário;<br>
   - try-catch -> conectamos ao banco de dados e realizamos a instrução passada para $sql;<br>
       $row = $result->fetch_assoc() -> é utilizado para recuperar uma linha de dados de um resultado de consulta (query) em um banco de dados<br>
         if -> password_verify($senha, $row["senha"] -> verifica se uma senha fornecida ($senha) corresponde a uma senha armazenada no banco de dados (armazenada como hash)<br>
           $user_id = $row["id"] -> recuperamos o id armazenado na linha id da tabela users e armazenamos na variavel $user_id<br>
           chamamos a função createCookie passando como parametros a variavel $user_id (id do usuario da tabela users), $conn (feito dentro do try nesse arquivo) e $cookieName (do arquivo cookies.php)<br>
           então, SE a senha e o usuario estiverem corretas, redirecionamos o usuario para o index.php<br>
         else -> SE NÃO, redirecionamos o usuario para a mesma pagina (a de login) so que com a mensagem de erro "senha ou usuario invalido"<br>
       o catch captura algum tipo de erro que pode acontecer na consulta SQL SELECT e retorna na tela<br>
<br>
O que foi feito até agora (25/11):<br>
- No arquivo cookies.php criei a função validCookie que irá verificar a existencia de cookie do browser do usuario para, caso sim, seja feito um "login automatico" que direciona o usuario para o index.php e caso nao, não faz nada.<br>
  linha 28. verificamos se existe um cookie com o nome do nosso cookie, no caso pegando o valor do primeiro parametro da função -> $cookieName<br>
  linha 29. damos um return para que nada aconteça<br>
  linha 31. atribui o valor de $cookieName na variavel $cookieValue<br>
  linha 33. fazemos uma instrução SQL para que seja selecionado o campo valor da tabela cookies onde o campo value seja igual ao $cookieValue definido acima<br>
  linha 34. realizamos a instrução no banco de dados<br>
  linha 36. verificamos se o resultado da instrução é verdadeiro ($result irá retornar true se a consulta for bem sucedida) e se o $result retornar alguma coisa do banco (ou seja, encontrar um value que seja igual $cookieValue)<br>
  linha 37. se for encontrado, redirecionamos o usuario para o index.php<br>
  linha 38. terminamos a execução do script após o redirecionamento<br>
  linha 39. caso nenhum valor for encontrado, nada é feito.<br>
- No arquvo login.php foi adicionado uma tag PHP e nela fazemos o conexão com o banco de dados (igual nas outras paginas)
  antes mesmo do formulario, eu chamo a função validCookie, passando como parametro a variavel $cookieName (seu valor esta no <br>arquivo cookies.php) e $conn que tem o valor atribuido na linha 17<br>
  Assim, antes mesmo de aparecer a tela de login, o usuario anteriormente logado irá ser redirecionado para a tela principal<br>
<br>
O que foi feito até agora (26/11): <br>
- No arquivo cookies.php criei a função deleteCookie que deleta o cookie assim que o usuário sai (desloga) do site.<br>
  A função tem como os mesmos parametros da função validCookie, que são $cookieName (aqui apenas um parametro vazio, o valor será passado depois, quando chamar a função) e $conn<br>
  linha 45. verificamos se o cookie com nome $cookieName (passada ao chamar a função) existe no array de cookies passado pelo navegador, nesse caso como, fazemos a verificação com !isset que verifica se o cookie NAO EXISTE, e se o cookie nao for encontrado é retornado o false (nesse caso não há nada para deleter)<br>
  linha 49. guardamos o valor relativo ao nome $cookieName na variavel $cookieValue<br>
  linha 51. guardamos uma instrução sql na variavel $sql, essa instrução faz um delete da tabela cookie em que a linha value seja igual ao valor da variavel $cookieValue<br>
  linha 53. se $_COOKIE encontrar $cookieName no array de cookies passados pelo navegador, executamos a query (instrução) do sql armazenado na variavel $sql<br>
- No arquivo login.php fiz conexão com o bd assim como nas outras paginas<br>
  linha 41. adicionei um link "?action=logout" que direciona o usuario para a propria pagina (index.php) mas com a query string ou seja a URL ficará assim: "localhost/rede-social/index.php?action=logout<br>
  linha 25. é feita uma verificação se a pagina atual (url) tem a palavra 'action' como parametro e tambem, se tiver, compara o valor do parametro 'action' com a string 'logout'<br>
  linha 26. chamamos a função setCookie que é usada para definir cookies no PHP, e a usamos para apagar os cookies, passamos como parametro o nome do cookie, o value pode ser vazio (porque vamos apagar) e como time (expiração do cookie) colocamos -3600 (ou seja, um dia antes), então assim, fazemos o cookie expirar o passado - isso faz com que ele seja apagado do navegador imediatamente<br>
  linha 28. criamos uma variavel para armazenar a função deleteCookie, e o valor que será retornado indicará se o cookie foi apagado ou não, assim como definimos dentro da função, no arquivo cookies.php (caso o cookie exista, ele apaga, caso nao, retorna false)<br>
  linha 30. verificamos se a variavel $isDeleted retorna true, se sim (foi deletado):<br>
  linha 31. redirecionamos o usuario para a pagina login.ph<br>
  linha 32. interrompemos a execução do script<br>
  linha 33, 34. caso a função retorne false (ou seja, nã́o foi encontrado o cookie e nao foi deletado) retornamos uma mensagem de erro.<br>
O que foi feito até agora (27/11):<br>
- No arquivo connect.php criamos uma classe chamada PostsRepository que tem como atributo a variavel $conn (que conecta ao banco de dados)<br>
  linha 25.Criamos um contrutor dessa classe para que quando instanciarmos essa classe garantimos que receberemos a conexão com o banco;<br>
  linha 30.Dentro da classe temos a função create que cria um novo post, nela temos como parametro $content e user $user_id que ainda nao foram definidos valor em lugar nenhum <br>
  linha 31. adicionamos uma instrução insert sql dentro de uma função chamada $sql<br>
  linha 32. $this->conn->query($sql) é a mesma coisa que $conn->query($sql) porém em vez de pegar o o conteudo a variavel $conn, estamos pegando do atributo da classe e depois executando a instrução no bd<br>
  linha 35. criamos a função delete, que tem por objetivo deletar um post, nela passamos o parametro post_id, que é por ele que iremos identificar qual post excluir;<br>
  linha 35. escrevemos a instrução delete sql<br>
  linha 37. executamos a instrução<br>
  linha 40. criamos uma função chamada getAll() que tem como objetivo retornar todos os posts no index para o usuario<br>
  linha 41. escrevemos a instrução sql select;<br>
  linha 42. atribuimos a execução da instrução do sql na variavel $result, ou seja, quando essa variavel for chamada, a instrução é executada<br>
  linha 44. criamos um array vazio e guardamos na variavel $posts, esse array vai fazer exatamente o que a variavel chama: criar um array de posts<br>
  linha 46. precisamos criar um loop while para que o seja percorrida cada linha do array. o fetch_assoc() pega os dados do db e transforma em um array associativo (com chave-valor) - percorremos cada linha desse array<br>
  linha 48. pegamos só o que precisamos do array do fetch_assoc(), e passamos para ele quais são, como a linha "id", "content" e "user_id" - guardamos isso em uma variavel chamada $post, porque cada linha é equivalente a um post<br>
  linha 50. adicionamos as linhas $post dentro do array $posts<br>
  linha 53. retornamos o array $posts<br>
  linha 20. criamos uma instancia da classe PostsRepository e passamos a conexão com o banco de dados usando a variavel $conn (parametro) - guardamos essa instancia em uma variavel global chamada $postsRepository que pode ser chamada em qualquer arquivo que faça um require do arquivo connect.php<br>
- No arquivo index.php adicionamos um foreach que vai percorrer cada elemento do array $posts retornado pelo getAll()<br>
  linha 39. pegamos apenas a chave "content" do array posts e guardamos o valor na variavel $content<br>
  linha 40. mostramos na tela o $content, ou seja, cada linha do array $posts

