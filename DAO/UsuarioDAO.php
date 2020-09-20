<?php
require_once "../Conexao/Conexao.php";
require_once "../DTO/UsuarioDTO.php";
class UsuarioDAO
{
  private $pdo = null;

  public function __construct()
  {
    $this->pdo = Conexao::instanciar();
  }

  public function Criar(UsuarioDTO  $usuarioDTO)
  {
    try {
      $sql = "INSERT into usuario(cod, velocidade, corFundo, corSniker, teclaCima, teclaBaixo, teclaDireita, teclaEsquerda) value(?,?,?,?,?,?,?,?)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(1, $usuarioDTO->getCod());
      $stmt->bindValue(2, $usuarioDTO->getVelocidade());
      $stmt->bindValue(3, $usuarioDTO->getCor_fundo());
      $stmt->bindValue(4, $usuarioDTO->getCor_sniker());
      $stmt->bindValue(5, $usuarioDTO->getTecla_cima());
      $stmt->bindValue(6, $usuarioDTO->getTecla_baixo());
      $stmt->bindValue(7, $usuarioDTO->getTecla_direita());
      $stmt->bindValue(8, $usuarioDTO->getTecla_esquerda());
      return $stmt->execute();
    } catch (PDOException $th) {
      echo "Erro ao cadastrar" . $th->getMessage();
      die();
    }
  }
  public function PegarUsuario($cod)
  {
    try {
      $sql = "SELECT cod FROM usuario WHERE cod=?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(1, $cod);
      return $stmt->execute();
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }
  public function PegarUsuarioSalve($cod)
  {
    try {
      $sql = "SELECT salve FROM usuario WHERE cod=?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(1, $cod);
      return $stmt->execute();
    } catch (PDOException $th) {
      echo $th->getMessage();
    }
  }
  public function EditarUsuario(UsuarioDTO $usuarioDTO){
    try {
      $sql = "UPDATE usuario SET velocidade=?, corFundo=?, corSniker=?, teclaCima=?, teclaBaixo=?, teclaDireita=?, teclaEsquerda=? WHERE cod=?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(1, $usuarioDTO->getVelocidade());
      $stmt->bindValue(2, $usuarioDTO->getCor_fundo());
      $stmt->bindValue(3, $usuarioDTO->getCor_sniker());
      $stmt->bindValue(4, $usuarioDTO->getTecla_cima());
      $stmt->bindValue(5, $usuarioDTO->getTecla_baixo());
      $stmt->bindValue(6, $usuarioDTO->getTecla_direita());
      $stmt->bindValue(7, $usuarioDTO->getTecla_esquerda());
      $stmt->bindValue(8, $usuarioDTO->getCod());
      return $stmt->execute();
    } catch (PDOException $th) {
        echo $th->getMessage();
        die();
    }
  }
}
