# Desafio Técnico – Sistema de Gestão Escolar com Permissões por Tela

## 🎯 Objetivo do Desafio

Desenvolver um sistema simples de gestão escolar com controle de acesso por permissões e com sistema de autenticação obrigatório. Este sistema irá simular um ambiente educacional onde apenas usuários autorizados podem visualizar ou interagir com determinadas funcionalidades.

---

## 📚 Funcionalidades Esperadas

### 🔐 Autenticação (Obrigatória)
- Login com email e senha.
- Apenas usuários autenticados podem acessar o sistema.
- Exibição dinâmica de menus conforme permissões do usuário.

### 🖥 Telas do Sistema
- **Cadastro de Alunos**  
  Adicionar, visualizar e editar dados de alunos.

- **Lançamento de Notas**  
  Atribuir notas a alunos por disciplina.

- **Emissão de Boletim**  
  Visualizar boletins com as notas dos alunos.

- **Gestão de Usuários (Apenas administradores)**  
  Criar/editar/remover usuários.  
  Gerenciar permissões por tela de cada usuário.

---

## 👥 Tipos de Usuário

- **Administrador**
  - Acesso total a todas as funcionalidades.
  - Pode atribuir ou revogar permissões a qualquer usuário.

- **Usuário Comum**
  - Acesso restrito apenas às telas permitidas pelo administrador.

---

## ⚙️ Requisitos Técnicos

- Interface gráfica mínima (Tkinter, HTML/JS ou similar).
- Persistência de dados via JSON ou SQLite.
- Telas e menus devem respeitar as permissões definidas.
- O que for feito deve funcionar corretamente, ainda que o sistema esteja parcial.

---

## 💡 Nota Importante

Embora os requisitos acima sirvam como base, o candidato tem total liberdade para aplicar boas práticas, padrões de projeto, bibliotecas ou recursos adicionais que considere adequados.

> **O objetivo principal é demonstrar criatividade, lógica, organização e capacidade de construir uma solução funcional e segura, mesmo que use elementos além dos mencionados neste enunciado.**
