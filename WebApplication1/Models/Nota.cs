namespace WebApplication1.Models
{
    public class Nota : BaseEntity
    {
        public int AlunoId { get; set; }
        public User Aluno { get; set; }
        public int DisciplinaId { get; set; }
        public Disciplina Disciplina { get; set; }
        public decimal Valor { get; set; }
    }
}
