using AuthLibrary.Models;
using WebApplication1.Models;

namespace WebApplication1.Interfaces
{
    public interface IUserRepository : IBaseRepository<User>
    {
        Task<User?> GetByEmailAsync(string email);
        Task<TokenResponse> GetByEmailAndPasswordAsync(string email, string password);
        Task<bool> IsEmailAlreadyRegisteredAsync(string email);
        Task<ICollection<User>> GetUsersWithDisciplinasAsync();
    }
}
