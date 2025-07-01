<?php 

$conn = new mysqli("localhost", "root", "", "cadastroaluno");
if($conn->connect_error){
    die("Erro de conexao: ". $conn->connect_error);
}

$sql = "SELECT * FROM aluno";

$resultado = $conn->query($sql);

if($resultado->num_rows > 0){
    echo "<h2>Lista dos alunos cadastrados </h2>";
    echo "<table border = '1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>E-mail</th></tr>";

    while($linha = $resultado->fetch_assoc()){
        echo "<tr>";
        echo "<td>". $linha["id"] . "</td>";
        echo "<td>". $linha["nome"]. "</td>";
        echo "<td>". $linha["email"]. "</td>";
        echo "</tr>";

    }
    echo "</table>";
}else{
    echo "nenhum aluno cadastrado";
}
$conn->close();
?>

<h3>Remover Aluno</h3>
<form action="" method="post">
    <input type="number" name="id" placeholder="Insira o id do aluno" required><br>
    <button type="submit">Remover</button>
</form>
<?php 

$conn = new mysqli("localhost", "root", "", "cadastroaluno");
if($conn->connect_error){
    die("Erro de conexao: ". $conn->connect_error);
}

$id = $_POST["id"];

$sql = "DELETE FROM aluno WHERE id = ". (int)$id;

if($conn->query($sql) === true){
    echo "Apagado com sucesso :) ";
}else{
    echo "Erro: ".$conn->error;
}

$conn->close();
?>