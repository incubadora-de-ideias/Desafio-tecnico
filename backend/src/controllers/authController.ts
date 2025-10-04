import { Request, Response } from "express";
import bcrypt from "bcryptjs";
import jwt from "jsonwebtoken";
import { criarUsuario, findUserByEmail, Usuario } from "../models/User.js";

const JWT_SECRET = process.env.JWT_SECRET || "seu_segredo";

export async function registro(req: Request, res: Response) {
  try {
    const { nome, email, senha } = req.body;

    const usuarioExiste = await findUserByEmail(email);
    if (usuarioExiste) {
      return res.status(400).json({ message: "Email já está em uso!" });
    }

    const salt = await bcrypt.genSalt(10);
    const passwordCriptografada = await bcrypt.hash(senha, salt);

    const novoUsuario: Usuario = {
      nome,
      email,
      senha: passwordCriptografada,
    };

    const userId = await criarUsuario(novoUsuario);

    return res
      .status(201)
      .json({ message: "Usuário registrado com sucesso!", userId });
  } catch (error) {
    console.error(error);
    return res.status(500).json({ message: "Erro no servidor." });
  }
}

export async function login(req: Request, res: Response) {
  try {
    const { email, senha } = req.body;

    const user = await findUserByEmail(email);
    if (!user) {
      return res.status(400).json({ message: "Email ou senha inválidos!" });
    }

    const comparar = await bcrypt.compare(senha, user.senha);
    if (!comparar) {
      return res.status(400).json({ message: "Email ou senha inválidos!" });
    }

    const token = jwt.sign(
      { id: user.id, email: user.email },
      JWT_SECRET,
      { expiresIn: "1h" }
    );

    return res.status(200).json({
      message: "Login realizado com sucesso!",
      token,
    });
  } catch (error) {
    console.error(error);
    return res.status(500).json({ message: "Erro no servidor." });
  }
}
