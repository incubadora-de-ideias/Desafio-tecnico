import json

# Usando uma lista de dicionários para representar os usuários
alunos = [
    {
        "nome": "Alice Silva",
        "email": "alice@gmail.com",
        "senha": "senha123"
    },
    {
        "nome": "Bruno Souza",
        "email": "bruno@gmail.com",
        "senha": "senha456"
    },
    {
        "nome": "Carla Lima",
        "email": "carla@gmail.com",
        "senha": "senha789"
    },
    {
        "nome": "Daniel Costa",
        "email": "daniel@gmail.com",
        "senha": "senha101"
    },
    {
        "nome": "Eva Pereira",
        "email": "eva@gmail.com",
        "senha": "senha102"
    },
    {
        "nome": "Henrique da Silva",
        "email": "henrique@gmail.com",
        "senha": "aluno234"
    },
    {
        "nome": "SIlvano Tonny",
        "email": "silva@mail.com",
        "senha": "aluno678"
    },
    {
        "nome": "Henrique Tony",
        "email": "tony@gmail.com",
        "senha": "aluno567"
    },
    {
        "nome": "Rique Silva",
        "email": "rique@gmail.com",
        "senha": "aluno4567"
    },
    {
        "nome": "Antonio Silva",
        "email": "antiny@gmail.com",
        "senha": "aluno678"
    },
    {
        "nome": "Lena SIlva",
        "email": "lnea@gmail.com",
        "senha": "asdf"
    }
]

for aluno in alunos:
    ficheiro = f'Notas/{aluno['nome'].strip()}.json'
        
    data = [
            {"disciplina": "Matemática", "nota": 0},
            {"disciplina": "Português", "nota": 0},
            {"disciplina": "Ciências", "nota": 0},
            {"disciplina": "História", "nota": 0},
            {"disciplina": "Geografia", "nota": 0}
            ]
    
    with open(ficheiro, "w", encoding='utf-8') as f:
        json.dump(data, f, ensure_ascii=False, indent=4)
        