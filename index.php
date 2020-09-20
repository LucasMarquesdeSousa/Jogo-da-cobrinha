<!DOCTYPE html>
<html lang="pt-br">
<?php
$usuario = "";
if (isset($_SESSION["cod"])) {
    $cod = $_SESSION["cod"];
    require_once 'DAO/UsuarioDAO.php';
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->PegarUsuarioSalve($cod);
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css" />
    <title>Sniker Game</title>
</head>

<body>
    <div class="contanier">
        <div class="titulo">
            <h1>Sniker Game</h1>
        </div>
        <section class="menu">
            <a href="controller/Validar.php">Novo jogo</a>
            <?php if ($usuario) {  ?>
                <button onclick="Continuar()"> Continuar </button>
            <?php } ?>
            <a href="view/Config.php">Configurar</a>
            <!-- Vou colocar futuramente multiplayer e competição entre amigos-->
        </section>
    </div>
</body>

</html>