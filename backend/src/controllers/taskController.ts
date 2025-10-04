import { Request, Response } from "express";
import { db } from "../config/db.js";
import { error as err } from "console";

export async function  getTasks(req: Request, res: Response) {
    try {
        const [rows] = await db.query("SEKECT * FROM tarefa");
        res.json(rows);
    } catch (err) {
        res.status(500).json({error: "Erro ao buscar tarefas"});
    }
}

export async function criarTarefa(req: Request, res: Response) {
    const {titulo, descricao} = req.body;
    try {
        const [result] = await db.query(
            "INSERT INTO tarefa (tilulo, descricao) VALUES (?, ?)", [titulo, descricao]
        );
        res.status(201).json({message: "Tarefa criada", id: (result as any).insertId});
    } catch (err) {
        res.status(500).json({error: "Erro ao criar tarefa"})
    }
}