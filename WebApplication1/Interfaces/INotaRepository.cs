using System.Threading.Tasks;
using WebApplication1.DTOs;
using WebApplication1.Models;

namespace WebApplication1.Interfaces
{
    public interface INotaRepository : IBaseRepository<Nota>
    {
        Task<Nota> CreateNotaAsync(NotaDTO nota);
        Task<ICollection<UserNotaDisciplinaDTO>> GetNotasByAlunoIdAsync(int alunoId);
        Task<ICollection<UserNotaDisciplinaDTO>> GetNotasByDisciplinaIdAsync(int disciplinaId);
        Task<ICollection<UserNotaDisciplinaDTO>> GetNotasByAlunoIdAndDisciplinaIdAsync(int alunoId, int disciplinaId);
    }
}
