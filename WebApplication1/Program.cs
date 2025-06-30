using Microsoft.EntityFrameworkCore;
using WebApplication1;
using WebApplication1.Context;
using AuthLibrary.Extensions;
using WebApplication1.UserEndpointes;
using WebApplication1.Repositories;
using WebApplication1.Interfaces;
using WebApplication1.DisciplinasEndpoints;
using WebApplication1.NotasExtensions;
using WebApplication1.Services;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerAuth("Api para gerenciamento de escola", "v1", "Esta api serve para gerenciamento de uma escola");

// Add Entity Framework Core with SQL Server support
const string CONNECTION_STRING = @"Server=DESKTOP-6O8KBJR;database=Test1Db;Integrated Security=True;TrustServerCertificate=True";
const string JWTKEY = "GDJQDWIQHNKLEWJBLRWNIE87RFWKJFWLEFNjbwlebqwlih8w7fj3897847rygyjwefjwkfhjwekfuyw";
builder.Services.AddDbContext<AppDbContext>(options =>
    options.UseSqlServer(CONNECTION_STRING));

//Configurando a autenticação JWT
builder.Services.AddTokenService(JWTKEY);

builder.Services.AddAuthSuporte(JWTKEY, "ESCOLA", "ALUNOS");

//Adcionando os repositórios
builder.Services.AddScoped<IUserRepository, UserRepository>();
builder.Services.AddScoped<IDisciplinaRepository, DisciplinaRepository>();
builder.Services.AddScoped<INotaRepository, NotaRepository>();
builder.Services.AddTransient<ILogin, Login>();

var app = builder.Build();

// Configure the HTTP request pipelin
// e.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

//adicionando o middleware de tratamento de erros global
app.UseGlobalErrorHandling();

app.UseHttpsRedirection();

app.UseAuthentication();

app.UseAuthorization();

//Adicionando as rotas

app.UseUserRoutes();

app.UseDisciplinaRoutes();

app.UseNotasRoutes();

app.Run();