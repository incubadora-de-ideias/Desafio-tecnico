<?php
session_start();
require_once "conexao.php";

if (isset($_POST['email']) and !empty($_POST['senha'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $query = "SELECT * FROM usuario where email = '$email' and senha = md5('$senha')";

    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) > 0) {
       $rows = mysqli_fetch_assoc($resultado);

       $_SESSION['usuario'] = $rows['email'];
       $_SESSION['nome'] = $rows['nome'];
       $_SESSION['role'] = $rows['role'];

       echo (true);
    } else {
        echo (false);
        die(header("HTTP/1.0 401 Erro: E-mail ou senha incorrectos"));
    }

} else {
    die(header("HTTP/1.0 401 Erro ao verificar dados"));
}