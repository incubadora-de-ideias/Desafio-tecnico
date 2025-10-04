 import { Router, Request, Response } from "express";
import { registro, login } from "../controllers/authController.js";
import { authMiddleware } from "../middlewares/authMiddleware.js";

const router = Router();

/**
 * @route   POST /api/auth/register
 * @desc    Registra um novo usuário
 * @access  Público
 */
router.post("/registro", registro);

/**
 * @route   POST /api/auth/login
 * @desc    Faz login e retorna token JWT
 * @access  Público
 */
router.post("/login", login);

/**
 * @route   GET /api/auth/me
 * @desc    Retorna os dados do usuário autenticado (testar token)
 * @access  Protegido
 */
router.get("/me", authMiddleware, (req: Request, res: Response) => {
  const user = (req as any).user; // vem do token decodificado no middleware
  res.status(200).json({
    message: "Token válido! Usuário autenticado com sucesso.",
    user,
  });
});

export default router;
