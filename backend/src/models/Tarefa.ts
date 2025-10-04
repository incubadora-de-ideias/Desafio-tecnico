import { db } from "../config/db";
export interface Tarefa{
    id?: number;
    titulo: string,
    descricao: string;
    status?: "pendente" | "concluida" | "em andamento";
    data_criacao?: Date;
    data_limite?: Date;
    usuario_id: number;
}

export async function  criarTarefa(tarefa: Tarefa): Promise<number> {
    const [result]: any = await db.execute(
        `INSERT INTO tarefas (titulo, descricao, status, data_criacao, data_limite, usuario_id)
     VALUES (?, ?, ?, NOW(), ?, ?)`,
    [
      tarefa.titulo,
      tarefa.descricao,
      tarefa.status || "pendente",
      tarefa.data_limite || null,
      tarefa.usuario_id,
    ]
    );

    return result.insertId;
}

export async function  listaTarefas(usuario_id: number): Promise<Tarefa[]>{
    const [rows]: any = await db.execute(
        `SELECT * FROM tarefas WHERE usuario_id = ?`,
    [usuario_id]
    );

    return rows;
}

export async function atualizarTarefa(tarefa: Tarefa): Promise<void> {
    if(!tarefa.id) throw new Error("ID da tarefas é obrigatório para atualizar");

    await db.execute(
        `UPDATE tarefas 
     SET titulo = ?, descricao = ?, status = ?, data_limite = ?
     WHERE id = ? AND usuario_id = ?`,
    [
      tarefa.titulo,
      tarefa.descricao,
      tarefa.status || "pendente",
      tarefa.data_limite || null,
      tarefa.id,
      tarefa.usuario_id,
    ]
    );
}

export async function deletarTarefa(id: number, usuario_id: number): Promise<void> {
  await db.execute(
    `DELETE FROM tarefas WHERE id = ? AND usuario_id = ?`,
    [id, usuario_id]
  );
}