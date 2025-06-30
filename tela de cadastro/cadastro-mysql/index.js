  document.getElementById("signupForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const dados = {
      nome: document.getElementById("nome").value,
      idade: document.getElementById("idade").value,
      sexo: document.getElementById("sexo").value,
      nascimento: document.getElementById("dataNascimento").value,
      processo: document.getElementById("processo").value
    };

    console.log("Dados cadastrados:", dados);
    alert("Cadastro realizado com sucesso!");

    this.reset();
  });
