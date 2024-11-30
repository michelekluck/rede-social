<?php
require_once ('bd/connect.php'); 

global $conn;
global $cookieName;
$cookieName = "PHPCOOKIE";

// $user_id = mesmo id do users.id
// $conn = conexão com o banco de dados
// $cookieName = nome do cookie que será passado para o browser
function createCookie(int $user_id, mysqli $conn,string $cookieName) {
    $cookieValue = md5(rand());
    $sql = "INSERT INTO cookies (`user_id`, `value`) VALUES ('$user_id', '$cookieValue')";

    $conn->query($sql);
    setcookie (  // guardei o valor no browser
        $cookieName,
        $cookieValue, 
        time() + (86400 * 30), // expires_or_options
        "/", // $path
        "", // $domain
        false, //$secure -  fora do localhost seria true
        true // $httponly
    );
}

function validCookie(string $cookieName, mysqli $conn) {
    if(!isset($_COOKIE[$cookieName])) {
        return;
    } 
    $cookieValue = $_COOKIE[$cookieName];

    $sql = "SELECT value FROM cookies WHERE value = '$cookieValue'";
    $result = $conn->query($sql);

    if($result && $result->num_rows > 0) {
        header('location: index.php');
        
        exit();
    }
}

function deleteCookie(string $cookieName, mysqli $conn) {
    if(!isset($_COOKIE[$cookieName])) {
        return false;
    }

    $cookieValue = $_COOKIE[$cookieName];

    $sql = "DELETE from cookies WHERE value = '$cookieValue'";
    
    return $conn->query($sql);

}

function setUserSession(string $cookieName, mysqli $conn) {
    if (isset($_SESSION['user_id']) || ($_SESSION['username'])) {
        return;
    }
    $cookieValue = $_COOKIE[$cookieName];

    $sql = "SELECT cookies.id as cookie_id, users.id as user_id, users.username as username from cookies inner join users on cookies.user_id = users.id WHERE cookies.value = $cookieValue";
    $result =  $conn->query($sql);
    $row = $result->fetch_assoc();

    $user_id = $row['user_id'];
    $username = $row['username'];

    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;    
}