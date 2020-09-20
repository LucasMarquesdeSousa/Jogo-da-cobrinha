<?php
session_start();
if (empty($_SESSION["cod"])) {
    //importar pastas
    
    require_once '../DAO/UsuarioDAO.php';
    require_once '../DTO/UsuarioDTO.php';
    //variáveis
    $velocidade = 100;
    $cor_fundo = "rgb(5, 107, 5)";
    $cor_sniker = "black";
    $tecla_cima = "w";
    $tecla_baixo = "s";
    $tecla_direita = "d";
    $tecla_esquerda = "a";
    $cod = rand(10000, 1000000000);
    //metodos acessores
    $usuarioDTO = new UsuarioDTO();
    $usuarioDTO->setVelocidade($velocidade);
    $usuarioDTO->setCor_fundo($cor_fundo);
    $usuarioDTO->setCor_snike($cor_sniker);
    $usuarioDTO->setTecla_baixo($tecla_baixo);
    $usuarioDTO->setTecla_cima($tecla_cima);
    $usuarioDTO->setTecla_direita($tecla_direita);
    $usuarioDTO->setTecla_esquerda($tecla_esquerda);
    $usuarioDTO->setCod($cod);
    //banco de dados
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->Criar($usuarioDTO);
    
    if ($usuario) { // verificar se foi cadastrado no banco de dados
        echo "funcionou!!";
        $_SESSION["cod"] = $cod;
        $_SESSION["velocidade"] = $velocidade;
        $_SESSION["corFundo"] = $cor_fundo;
        $_SESSION["corSniker"] = $cor_sniker;
        $_SESSION["teclaCima"] = $tecla_cima;
        $_SESSION["teclaBaixo"] = $tecla_baixo;
        $_SESSION["teclaDireita"] = $tecla_direita;
        $_SESSION["teclaEsquerda"] = $tecla_esquerda;
        echo "<script> location.href='../view/Canvas.php'</script>";
    }
}else{
    echo "<script> location.href='../view/Canvas.php'</script>";
}
