<?php
session_start();
require_once "../../../process/conexao.php";

if (!isset($_SESSION['role']) or $_SESSION['role'] != 'adm') {
    header("Location: ../../");
    exit();
 }

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão escolar - IPIL | Alunos</title>

    <link rel="stylesheet" href="../../../css/font/css/all.min.css" />
    <link rel="stylesheet" href="../../../css/adminlte.min.css" />
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../css/sweetalert2.css" />
    <link rel="stylesheet" href="../../../css/global.css" />
</head>
<body class="hold-transition sidebar-mini">
 
<div class="wrapper">
<div id="loading"></div>
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../../" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contactos</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../" class="brand-link">
      <img src="https://tse4.mm.bing.net/th/id/OIP.sdoTMy5TBvzUKy6asP8_aQHaHa?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IPIL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://www.sprintdiagnostics.in/images/user.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?= $_SESSION['nome'] ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          <li class="nav-item">
            <a href="../" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./alunos.php" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Alunos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./pf.php" class="nav-link">
              <i class="nav-icon fas fa-circle-user"></i>
              <p>
                Professores
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./curricular.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Estrutura curricular
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Alunos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../">Home</a></li>
              <li class="breadcrumb-item active">Alunos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="container">
                    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modal-add">
                        <i class="fas fa-plus">
                        </i>
                        Cadastrar novo aluno
                    </button>
                </div>

                <div class="container my-3">

                </div>

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Alunos salvos
                        </h3>
                    </div>
                    <div class="card-body">
                        
                                <?php
                                $inicio = (isset($_GET['inicio']) and !empty($_GET['inicio'])) ?$_GET['inicio']: 1;
                                
                                $limite = (isset($_GET['limite']) and !empty($_GET['limite'])) ?$_GET['limite']: 20;
                                
                                $psq = (isset($_GET['psq']) and !empty($_GET['psq'])) ?$_GET['psq']: '';

                                $start = ($inicio * $limite) - $limite;

                                $sql = "";

                                if (!empty($psq) or $psq != false) {
                                    $sql = "SELECT
                                        user.nome as nome, user.email as email, user.terminal as terminal, user.endereco as endereco, al.id as id, al.created_at as created, t.nome as turma, c.nome as curso 
                                            FROM usuario as user
                                            inner join aluno as al on al.idUser = user.id
                                            inner join turma as t on t.id = al.idTurma
                                            inner join curso as c on c.id = t.idCurso
                                            where (user.nome like '%$psq%')
                                            order by al.id asc
                                            limit $start, $limite
                                    
                                     ";
                                } else {
                                    $sql = "SELECT
                                        user.nome as nome, user.email as email, user.terminal as terminal, user.endereco as endereco, al.id as id, al.created_at as created, t.nome as turma, c.nome as curso 
                                            FROM usuario as user
                                            inner join aluno as al on al.idUser = user.id
                                            inner join turma as t on t.id = al.idTurma
                                            inner join curso as c on c.id = t.idCurso
                                            order by al.id asc
                                            limit $start, $limite
                                    
                                     ";

                                }

                                $resultado = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($resultado) > 0) :

                                    ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Terminal</th>
                                            <th>Endereço</th>
                                            <th>Curso</th>
                                            <th>Turma</th>
                                            <th>Adicionado</th>
                                            <th>Acção</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                while ($rows = mysqli_fetch_assoc($resultado)):
                                ?>
                                <tr>
                                    <th><?= $rows['id'] ?></th>
                                    <td><?= $rows['nome'] ?></td>
                                    <td><?= $rows['email'] ?></td>
                                    <td><?= $rows['terminal'] ?></td>
                                    <td><?= $rows['endereco'] ?></td>
                                    <td><?= $rows['curso'] ?></td>
                                    <td><?= $rows['turma'] ?></td>
                                    <td><?= $rows['created'] ?></td>
                                    <td>
                                        <button class="btn btn-outline-primary" onclick="editar(<?= $rows['id'] ?>, '<?= $rows['nome'] ?>', '<?= $rows['email'] ?>', '<?= $rows['terminal'] ?>', 'endereco')" role="button"><i class="fas fa-edit"></i> Editar</button>
                                    </td>
                                </tr>

                                <?php
                                endwhile;
                                ?>
                                 </tbody>
                                 </table>
                                <?php
                            else:
                                ?>
                                <div class="container">
                                    <div class="alert alert-warning">Sem nenhum aluno salvo no sistema</div>
                                </div>
                                <?php
                                endif;
                                ?>
                           
                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Sistema de gestão escolar
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; IPIL.</strong> All rights reserved.
  </footer>

</div>



<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar aluno</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" id="addForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome<span class="text-danger">*</span></label>
                                    <input type="text" name="nome" id="nome" placeholder="Nome completo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail<span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" placeholder="E-mail" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="endereco">Endereço<span class="text-danger">*</span></label>
                                    <input type="text" name="endereco" id="endereco" placeholder="Endereço" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label for="terminal">Terminal<span class="text-danger">*</span></label>
                            <input type="text" name="terminal" id="terminal" placeholder="Terminal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="turma">Turma<span class="text-danger">*</span></label>
                            <select name="turma" id="turma" class="form-control">
                                <?php
                                $sql1 = "SELECT t.*, c.nome as curso, cls.nome as classe FROM turma as t inner join curso as c on c.id = t.idCurso inner join classe as cls on cls.id = t.idClasse";

                                $result = mysqli_query($conn, $sql1);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)):
                                ?>
                                <option value="<?= $row['id'] ?>"><?= $row['classe'] ?>ª <?= $row['nome'] ?>-<?= $row['curso'] ?></option>
                                <?php
                                endwhile;
                                } else {
                                    ?>
                                    <option disabled>Sem nenhuma turma no sistema</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div> 
                            <label for="ano">Ano lectivo<span class="text-danger">*</span></label>
                            <select name="ano" id="ano" class="form-control">
                                <?php
                                $sql1 = "SELECT * FROM ano_lectivo where activo != 0";

                                $result = mysqli_query($conn, $sql1);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)):
                                ?>
                                <option value="<?= $row['id'] ?>"><?= $row['ano'] ?></option>
                                <?php
                                endwhile;
                                } else {
                                    ?>
                                    <option disabled>Sem nenhum ano lectivo iniciado</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <button class="btn btn-outline-success" type="submit">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    <!-- /.modal -->

  <!-- /.login-box -->
  <script src="../../../js/jquery.js"></script>
  <script src="../../../js/adminlte.min.js"></script>
  <script src="../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../js/sweetalert2.js"></script>
  <script src="../../../css/font/js/all.min.js"></script>

  <script>
    
    $(document).ready(function() {

        $("#addForm").on("submit", function(evt) {

        evt.preventDefault();

        var dados = $(this).serialize();

        $.ajax({
            method: "POST",
            url: "../../../process/add.php",
            data: dados,
            beforeSend: function() {
                $("#loading").show("slow");
            },
            complete: function() {
                $("#loading").hide();
            },
            success: function(e) {
                if (e) {
                    Swal.fire({
                        icon: "success",
                        title: "Dados salvos com sucesso!",
                        text: e
                    }).then((i) => {
                        window.location = self.location;
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Falha ao salvar os dados",
                        text: "Os dados inseridos não são válidos."
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    icon: "error",
                    title: "Falha ao verificar dados!",
                    text: error.statusText
                });
            }
        });

        $(this)[0].reset();
        
    });
    });
  </script>
</body>
</html>