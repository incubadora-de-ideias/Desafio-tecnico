import mysql from "mysql2/promise";
import dotenv from "dotenv";

dotenv.config();

export const db = mysql.createPool({
    host:process.env.DB_HOST || "localhost",
    user:process.env.DB_USER || "root",
    password:process.env.DB_PASSWORD || "",
    database:process.env.DB_DATABASE ||"TaskFlow",
    port: Number(process.env.DB_PORT) || 3306,
});
db.getConnection()
  .then(() => console.log("✅ Conectado ao MySQL com sucesso!"))
  .catch((err) => console.error("❌ Erro ao conectar ao MySQL:", err));