using AuthLibrary.Models;
using AuthLibrary.Services;
using Microsoft.EntityFrameworkCore;
using WebApplication1.Context;
using WebApplication1.Helpers;
using WebApplication1.Interfaces;
using WebApplication1.Models;

namespace WebApplication1.Services
{
    public class Login : ILogin
    {
        private readonly AppDbContext _context;
        private readonly ITokenService _tokenService;

        public Login(ITokenService tokenService, AppDbContext context)
        {
            _tokenService = tokenService;
            _context = context;
        }

        public async Task<TokenResponse> LoginAsync(User model)
        {
            var user = await _context.Users
                .SingleOrDefaultAsync(u => u.Email == model.Email);

            if (user == null || !HasHelper.VerifyHash(model.Password, user.Password))
            {
                return new TokenResponse
                {
                    Success = false,
                    Message = "Usuário ou senha inválidos."
                };
            }
            
            List<string> roles = new List<string>();

            roles.Add(user.Role); // Assuming user has a Role property
            
            var token = _tokenService.GenerateToken(user.Id, roles);

            return token;
        }
    }
}
