<?php

function contaValida($username, $password) {
    $link = mysqli_connect("localhost", "root", "", "sist");

    // Evitar SQL Injection — segurança mínima
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);

    $sql = "SELECT * FROM conta WHERE username = '$username' AND password = MD5('$password')";
    $result = mysqli_query($link, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row; // Retorna dados do usuário
    }

    return false;
}

function registraConta($userData) {
    session_start();
    session_unset();

    $_SESSION["user_id"] = $userData["id"];
    $_SESSION["is_admin"] = $userData["is_admin"];
}

function logout() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ./login.php");
    exit;
}

function validaSessao() {
    session_start();
    if (empty($_SESSION["user_id"])) {
        header("Location: ./login.php");
        exit;
    }
}
?>
