<?php
session_start();
require_once "conexao.php";

if (isset($_POST['email']) and !empty($_POST['nome'])) { 

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $terminal = mysqli_real_escape_string($conn, $_POST['terminal']);
    $turma = mysqli_real_escape_string($conn, $_POST['turma']);
    $ano = mysqli_real_escape_string($conn, $_POST['ano']);

    $senha = md5('1234');
    $role = "aluno";

    $query = "INSERT INTO usuario set
       nome = '$nome',
       email = '$email',
       senha = '$senha',
       role = '$role',
       endereco = '$endereco',
       terminal = '$terminal'
    ";

    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
       $query1 = "SELECT id FROM usuario WHERE email = '$email'";
       $result = mysqli_query($conn, $query1);

       $row = mysqli_fetch_assoc($result);

       $idUser = $row['id'];

       $query2 = "INSERT INTO aluno set idUser = '$idUser', idAno = '$ano', idTurma = '$turma'";

       $resultado2 = mysqli_query($conn, $query2);

       if ($resultado2) {
        echo (true);
       } else {
        die(header("HTTP/1.0 401 Erro: Ocorreu um erro ao salvar dados"));
       }
    } else {
        die(header("HTTP/1.0 401 Erro: Erro ao validar dados"));
    }


} else {
    die(header("HTTP/1.0 401 Erro: Insira todos os dados necessários"));
}