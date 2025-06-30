using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ecubadora_e_empresas_Afonso
{
    public partial class tela_principal : Form
    {
        public tela_principal()
        {
            InitializeComponent();
        }

        private void btn_inserir_Click(object sender, EventArgs e)
        {
            var conexao = new MySqlConnection("user = root; server=localhost;database=afonso_e");
            conexao.Open();
            var comando = new MySqlCommand("insert into aluno values(default,@nome,@numero,@turma)", conexao);
            comando.Parameters.AddWithValue("@nome", txt_nome.Text);
            comando.Parameters.AddWithValue("@numero", txt_numero.Text);
            comando.Parameters.AddWithValue("@turma", txt_turma.Text);
            MessageBox.Show("inserido");
            comando.ExecuteNonQuery();

            conexao.Close();
        }

        private void adicionarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            painel_adda.Visible = true;
        }

        private void btn_mudar_Click(object sender, EventArgs e)
        {

        }

        private void editarToolStripMenuItem1_Click(object sender, EventArgs e)
        {
            MessageBox.Show("indisponivel de momento");
        }

        private void visualisarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("indisponivel de momento");
        }

        private void button1_Click(object sender, EventArgs e)
        {
            var conexao = new MySqlConnection("user = root; server=localhost;database=afonso_e");
            conexao.Open();
            var comando = new MySqlCommand("insert into usuario values(default,@nome,@email,@tipo,@senha)", conexao);
            comando.Parameters.AddWithValue("@nome", txt_nome.Text);
            comando.Parameters.AddWithValue("@email", txt_numero.Text);
            comando.Parameters.AddWithValue("@tipo", txt_turma.Text);
            comando.Parameters.AddWithValue("@senha", txt_turma.Text);
            MessageBox.Show("inserido");


            conexao.Close();
        }

        private void criarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            panel1.Visible = true;
        }

        private void editarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("indisponivel de momento");
        }

        private void removerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("indisponivel de momento");
        }

        private void lancarNotasToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("indisponivel de momento");
        }

        private void alterarNotasToolStripMenuItem_Click(object sender, EventArgs e)
        {
            MessageBox.Show("indisponivel de momento");
        }
    }
}
