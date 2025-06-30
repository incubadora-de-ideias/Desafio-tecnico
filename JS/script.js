function cadastrar(event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const senha = document.getElementById("senha").value;
    const mensagem = document.getElementById("mensagem");

    if (!email || !senha) {
        mensagem.textContent = "Preencha email e senha para cadastrar.";
        mensagem.style.color = "white";
        return;
    }

    localStorage.setItem("usuarioEmail", email);
    localStorage.setItem("usuarioSenha", senha);
    mensagem.textContent = "Cadastro realizado!";
    mensagem.style.color = "lightgreen";
}

function login(event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const senha = document.getElementById("senha").value;
    const mensagem = document.getElementById("mensagem");

    const emailSalvo = localStorage.getItem("usuarioEmail");
    const senhaSalva = localStorage.getItem("usuarioSenha");

    if (email === emailSalvo && senha === senhaSalva) {
        mensagem.textContent = "Login bem-sucedido!";
        mensagem.style.color = "lightgreen";
        localStorage.setItem("autenticado", "true");
        window.location.href = "main.html";
    } else {
        mensagem.textContent = "Email ou senha incorretos.";
        mensagem.style.color = "white";
    }
}

document.getElementById("login").addEventListener("click", login);
document.getElementById("cadastrar").addEventListener("click", cadastrar);

