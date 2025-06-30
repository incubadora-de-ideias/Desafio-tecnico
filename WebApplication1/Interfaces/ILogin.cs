using AuthLibrary.Models;
using WebApplication1.Models;

namespace WebApplication1.Interfaces
{
    public interface ILogin
    {
        public Task<TokenResponse> LoginAsync(User user);
    }
}
