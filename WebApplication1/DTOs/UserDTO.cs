using System.ComponentModel.DataAnnotations;

namespace WebApplication1.DTOs
{
    public class UserCreateDTO
    {
        [Required(ErrorMessage = "Name is required"), EmailAddress(ErrorMessage = "Email inválido")]
        public string Email { get; set; } = string.Empty;
        public string Password { get; set; } = string.Empty;
        public string Name { get; set; } = string.Empty;
    }
    public class UserUpdateDTO    {
        [Required(ErrorMessage = "Name is required"), EmailAddress(ErrorMessage = "Email inválido")]
        public string Email { get; set; } = string.Empty;
        public string Name { get; set; } = string.Empty;
        public string Password { get; set; } = string.Empty;


    }
}
