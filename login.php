<?php 
session_start();
$conn = new mysqli("localhost", "root", "", "cadastroaluno");
if($conn->connect_error){
    die("Erro de conexao: ". $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT senha FROM aluno WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if($resultado->num_rows > 0){
    $row = $resultado->fetch_assoc();
    $senha_cripto = $row['senha'];

    if (password_verify($senha, $senha_cripto)) {
        $_SESSION["usuario"] = $email;
        header("Location: area.php");
        exit();
    }else{
        echo "Senha incorreta. Verifique os dados inseridos.";
    }
}else{
    echo "email nao encontrado.";
}

$stmt->close();
$conn->close();

?>