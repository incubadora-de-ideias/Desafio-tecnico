import React from "react";
import {
  Route,
  BrowserRouter,
  Routes,
  Navigate,
} from "react-router-dom";
import User from "../pages/user";
import Login from "../pages/login";
import Adm from "../pages/adm";
import Nota from "../pages/nota";
import UseUserStore from "../store/store";
import Aluno from "../pages/alunos";
import Emissao from "../pages/emisao";

// Simulação de autenticação (substitua pela sua lógica real)
const isAuthenticated = () => {
  return UseUserStore.getState().isLoggedIn();
};

const PrivateRoute = ({ children }) => {
  const user = UseUserStore.getState().user;
  if (!user) {
    return <Navigate to="/login" />;
  }

  const path = window.location.pathname;
  if (path.startsWith("/adm") && user.tipo !== "admin") {
    return <Navigate to="/login" />;
  }
  if (path.startsWith("/user") && user.tipo !== "user") {
    return <Navigate to="/login" />;
  }
  return isAuthenticated() ? children : Navigate({ to: "/login" });
};

const AuthRedirect = () => {
  if (isAuthenticated()) {
    const userType = UseUserStore.getState().user?.tipo;
    console.log("userType:", userType);
    if (userType === "admin") {
      return Navigate({ to: "/adm" });
    } else if (userType === "user") {
      return Navigate({ to: "/user" });
    }
  }
  return Navigate({ to: "/login" });
};

const AppRoutes = () => (
  <BrowserRouter>
    <Routes>
      <Route path="/" element={<AuthRedirect />} />
      <Route path="/login" element={<Login />} />
      <Route path="/aluno" element={<Aluno />} />
      <Route path="/nota" element={<Nota />} />
      <Route path="/emisao" element={<Emissao />} />
      <Route
        path="/adm"
        element={
          <PrivateRoute>
            <Adm />
          </PrivateRoute>
        }
      />
      <Route
        path="/user"
        element={
          <PrivateRoute>
            <User />
          </PrivateRoute>
        }
      />
    </Routes>
  </BrowserRouter>
);

export default AppRoutes;
