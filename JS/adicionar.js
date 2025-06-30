document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault();

    const nome = document.getElementById("name").value;
    const turma = document.getElementById("turma").value;
    const dataNascimento = document.getElementById("data-nascimento").value;
    const numeroProcesso = document.getElementById("numero-processo").value;
    

    
    const aluno = {
        nome: nome,
        turma: turma,
        dataNascimento: dataNascimento,
        numeroProcesso: numeroProcesso
    }

    let alunos = JSON.parse(localStorage.getItem("alunos")) || [];
    const existe = alunos.some(a => a.numeroProcesso === numeroProcesso);

    if (existe) {
        document.getElementById("mensagem").textContent = "Já existe um aluno com esse número de processo!";
        document.getElementById("mensagem").style.color = "red";
        return;
    }

    alunos.push(aluno);
    localStorage.setItem("alunos", JSON.stringify(alunos));

    document.getElementById("mensagem").textContent = "Aluno adicionado com sucesso!";
    document.getElementById("mensagem").style.color = "black";


    event.target.reset();
});