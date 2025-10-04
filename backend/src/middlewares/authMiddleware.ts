import { Request, Response, NextFunction } from "express";
import jwt from "jsonwebtoken";

const JWT_SECRET = process.env.JWT_SECRET || "seu_segredo";

interface JwtPayload {
    id: number;
    email: string;
}

export function authMiddleware(req: Request, res:Response, next: NextFunction){
    const authHeader = req.headers.authorization;

    if(! authHeader || authHeader.startsWith("Bearer ")){
        return res.status(401).json({message: "Acesso negado. Token não fornecido."});
    }

    const token = authHeader.split(" ")[1];

    try {
        const decoded = jwt.verify(token, JWT_SECRET) as JwtPayload;

        (req as any).user = decoded;

        next();
    } catch (error) {
        return res.status(401).json({message: "Token invalido ou expirado."});
    }
}