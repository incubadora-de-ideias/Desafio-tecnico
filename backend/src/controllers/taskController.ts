import { Request, Response } from "express";
import {
    criarTarefa,
    listaTarefas,
    atualizarTarefa,
    deletarTarefa,
    Tarefa
} from "../models/Tarefa.js"

export async function criarTarefaController(req: Request, res: Response){
    try {
        const usuario_id = (req as any).user.id;
        const {titulo, descricao, status, data_limite} = req.body;

        if(!titulo || !descricao){
            return res.status(400).json({erro: "Título e descrição são obrigatórios."})
        }

        const tarefa: Tarefa = {
            titulo,
            descricao,
            status,
            data_limite,
            usuario_id,
        };

        const id = await criarTarefa(tarefa);
        res.status(201).json({mensagem: "Tarefa Criada com sucesso :)", id})
    } catch (erro:any) {
        console.error("Erro ao criar tarefas:", erro);
        res.status(500).json({erro: "Erro interno ao criar tarefa."})
    }
}

export async function listarTarefasController(req: Request, res: Response) {
  try {
    const usuario_id = (req as any).user.id;
    const tarefas = await listaTarefas(usuario_id);
    res.status(200).json(tarefas);
  } catch (erro: any) {
    console.error("Erro ao listar tarefas:", erro);
    res.status(500).json({ erro: "Erro interno ao listar tarefas." });
  }
}

export async function atualizarTarefaController(req: Request, res: Response) {
  try {
    const usuario_id = (req as any).user.id;
    const { id } = req.params;
    const { titulo, descricao, status, data_limite } = req.body;

    if (!id) {
      return res.status(400).json({ erro: "ID da tarefa é obrigatório." });
    }

    const tarefa: Tarefa = {
      id: Number(id),
      titulo,
      descricao,
      status,
      data_limite,
      usuario_id,
    };

    await atualizarTarefa(tarefa);
    res.status(200).json({ mensagem: "Tarefa atualizada com sucesso!" });
  } catch (erro: any) {
    console.error("Erro ao atualizar tarefa:", erro);
    res.status(500).json({ erro: "Erro interno ao atualizar tarefa." });
  }
}

export async function deletarTarefaController(req: Request, res: Response) {
  try {
    const usuario_id = (req as any).user.id;
    const { id } = req.params;

    if (!id) {
      return res.status(400).json({ erro: "ID da tarefa é obrigatório." });
    }

    await deletarTarefa(Number(id), usuario_id);
    res.status(200).json({ mensagem: "Tarefa excluída com sucesso!" });
  } catch (erro: any) {
    console.error("Erro ao deletar tarefa:", erro);
    res.status(500).json({ erro: "Erro interno ao deletar tarefa." });
  }
}