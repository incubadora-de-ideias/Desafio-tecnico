using WebApplication1.DTOs;
using WebApplication1.Interfaces;
using WebApplication1.Models;

namespace WebApplication1.NotasExtensions
{
    public static class UseNotasRoutas
    {
        public static IEndpointRouteBuilder UseNotasRoutes(this IEndpointRouteBuilder endpoint)
        {
            var routes = endpoint.MapGroup("/notas").WithTags("Notas");
            routes.MapGet("/notas", async (INotaRepository repository) =>
            {
                return await repository.GetAll();
            });
            routes.MapGet("/notas/{id}", async (int id, INotaRepository repository) =>
            {
                var nota = await repository.GetNotasByAlunoIdAsync(id);
                return nota is not null ? Results.Ok(nota) : Results.NotFound();
            });
            routes.MapGet("/notasDisciplinas/{id}", async (int id, int DisciplinaId, INotaRepository repository) =>
            {
                var nota = await repository.GetNotasByAlunoIdAndDisciplinaIdAsync(id, DisciplinaId);
                return nota is not null ? Results.Ok(nota) : Results.NotFound();
            });
            routes.MapPost("/notas", async (NotaDTO nota, INotaRepository repository) =>
            {
                if (nota is null || nota.AlunoId <= 0 || nota.DisciplinaId <= 0 || nota.Valor < 0)
                {
                    return Results.BadRequest("Dados inválidos para criar a nota.");
                }
                var note = new Nota
                {
                    AlunoId = nota.AlunoId,
                    DisciplinaId = nota.DisciplinaId,
                    Valor = nota.Valor
                };
                await repository.CreateNotaAsync(nota);
                return Results.Created($"/notas/{nota.Id}", nota);
            });
            routes.MapPut("/notas/{id}", async (int id, Nota updatedNota, INotaRepository repository) =>
            {
                var existingNota = await repository.GetByIdAsync(id);
                if (existingNota is null)
                {
                    return Results.NotFound();
                }
                existingNota.AlunoId = updatedNota.AlunoId;
                existingNota.DisciplinaId = updatedNota.DisciplinaId;
                existingNota.Valor = updatedNota.Valor;
                await repository.UpdateAsync(existingNota);
                return Results.NoContent();
            });
            routes.MapDelete("/notas/{id}", async (int id, INotaRepository repository) =>
            {
                var existingNota = await repository.GetByIdAsync(id);
                if (existingNota is null)
                {
                    return Results.NotFound();
                }
                await repository.DeleteAsync(existingNota.Id);
                return Results.NoContent();
            });

            return routes;
        }
    }
}
