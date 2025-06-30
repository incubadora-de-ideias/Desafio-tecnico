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
    <title>Sistema de gestão escolar - IPIL | Professores</title>

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
            <a href="./alunos.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Alunos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./pf.php" class="nav-link active">
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
            <h1 class="m-0">Professores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../">Home</a></li>
              <li class="breadcrumb-item active">Professores</li>
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
                        Cadastrar novo professor
                    </button>
                </div>

                <div class="container my-3">

                </div>

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Professores salvos
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
                                        user.nome as nome, user.email as email, user.terminal as terminal, user.endereco as endereco, al.id as id, al.created_at as created
                                            FROM usuario as user
                                            inner join professor as al on al.idUser = user.id
                                            where (user.nome like '%$psq%')
                                            order by al.id asc
                                            limit $start, $limite
                                    
                                     ";
                                } else {
                                    $sql = "SELECT
                                        user.nome as nome, user.email as email, user.terminal as terminal, user.endereco as endereco, al.id as id, al.created_at as created
                                            FROM usuario as user
                                            inner join professor as al on al.idUser = user.id
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
                                <tr>

                                    <div class="container">
                                        <div class="alert alert-warning">Sem nenhum professor salvo no sistema</div>
                                    </div>
                                </tr>
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


  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Sistema de gestão escolar
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; IPIL.</strong> All rights reserved.
  </footer>

</div>


  <!-- /.login-box -->
  <script src="../../../js/jquery.js"></script>
  <script src="../../../js/adminlte.min.js"></script>
  <script src="../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../js/sweetalert2.js"></script>
  <script src="../../../css/font/js/all.min.js"></script>
</body>
</html>