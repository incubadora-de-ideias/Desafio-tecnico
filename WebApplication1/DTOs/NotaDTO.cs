namespace WebApplication1.DTOs
{
    public class NotaDTO
    {
        public int Id { get; set; }
        public int AlunoId { get; set; }
        public int DisciplinaId { get; set; }
        public decimal Valor
        {
            get; set;
        }
    }
}
