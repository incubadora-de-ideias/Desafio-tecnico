using AuthLibrary.Models;
using Microsoft.EntityFrameworkCore;
using WebApplication1.Context;
using WebApplication1.Helpers;
using WebApplication1.Interfaces;
using WebApplication1.Models;

namespace WebApplication1.Repositories
{
    public class UserRepository : BaseRepository<User>, IUserRepository
    {
        private readonly ILogin _login;
        public UserRepository(AppDbContext context, ILogin login) : base(context)
        {
            _login = login;
        }
        public async Task<TokenResponse> GetByEmailAndPasswordAsync(string email, string password)
        {
            var user = await _dbSet.SingleOrDefaultAsync(u => u.Email == email);
            if(user == null || !HasHelper.VerifyHash(password, user.Password))
            {
                return new TokenResponse
                {
                    Message = "Usuário ou senha inválidos.",
                    Success = false
                };// User not found or password does not match
            }
            return await _login.LoginAsync(user); // Assuming this method is synchronous for simplicity
        }

        public Task<Models.User?> GetByEmailAsync(string email)
        {
            throw new NotImplementedException();
        }

        public Task<ICollection<Models.User>> GetUsersWithDisciplinasAsync()
        {
            throw new NotImplementedException();
        }

        public Task<bool> IsEmailAlreadyRegisteredAsync(string email)
        {
            throw new NotImplementedException();
        }

    }
}
