<?php
class UsuarioDTO{
    //variáveis
    private $velocidade;
    private $cor_fundo;
    private $cor_sniker;
    private $tecla_cima;
    private $tecla_baixo;
    private $tecla_direita;
    private $tecla_esquerda;
    private $cod;

    //metodo get - pegar 
    public function getCod(){
        return $this->cod;
    } 
    public function getVelocidade()
    {
        return $this->velocidade;
    }
    public function getCor_fundo()
    {
        return $this->cor_fundo;
    }
    public function getCor_sniker()
    {
        return $this->cor_sniker;
    }
    public function getTecla_cima()
    {
        return $this->tecla_cima;
    }
    public function getTecla_baixo()
    {
        return $this->tecla_baixo;
    }
    public function getTecla_direita()
    {
        return $this->tecla_direita;
    }
    public function getTecla_esquerda()
    {
        return $this->tecla_esquerda;
    }
    //metodo set - colocar
    public function setCod($cod){
        $this->cod = $cod;
    }
    public function setVelocidade($velocidade)
    {
        $this->velocidade = $velocidade;
    }
    public function setCor_snike($Cor_sniker)
    {
        $this->cor_sniker = $Cor_sniker;
    }
    public function setCor_fundo($Cor_fundo)
    {
        $this->cor_fundo = $Cor_fundo;
    }
    public function setTecla_cima($tecla_cima)
    {
        $this->tecla_cima = $tecla_cima;
    }
    public function setTecla_baixo($tecla_baixo)
    {
        $this->tecla_baixo = $tecla_baixo;
    }
    public function setTecla_direita($tecla_direita)
    {
        $this->tecla_direita = $tecla_direita;
    }
    public function setTecla_esquerda($tecla_esquerda)
    {
        $this->tecla_esquerda = $tecla_esquerda;
    }
}
