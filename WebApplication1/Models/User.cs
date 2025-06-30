namespace WebApplication1.Models;

public class User : BaseEntity
{
    public string Name { get; set; }
    public string Email { get; set; } = string.Empty;
    public string Password { get; set; } = string.Empty;
    public ICollection<Nota> Notas { get; set; } = new List<Nota>();
    public string Role { get; set; } = "Aluno"; // Default role is "Aluno"
}
