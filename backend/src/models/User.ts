import { db } from "../config/db.js";

export interface Usuario {
    id?: number;
    nome: string;
    email: string;
    senha: string;
}

export async function criarUsuario(user: Usuario): Promise<number> {
    const [result]: any = await db.query(
        "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)", [user.nome, user.email, user.senha]
    );
    return result.insertId;
}

export async function findUserByEmail(email: string): Promise<Usuario | null> {
    const [rows]: any = await db.query(
        "SELECT * FROM usuario WHERE email = ?", [email]
    );

    if(rows.length > 0){
        return rows[0] as Usuario;
    }
    return null
}

export async function findUserById(id: number): Promise<Usuario | null> {
    const [rows]: any = await db.query(
        "SELECT * FROM usuario WHERE id = ?", [id]
    );

    if(rows.length > 0){
        return rows[0] as Usuario;
    }
    return null
}