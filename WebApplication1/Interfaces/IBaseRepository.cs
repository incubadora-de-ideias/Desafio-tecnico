using WebApplication1.Models;

namespace WebApplication1.Interfaces
{
    public interface IBaseRepository<T> where T : BaseEntity
    {
        public Task<T> CreateAsync(T entity);
        public Task<T?> GetByIdAsync(int id);
        public Task<ICollection<T>> GetAll();
        public Task<T> UpdateAsync(T entity);
        public Task<bool> DeleteAsync(int id);
    }
}
