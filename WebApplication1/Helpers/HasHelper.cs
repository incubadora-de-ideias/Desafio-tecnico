namespace WebApplication1.Helpers
{
    public static class HasHelper
    {
        public static string Hash(string text)
        {
            var hash = BCrypt.Net.BCrypt.HashPassword(text);
            return hash;
        }                      
        public static bool VerifyHash(string text, string hash)
        {
            return BCrypt.Net.BCrypt.Verify(text, hash);
        }
    }
}
