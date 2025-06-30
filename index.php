<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão escolar - IPIL</title>

    <link rel="stylesheet" href="./css/font/css/all.min.css" />
    <link rel="stylesheet" href="./css/adminlte.min.css" />
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
       
        <span class="brand-text font-weight-light">IPIL</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contactos</a>
          </li>
        </ul>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <?php
        if (!isset($_SESSION['usuario'])) :
        ?>
            <li class="nav-item">
                <a class="nav-link btn btn-outline-primary"  href="./login/" role="button">
                Entrar
                </a>
            </li>
        <?php
        else:
        ?>
            <li class="nav-item">
            <a class="nav-link btn btn-outline-secondary"  href="./dashboard/" role="button">
            Dashboard
            </a>
        </li>
        <?php

        endif;
        ?>
        </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Sistema de gestão escolar IPIL</h1>
          </div><!-- /.col -->
        
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                  <p>Encontre aqui tudo que poderias encontrar na sua instituição física</p>
                </div>
            </div>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Sistema de gestão escolar
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; IPIL</a></strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<script src="./js/jquery.js"></script>
<script src="./css/font/js/all.min.js"></script>
<script src="./js/adminlte.min.css"></script>
</body>
</html>
