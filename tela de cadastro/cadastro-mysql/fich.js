const express = require("express");
const mysql = require("mysql");
const bodyParser = require("body-parser");
const path = require("path");

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static("public"));

const db = mysql.createConnection({
  host: "localhost:3306",
  user: "seu_usuario",
  password: "erivaldo123",
  database: "Sistema_gestao"
});

db.connect(err => {
  if (err) throw err;
  console.log("Conectado ao banco de dados MySQL!");
});

app.post("/cadastrar", (req, res) => {
  const { nome, idade, sexo, dataNascimento, processo } = req.body;
  
    
  db.query(sql, [nome, idade, sexo, dataNascimento, processo], (err) => {
    if (err) {
      console.error(err);
      return res.status(500).send("Erro ao salvar cadastro.");
    }
    res.send("Cadastro realizado com sucesso!");
  });
});

app.listen(3000, () => {
  console.log("Servidor rodando na porta 3000");
});