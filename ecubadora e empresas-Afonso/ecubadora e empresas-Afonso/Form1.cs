using MySql.Data.MySqlClient;

namespace ecubadora_e_empresas_Afonso
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btn_entrar_Click(object sender, EventArgs e)
        {
            var conexao = new MySqlConnection("user = root; server=localhost;database=afonso_e");
            conexao.Open();
            var comando = new MySqlCommand("select senha from usuarios where senha = @senha", conexao);
            comando.Parameters.AddWithValue("@senha",txt_senha.Text);

            if(txt_senha != null )
            {
                MessageBox.Show("Bem-Vindo");
             var mudar = new tela_principal();
            mudar.Show();
            this.Visible = false;

            }
            //  MySqlDataAdapter ad = new MySqlDataAdapter(comando);
            
            conexao.Close();
           
        }
    }
}