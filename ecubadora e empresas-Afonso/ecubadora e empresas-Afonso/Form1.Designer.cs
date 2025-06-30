namespace ecubadora_e_empresas_Afonso
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            btn_entrar = new Button();
            txt_email = new TextBox();
            label1 = new Label();
            label2 = new Label();
            txt_senha = new TextBox();
            label3 = new Label();
            label4 = new Label();
            SuspendLayout();
            // 
            // btn_entrar
            // 
            btn_entrar.Location = new Point(134, 275);
            btn_entrar.Name = "btn_entrar";
            btn_entrar.Size = new Size(94, 29);
            btn_entrar.TabIndex = 0;
            btn_entrar.Text = "entrar";
            btn_entrar.UseVisualStyleBackColor = true;
            btn_entrar.Click += btn_entrar_Click;
            // 
            // txt_email
            // 
            txt_email.Location = new Point(112, 162);
            txt_email.Name = "txt_email";
            txt_email.Size = new Size(125, 27);
            txt_email.TabIndex = 1;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Location = new Point(155, 64);
            label1.Name = "label1";
            label1.Size = new Size(32, 20);
            label1.TabIndex = 2;
            label1.Text = "IPIL";
            // 
            // label2
            // 
            label2.AutoSize = true;
            label2.Location = new Point(144, 115);
            label2.Name = "label2";
            label2.Size = new Size(54, 20);
            label2.TabIndex = 3;
            label2.Text = "Loguin";
            // 
            // txt_senha
            // 
            txt_senha.Location = new Point(112, 216);
            txt_senha.Name = "txt_senha";
            txt_senha.Size = new Size(125, 27);
            txt_senha.TabIndex = 4;
            txt_senha.UseSystemPasswordChar = true;
            // 
            // label3
            // 
            label3.AutoSize = true;
            label3.Location = new Point(52, 169);
            label3.Name = "label3";
            label3.Size = new Size(46, 20);
            label3.TabIndex = 5;
            label3.Text = "Email";
            // 
            // label4
            // 
            label4.AutoSize = true;
            label4.Location = new Point(52, 219);
            label4.Name = "label4";
            label4.Size = new Size(47, 20);
            label4.TabIndex = 6;
            label4.Text = "senha";
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(8F, 20F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(426, 409);
            Controls.Add(label4);
            Controls.Add(label3);
            Controls.Add(txt_senha);
            Controls.Add(label2);
            Controls.Add(label1);
            Controls.Add(txt_email);
            Controls.Add(btn_entrar);
            Name = "Form1";
            ShowIcon = false;
            Text = "Afonso";
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private Button btn_entrar;
        private TextBox txt_email;
        private Label label1;
        private Label label2;
        private TextBox txt_senha;
        private Label label3;
        private Label label4;
    }
}