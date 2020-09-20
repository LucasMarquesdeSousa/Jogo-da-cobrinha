<?php
   require_once '../DAO/UsuarioDAO.php';
   require_once '../DTO/UsuarioDTO.php';
   $velocidade = $_POST["velo"];
   $velocidadeDTO = new UsuarioDTO();
   $velocidadeDTO->setVelocidade($velocidade);
   
   $velocidadeDAO = new UsuarioDAO();
   $verficaVelo = $velocidadeDAO->Criar($velocidadeDTO);
   if($verficaVelo){
      echo "<script> location.href='../index.html';</script>";
   }else{
      echo "<script> location.href='../index.html'</script>";
   }
?>