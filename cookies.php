<?php
require 'bd/connect.php';

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

function validCookie(string $cookieName){
    if (!isset($COOKIE[$cookieName])) {
        return false;
    } 
    $sql = "SELECT "
}
