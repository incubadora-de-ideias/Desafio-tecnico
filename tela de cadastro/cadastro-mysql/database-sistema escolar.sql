
create database Sistema_gestao;
USE Sistema_gestao;

CREATE TABLE alunos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100),
  idade INT,
  sexo VARCHAR(20),
  nascimento DATE,
  processo VARCHAR(50)
);
INSERT INTO Sistema_gestao (nome, idade, sexo,nascimento,processo)
VALUES ('', '', '');
