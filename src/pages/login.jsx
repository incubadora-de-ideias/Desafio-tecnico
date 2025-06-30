import { Link, useNavigate } from "react-router-dom";
import style from "../style/login.module.css";
import { useState } from "react";
import UseUserStore from "../store/store";
import { LoginStorege } from "../store/login";

function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const { setUser } = UseUserStore();
  const navigate = useNavigate();

  const handleLogin = (e) => {
    e.preventDefault();
    const user = LoginStorege.find(
      (user) => user.email === email && user.password === password
    );
    if (user) {
      console.log("Login bem-sucedido:", user);
      const userData = {
        nome: user.nome,
        email: user.email,
        senha: user.senha,
        tipo: user.tipo,
      };
      setUser(userData);
      if (user.tipo === "admin") {
        navigate("/adm");
      }
    } else {
      alert("Login falhou: usuário não encontrado");
    }
  };

  return (
    <div className={style.conteiner}>
      <form onSubmit={handleLogin}>
        <h1>Login</h1>
        <input
          type="email"
          placeholder="Email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />

        <input
          type="password"
          placeholder="Password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
        />
        <button type="submit">Login</button>
      </form>
    </div>
  );
}

export default Login;
