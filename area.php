<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área do Aluno</title>
    <style>
        .navbar {
        background-color: orange;
        padding: 15px 100px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        }

        .logo {
        color: white;
        font-size: 22px;
        font-weight: bold;
        }

        .links a {
        color: white;
        text-decoration: none;
        margin-left: 20px;
        font-size: 18px;
        font-weight: bold;
        }

        .links a:hover {
        text-decoration: underline;
        }
        .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #ccc;
        display: inline-block;
        }

        .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        }


    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">Portal-IPIL</div>
    <div class="links">
        <a href="ver_boletim.php">Ver Boletim</a>
        <a href="notas.php">Ver Notas</a>
    </div>
</div>


    <div class="conteudo">
        <h2>Ola, <?php echo $_SESSION["usuario"]; ?>😃</h2>
        <p>Escolha uma das opções no menu acima.</p>
    </div>

    <div class="avatar">
    <img src="<?php echo $foto_perfil ?? 'alun.png'; ?>" alt="Foto do usuário">
    </div>

</body>
</html>
