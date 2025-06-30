import React from 'react';

const NotaTable = ({ alunos }) => {
    return (
        <table>
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                {alunos && alunos.length > 0 ? (
                    alunos.map((aluno, index) => (
                        <tr key={index}>
                            <td>{aluno.nome}</td>
                            <td>{aluno.nota}</td>
                        </tr>
                    ))
                ) : (
                    <tr>
                        <td colSpan="2">Nenhum aluno cadastrado.</td>
                    </tr>
                )}
            </tbody>
        </table>
    );
};

// Exemplo de uso do componente
const alunosExemplo = [
    { nome: 'João Silva', nota: 8.5 },
    { nome: 'Maria Souza', nota: 9.0 },
];

export default function Nota() {
    return (
        <div>
            <h2>Notas dos Alunos</h2>
            <NotaTable alunos={alunosExemplo} />
        </div>
    );
}