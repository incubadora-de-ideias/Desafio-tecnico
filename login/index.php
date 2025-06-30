<?php
session_start();

if (isset($_SESSION['usuario'])) {
  header("Location: ../dashboard/");
  exit();
}
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sistema de gestão escolar - IPIL | Log In</title>

  <link rel="stylesheet" href="../css/font/css/all.min.css" />
  <link rel="stylesheet" href="../css/adminlte.min.css" />
  <link rel="stylesheet" href="../css/sweetalert2.css" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/global.css" />
</head>

<body class="hold-transition login-page">
  <div id="loading"></div>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../" class="h1"><b>Sistema de gestão escolar - IPIL</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Iniciar sessão</p>

        <form method="post" id="loginForm">
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fa fa-lock" id="eye"></i>
              </div>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="senha" minlength="4" id="password" required>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3">

        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <!-- /.login-box -->
  <script src="../js/jquery.js"></script>
  <script src="../js/sweetalert2.js"></script>
  <script src="../css/font/js/all.min.js"></script>

  <script>

    $(document).ready(function() {

      $("#loginForm").on("submit", function(evt) {

        evt.preventDefault();

        var dados = $(this).serialize();

        $.ajax({
          method: "POST",
          url: "../process/login.php",
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
                title: "Conta verificada com sucesso!"
              }).then((i) => {
                window.location = "../dashboard/";
              });
            } else {
              Swal.fire({
                icon: "warning",
                title: "Falha ao verificar conta",
                text: "Os dados inseridos não são válidos."
              });
            }
          },
          error: function(error) {
            Swal.fire({
              icon: "error",
              title: "Falha ao verificar conta!",
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