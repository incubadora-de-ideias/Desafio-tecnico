using Microsoft.EntityFrameworkCore;
using WebApplication1.Context;
using WebApplication1.DTOs;
using WebApplication1.Interfaces;
using WebApplication1.Models;

namespace WebApplication1.Repositories
{
    public class NotaRepository : BaseRepository<Nota>, INotaRepository
    {
        public NotaRepository(AppDbContext context) : base(context)
        {
        }

        private bool ValidadeUserAndDisciplina(NotaDTO nota)
        {
            if(_context.Users.Any(a => a.Id == nota.AlunoId) &&
               _context.Disciplinas.Any(d => d.Id == nota.DisciplinaId) &&
               nota.Valor >= 0)
            {
                return true; // Aluno and Disciplina exist, and Valor is valid
            }
            return false; // Either Aluno or Disciplina does not exist, or Valor is invalid
        }
        public async Task<Nota> CreateNotaAsync(NotaDTO nota)
        {
            if (!this.ValidadeUserAndDisciplina(nota))
            {
                return null!; // Return null if validation fails
            }
            var Nota = new Nota
            {
                AlunoId = nota.AlunoId,
                DisciplinaId = nota.DisciplinaId,
                Valor = nota.Valor
            };
            return await base.CreateAsync(Nota);
        }

        public async Task<ICollection<UserNotaDisciplinaDTO>> GetNotasByAlunoIdAndDisciplinaIdAsync(int alunoId, int disciplinaId)
        {
            return await _context.Notas
                .Include(n => n.Aluno) 
                .Include(n => n.Disciplina)
                .Where(n => n.AlunoId == alunoId && n.DisciplinaId == disciplinaId)
                .Select(n => new UserNotaDisciplinaDTO
                {
                    UserId = n.AlunoId,
                    DisciplinaNome= n.Disciplina.Name,
                    Nota = n.Valor,
                    UserName = n.Aluno.Name

                })
                .ToListAsync();
        }

        public async Task<ICollection<UserNotaDisciplinaDTO>> GetNotasByAlunoIdAsync(int alunoId)
        {
            //pegando todas as notas do aluno
            return await _context.Notas
                .Include(n => n.Aluno) // Incluindo o Aluno relacionado
                .Include(n => n.Disciplina) // Incluindo a Disciplina relacionada
                .Where(n => n.AlunoId == alunoId)
                .Select(n => new UserNotaDisciplinaDTO
                {
                    UserId = n.AlunoId,
                    DisciplinaNome = n.Disciplina.Name,
                    Nota = n.Valor,
                    UserName = n.Aluno.Name
                })
                .ToListAsync();
        }

        public async Task<ICollection<UserNotaDisciplinaDTO>> GetNotasByDisciplinaIdAsync(int disciplinaId)
        {
            throw new NotImplementedException("This method is not implemented yet.");
        }
    }
}
