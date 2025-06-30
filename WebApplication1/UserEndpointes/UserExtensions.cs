using System.Runtime.CompilerServices;
using WebApplication1.DTOs;
using WebApplication1.Helpers;
using WebApplication1.Interfaces;

namespace WebApplication1.UserEndpointes
{
    public static class UserExtensions
    {
        public static IEndpointRouteBuilder UseUserRoutes(this IEndpointRouteBuilder endpoint)
        {
            var routes = endpoint.MapGroup("/users").WithTags("User");

            routes.MapPost("/", async (IUserRepository repo, UserCreateDTO model) =>
            {
                var user = new Models.User
                {
                    Name = model.Name,
                    Email = model.Email,
                    Password = HasHelper.Hash(model.Password)
                };
                var res = await repo.CreateAsync(user);
                return Results.Ok(res);
            });

            routes.MapPost("/login", async (IUserRepository repo, LoginDTO model) =>
            {
                var token = await repo.GetByEmailAndPasswordAsync(model.email, model.password);
                if (token == null)
                {
                    return Results.NotFound("Usuário ou senha inválidos.");
                }
                return token.Success ? Results.Ok(token) : Results.NotFound(token.Message);
            });

            routes.MapGet("GetAll", async (IUserRepository repo) =>
            {
                var users = await repo.GetAll();
                return Results.Ok(users);
            });

            routes.MapGet("GetById/{id:int}", async (IUserRepository repo, int id) =>
            {
                var user = await repo.GetByIdAsync(id);
                if (user == null)
                {
                    return Results.NotFound("Usuário não encontrado.");
                }
                return Results.Ok(user);
            }); 


            routes.MapPut("Update/{id:int}", async (IUserRepository repo, int id, UserUpdateDTO model) =>
            {
                var user = await repo.GetByIdAsync(id);
                if (user == null)
                {
                    return Results.NotFound("Usuário não encontrado.");
                }
                user.Name = model.Name;
                user.Email = model.Email;
                user.Password = HasHelper.Hash(model.Password);
                await repo.UpdateAsync(user);
                return Results.Ok(user);
            });

            routes.MapDelete("Delete/{id:int}", async (IUserRepository repo, int id) =>
            {
                var deleted = await repo.DeleteAsync(id);
                if (!deleted)
                {
                    return Results.NotFound("Usuário não encontrado.");
                }
                return Results.Ok("Usuário deletado com sucesso.");
            });
            return routes;

        }
    }
}
