from customtkinter import *
from tkinter import messagebox
import json

class Sistema_de_Gestao_Escolar():
    
    def __init__(self):
        self.janela = CTk()
        self.janela.geometry('1350x700+5+5')
        self.janela.minsize(width=1300, height=650)
        self.main()
        self.janela.mainloop()
        
    def mensagem(self, sms):
        messagebox.showinfo('Mensagem', sms)
    
    def main(self):
        self.frame_esquerdo = CTkFrame(self.janela, bg_color='#1A1A1A', width=670)
        self.frame_esquerdo.pack(padx=5, pady=5, fill='both', side='left', expand=True)
        
        self.frame_direito = CTkFrame(self.janela, bg_color='#1A1A1A', width=670)
        self.frame_direito.pack(padx=5, pady=5, fill='both', side='right', expand=True)
        
        self.label_BemVindo = CTkLabel(self.frame_esquerdo, text='BEM-VINDO AO SEU\nSISTEMA DE GESTÃO\nESCOLAR', font=('Time', 40, 'bold'))
        self.label_BemVindo.pack(pady=250)
        
        self.frame_login = CTkFrame(self.frame_direito, bg_color='#000000', width=520, height=590)
        self.frame_login.pack(pady=50, padx=5, fill='y', expand=True)
        
        self.label_login = CTkLabel(self.frame_login, text='LOGIN', font=('Time', 40, 'bold'))
        self.label_login.pack(pady=(80,50))
        
        self.entry_email = CTkEntry(self.frame_login, placeholder_text='E-mail', corner_radius=100, width=500, height=60)
        self.entry_email.pack(pady=5, padx=50, fill='y')
        
        self.entry_palavraPasse = CTkEntry(self.frame_login, placeholder_text='Palavra-Passe', corner_radius=100, width=500, height=60, show='•')
        self.entry_palavraPasse.pack(pady=25, padx=50, fill='y')
        
        self.botao_login = CTkButton(self.frame_login, text='LOGIN', width=500, height=50, corner_radius=100, command=self.Verificar_tipo_de_usuario)
        self.botao_login.pack(pady=50, padx=50, fill='y')
    
    def Verificar_tipo_de_usuario(self):
        found = False
        with open('Mais/usuariosAdmin.json', "r", encoding='utf-8') as file:
            users = json.load(file)
            
        with open('Mais/Alunos.json', "r", encoding='utf-8') as file:
            alunos = json.load(file)
            
        email_digitado = self.entry_email.get()
        palavraPasse_digitada = self.entry_palavraPasse.get()
        
        for dicionario in users:
            if dicionario['email'] == email_digitado and dicionario['senha'] == palavraPasse_digitada:
                found = True
                self.mensagem('Login efetuado\nTipo: Admin')
                self.Administrar()
                break
            
        if not found:
            for aluno in alunos:
                if aluno['email'] == email_digitado and aluno['senha'] == palavraPasse_digitada:
                    found = True
                    self.mensagem('Login efetuado\nTipo: Aluno')
                    break
                
        if not found:
            self.mensagem('Palavra-Passe ou E-mail errado.')
            
    def Administrar(self):
        for widget in self.frame_direito.winfo_children():
            widget.destroy()
            
        for widget in self.frame_esquerdo.winfo_children():
            widget.destroy()
            
        with open('Mais/Alunos.json', "r", encoding='utf-8') as file:
            alunos = json.load(file)
            
        self.label_alunos = CTkLabel(self.frame_esquerdo, text='ALUNOS', font=('Time', 40, 'bold'))
        self.label_alunos.pack(pady=40)
        
        self.frame_alunos = CTkScrollableFrame(self.frame_esquerdo)
        self.frame_alunos.pack(fill='both', expand=True)
            
        for aluno in alunos:
            aluno_button = CTkButton(self.frame_alunos, text=f'   {aluno["nome"]}', anchor='w', font=('Time', 15, 'bold'), height=44, width=440, fg_color='#212121', command=lambda aluno=aluno: self.abrir_aluno(aluno))
            aluno_button.pack(pady=3, anchor='w', expand=True, padx=30, fill='x')
            
        self.footer = CTkFrame(self.frame_esquerdo, fg_color='#1A1A1A', height=50)
        self.footer.pack(side="bottom", fill="x")
        
        self.botao_adicionar = CTkButton(self.footer, text='+', font=('Time', 35), fg_color='#212121', text_color='white', width=50, height=50, corner_radius=100, hover_color='#121212', command=self.adicionar_aluno)
        self.botao_adicionar.pack(pady=1, padx=5)
        
    def adicionar_aluno(self):
        self.frame_add = CTkFrame(self.frame_direito, bg_color='#000000', width=520, height=590)
        self.frame_add.pack(pady=50, padx=5, fill='y', expand=True)
        
        self.label_add = CTkLabel(self.frame_add, text='ADICIONAR ALUNO', font=('Time', 40, 'bold'))
        self.label_add.pack(pady=(80,50))
        
        self.entry_nome = CTkEntry(self.frame_add, placeholder_text='Nome', corner_radius=100, width=500, height=60)
        self.entry_nome.pack(pady=5, padx=50, fill='y')
        
        self.entry_email = CTkEntry(self.frame_add, placeholder_text='E-mail', corner_radius=100, width=500, height=60)
        self.entry_email.pack(pady=25, padx=50, fill='y')
        
        self.entry_palavraPasseAluno = CTkEntry(self.frame_add, placeholder_text='Palavra-Passe para o aluno', corner_radius=100, width=500, height=60, show='•')
        self.entry_palavraPasseAluno.pack(pady=5, padx=50, fill='y')
        
        self.botao_add = CTkButton(self.frame_add, text='Adicionar', width=500, height=50, corner_radius=100, command=self.salvar_aluno)
        self.botao_add.pack(pady=50, padx=50, fill='y')
        
    def salvar_aluno(self):
        nome = self.entry_nome.get().strip()
    
        if not nome:
            self.mensagem('O nome não pode estar vazio!')
            return
        
        novo_aluno = {
            "nome": nome,
            "email": self.entry_email.get(),
            "senha": self.entry_palavraPasseAluno.get()
        }
        
        with open('Mais/Alunos.json', "r", encoding='utf-8') as file:
            alunos = json.load(file)
            
        alunos.append(novo_aluno)
    
        with open('Mais/Alunos.json', "w", encoding='utf-8') as file:
            json.dump(alunos, file, indent=4)
            
        self.mensagem('Aluno adicionado com sucesso!')
        self.Administrar()
        
        self.criar_file_notas(str(nome))

    def abrir_aluno(self, aluno):
        for widget in self.frame_direito.winfo_children():
            widget.destroy()
        
        label_titulo = CTkLabel(self.frame_direito, text='Editar Aluno', font=('Time', 40, 'bold'))
        label_titulo.pack(pady=(80, 5), padx=60)
        
        label_nome = CTkLabel(self.frame_direito, text='Nome:', font=('Time', 15, 'bold'))
        label_nome.pack(pady=(50, 5), anchor='w', padx=60)
        
        self.entry_nome = CTkEntry(self.frame_direito, fg_color='#212121', width=400, height=40)
        self.entry_nome.pack(pady=(5, 10), anchor='w', padx=60)
        self.entry_nome.insert(0, aluno['nome'])
        
        label_email = CTkLabel(self.frame_direito, text='Email:', font=('Time', 15, 'bold'))
        label_email.pack(pady=(50, 5), anchor='w', padx=60)
        
        self.entry_email = CTkEntry(self.frame_direito, fg_color='#212121', width=400, height=40)
        self.entry_email.pack(pady=5, anchor='w', padx=60)
        self.entry_email.insert(0, aluno['email'])
        
        label_senha = CTkLabel(self.frame_direito, text='Senha:', font=('Time', 15, 'bold'))
        label_senha.pack(pady=(50, 5), anchor='w', padx=60)

        self.entry_senha = CTkEntry(self.frame_direito, fg_color='#212121', width=400, height=40, show='•')
        self.entry_senha.pack(pady=5, anchor='w', padx=60)
        self.entry_senha.insert(0, aluno['senha'])
        
        self.footer = CTkFrame(self.frame_direito, fg_color='#333333')
        self.footer.pack(pady=5, anchor='s', fill='x')
        
        n = aluno['nome']
        
        botao_notas = CTkButton(self.footer, text='Notas', font=('Arial', 35), width=40, hover_color='#2E2E2E', fg_color='#333333', command=lambda: self.exibir_notas(n))
        botao_notas.pack(pady=10, side='left', padx=5)
                
        botao_salvar = CTkButton(self.footer, text='Salvar', font=('Time', 35), width=40, hover_color='#2E2E2E', fg_color='#333333', command=lambda: self.salvar_edicao_contato(aluno))
        botao_salvar.pack(pady=10, side='left', padx=5)

        botao_cancelar = CTkButton(self.footer, text='Cancelar', font=('Arial', 35), width=40, hover_color='#2E2E2E', fg_color='#333333', command=self.cancelar)
        botao_cancelar.pack(pady=10, side='left', padx=5)
        
    def cancelar(self):
        for widget in self.frame_direito.winfo_children():
            widget.destroy()
        
    def salvar_edicao_contato(self, aluno_antigo):
        novo_nome = self.entry_nome.get()
        novo_email = self.entry_email.get()
        nova_senha = self.entry_senha.get()

        with open('Mais/Alunos.json', "r", encoding='utf-8') as file:
            alunos = json.load(file)

        # Verifica se o e-mail já pertence a outro aluno
        for aluno in alunos:
            if aluno['email'] == novo_email and aluno != aluno_antigo:
                self.mensagem('E-mail já pertence a outro aluno!')
                return

        aluno_antigo['nome'] = novo_nome
        aluno_antigo['email'] = novo_email
        aluno_antigo['senha'] = nova_senha
        
        with open('Mais/Alunos.json', "w", encoding='utf-8') as file:
            json.dump(alunos, file, indent=4)

        self.mensagem('Aluno editado com sucesso!')
        self.Administrar()

    def criar_file_notas(self, nome):
        ficheiro = f'Notas/{nome.strip()}.json'
        
        data = [
                {"disciplina": "Matemática", "nota": None},
                {"disciplina": "Português", "nota": None},
                {"disciplina": "Ciências", "nota": None},
                {"disciplina": "História", "nota": None},
                {"disciplina": "Geografia", "nota": None}
               ]
        
        with open(ficheiro, "w", encoding='utf-8') as f:
            json.dump(data, f)
        
    def exibir_notas(self, aluno):
        ficheiro = f'Notas/{aluno.strip()}.json'
        print(ficheiro)
        
        with open(ficheiro, "r", encoding='utf-8') as f:
            notas = json.load(f)

        print(notas)
        
        for widget in self.frame_direito.winfo_children():
            widget.destroy()

        label_titulo = CTkLabel(self.frame_direito, text=f'Notas do(a) {aluno}', font=('Time', 40, 'bold'))
        label_titulo.pack(pady=(80, 5), padx=60)
        
        for item in notas:
             self.footer2 = CTkFrame(self.frame_direito, fg_color='#333333')
             self.footer2.pack(pady=5, fill='x')
             
             print(item['disciplina'], item['nota'])
             
             label_disciplina = CTkLabel(self.footer2, text=f'{item['disciplina']}', font=('Time', 18, 'bold'))
             label_disciplina.pack(pady=(10, 5), padx=60, side='left')
             
             self.entry_nota2 = CTkEntry(self.footer2, fg_color='#212121', width=100, height=10)
             self.entry_nota2.pack(pady=(10, 5), side='left', padx=60)
             self.entry_nota2.insert(0, item['nota'])

Sistema_de_Gestao_Escolar()