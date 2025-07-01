<?php 

$conn = new mysqli("localhost", "root", "", "cadastroaluno");
if($conn->connect_error){
    die("Erro de conexao: ". $conn->connect_error);
} 

$sql = "SELECT * FROM notas";

$resultado = $conn->query($sql);

if($resultado->num_rows > 0){
    echo "<h2>Notas do Aluno</h2>";
    echo "<table border = '1'>";
    echo "<tr><th>ID</th><th>Disciplina</th><th>Nota</th></tr>";

    while($linha = $resultado->fetch_assoc()){
        echo "<tr>";
        echo "<td>". $linha["id"] . "</td>";
        echo "<td>". $linha["disciplina"]. "</td>";
        echo "<td>". $linha["nota"]. "</td>";
        echo "</tr>";

    }
    echo "</table>";
}else{
    echo "Nenhuma nota encontrada 😐";
}
$conn->close();
?>