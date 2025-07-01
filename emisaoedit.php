<form method="post">
    <input type="text" name="diciplina" placeholder="Insira a disciplina"><br>
    <input type="text" name="nota" placeholder="Insira a nota">
</form>

<?php 

$conn = new mysqli("localhost", "root", "", "cadastroaluno");
if($conn->connect_error){
    die("Erro de conexao: ". $conn->connect_error);
}


?>