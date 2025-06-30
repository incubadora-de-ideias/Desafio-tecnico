using Microsoft.EntityFrameworkCore;
using WebApplication1.Context;
using WebApplication1.Interfaces;
using WebApplication1.Models;

namespace WebApplication1.Repositories
{
    public class BaseRepository<T>(AppDbContext context) : IBaseRepository<T> where T: BaseEntity
    {
        protected readonly AppDbContext _context = context ?? throw new ArgumentNullException(nameof(context));
        protected readonly DbSet<T> _dbSet = context.Set<T>();

        public virtual async Task<T> CreateAsync(T entity)
        {
           await _dbSet.AddAsync(entity);
           await _context.SaveChangesAsync();
           await _context.SaveChangesAsync(); // Ensure changes are saved to the database
           return entity; 
        }

        public async Task<bool> DeleteAsync(int id)
        {
           if(!await _dbSet.AnyAsync(e => e.Id == id))
           {
               return false; // Entity not found
           }
           var entity = await _dbSet.FindAsync(id);
            _dbSet.Remove(entity!);
            await _context.SaveChangesAsync();
            return true;
        }

        public async Task<ICollection<T>> GetAll() => await _dbSet.ToListAsync();

        public async Task<T?> GetByIdAsync(int id)=> await _dbSet.FindAsync(id);

        public async Task<T> UpdateAsync(T entity)
        {
            entity.UpdatedAt = DateTime.UtcNow; // Update the timestamp
            _dbSet.Update(entity);
            await _context.SaveChangesAsync();
            return entity;
        }
    }
}
