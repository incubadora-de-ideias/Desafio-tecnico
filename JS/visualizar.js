document.addEventListener("DOMContentLoaded", function() {
    const listaAlunos = document.getElementById("lista-alunos");
    const alunos = JSON.parse(localStorage.getItem("alunos")) || [];

    if (alunos.length === 0) {
        listaAlunos.textContent = "Nenhum aluno cadastrado.";
        return;
    }


    const ul = document.createElement("ul");

    alunos.forEach(aluno => {
        const li = document.createElement("li");
        li.textContent = `Nome: ${aluno.nome} | Turma: ${aluno.turma} | Data de Nascimento: ${aluno.dataNascimento} | Nº Processo: ${aluno.numeroProcesso}`;
        ul.appendChild(li);
    });

    listaAlunos.appendChild(ul);
});