<?php
    global $host;
    global $db_username;
    global $password;
    global $database;
    global $postsRepository;

    $host = "localhost:3306";
    $db_username = "root";
    $password = "";
    $database = "redeSocial";

    try {
        $conn = new mysqli($host, $db_username, $password, $database);
    }
    catch(Exception $e) {
        die("<strong> Falha de conexão: </strong>" . $e);
    }

    $postsRepository = new PostsRepository($conn); // esse $conn se refere a variável acima (que faz conexão com o banco de dados)

    class PostsRepository {
        private mysqli $conn ;
    
        public function __construct(mysqli $conn)
        {
            $this->conn=$conn;
        }
    
        function create(string $content, int $user_id) {
            $sql = "INSERT INTO posts (`content`, `user_id`) VALUES ('$content', '$user_id')";
            $this->conn->query($sql);
        }
    
        function delete(int $post_id) {
            $sql = "DELETE FROM posts WHERE id = '$post_id'";
            $this->conn->query($sql);
        } 

        function update(int $post_id, string $content) {
            $sql = "UPDATE posts SET content = '$content' WHERE id = '$post_id'";
            $this->conn->query($sql);
        }
    
        function getAll() {
            $sql = "SELECT id, content, user_id FROM posts ORDER BY id DESC";
            $result = $this->conn->query($sql);
            // cria um array vazio de posts
            $posts = array();
            // enquanto houver linhas no $result, será criada uma linha no array de posts
            while ($row = $result->fetch_assoc()) {
                // cria um array de um post com o valor da linha atual
                $post = array("id"=>$row["id"], "content"=>$row["content"], "user_id"=>$row["user_id"]);
                //adiciona um post unico em uma lista de todos os posts
                array_push($posts, $post);
            } 
            // retorna a lista com todos os posts
            return $posts; 
        }
    }

// UsersRepository
// LikesRepository
// CookiesRepository
?>