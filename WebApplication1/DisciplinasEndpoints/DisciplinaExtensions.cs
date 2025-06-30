using WebApplication1.DTOs;
using WebApplication1.Interfaces;

namespace WebApplication1.DisciplinasEndpoints
{
    public static class DisciplinaExtensions
    {
        public static IEndpointRouteBuilder UseDisciplinaRoutes(this IEndpointRouteBuilder endpoint)
        {
            var routes = endpoint.MapGroup("/disciplinas").WithTags("Disciplinas");
            routes.MapPost("/", async (IDisciplinaRepository repo, string Nome) =>
            {
                var disciplina = new Models.Disciplina
                {
                    Name = Nome,
                };
                var res = await repo.CreateAsync(disciplina);
                return Results.Ok(res);
            });
            routes.MapGet("GetAll", async (IDisciplinaRepository repo) =>
            {
                var disciplinas = await repo.GetAll();
                return Results.Ok(disciplinas);
            });
            routes.MapGet("GetById/{id:int}", async (IDisciplinaRepository repo, int id) =>
            {
                var disciplina = await repo.GetByIdAsync(id);
                if (disciplina == null)
                {
                    return Results.NotFound("Disciplina não encontrada.");
                }
                return Results.Ok(disciplina);
            });
            routes.MapPut("Update/{id:int}", async (IDisciplinaRepository repo, int id, DisciplinaUpdateDTO model) =>
            {
                var disciplina = await repo.GetByIdAsync(id);
                if (disciplina == null)
                {
                    return Results.NotFound("Disciplina não encontrada.");
                }
                disciplina.Name = model.Nome;
                
                var res = await repo.UpdateAsync(disciplina);
                return Results.Ok(res);
            });
            routes.MapDelete("Delete/{id:int}", async (IDisciplinaRepository repo, int id) =>
            {
                var res = await repo.DeleteAsync(id);
                if (!res)
                {
                    return Results.NotFound("Disciplina não encontrada.");
                }
                return Results.Ok("Disciplina deletada com sucesso.");
            });
            return endpoint;
        }
    }
}
