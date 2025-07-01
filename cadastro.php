<?php

$conn = new mysqli("localhost", "root", "", "cadastroaluno");
if($conn->connect_error){
    die("Erro de conexao: ". $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO aluno (nome, email, senha) VALUES ('$nome', '$email', '$senha_cripto')";

if($conn->query($sql) === true){
    echo "Aluno cadastrado com sucesso :) ";
}else{
    echo "Erro: ". $conn->error;
}
$conn->close();
?>