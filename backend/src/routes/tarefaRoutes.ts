import { Router } from "express";

import{
    criarTarefaController,
    listarTarefasController,
    atualizarTarefaController,
    deletarTarefaController
} from "../controllers/taskController";
import { authMiddleware } from "../middlewares/authMiddleware.js";

const router = Router();

router.use(authMiddleware);

router.post("/tarefa", criarTarefaController);

router.get("/tarefa", listarTarefasController);

router.put("/tarefa", atualizarTarefaController);

router.delete("/tarefa", deletarTarefaController);

export default router;