
    document.getElementById("loginForm").addEventListener("submit", function(e) {
      e.preventDefault();

      const email = document.getElementById("email").value;
      const senha = document.getElementById("senha").value;
      const msm = document.getElementById("Mensagem");

      if (!email || !senha) {
        msm.textContent = "Por favor, preencha todos os campos.";
        return;
      }

      fetch("http://localhost:3000/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, senha })
      })
      .then(res => res.text())
      .then(msg => alert(msg))
      .catch(err => {
        console.error(err);
        msm.textContent = "cadastrado .";
      });
    });
  