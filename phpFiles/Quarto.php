<?php

class Quarto
{
    private $IDQuarto;
    private $localizacao;
    private $fumante;
    private $valorDiaria;
    private $capacidade;
    private $situacao;
    private $ocupadoPor;


    public function __construct($IDQuarto, $localizacao, $fumante, $valorDiaria, $capacidade, $situacao)
    {


        $this->IDQuarto = $IDQuarto;
        $this->localizacao = $localizacao;
        if($fumante){
            $this->fumante = 'Permitido';
        } else {
            $this->fumante = 'Proibido';
        }
        $this->valorDiaria = $valorDiaria;
        $this->capacidade = $capacidade;
        if($situacao){
            $this->situacao = 'Ocupado';
        } else {
            $this->situacao = 'Vago';
        }
    }

  // ------------------------   Métodos Getters and Setters da Classe Quarto --------------------------------------//

    public function getIDQuarto()
    {
        return $this->IDQuarto;
    }


    public function setIDQuarto($IDQuarto)
    {
        $this->IDQuarto = $IDQuarto;
    }

    public function getLocalizacao()
    {
        return $this->localizacao;
    }


    public function setLocalizacao($localizacao)
    {
        $this->localizacao = $localizacao;
    }


    public function getFumante()
    {
        return $this->fumante;
    }


    public function setFumante($fumante)
    {
        $this->fumante = $fumante;
    }



    public function getValorDiaria()
    {
        return $this->valorDiaria;
    }


    public function setValorDiaria($valorDiaria)
    {
        $this->valorDiaria = $valorDiaria;
    }


    public function getCapacidade()
    {
        return $this->capacidade;
    }


    public function setCapacidade($capacidade)
    {
        $this->capacidade = $capacidade;
    }


    public function getSituacao()
    {
        return $this->situacao;
    }


    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }


    public function getOcupadoPor()
    {
        return $this->ocupadoPor;
    }


    public function setOcupadoPor($ocupadoPor)
    {
        $this->ocupadoPor = $ocupadoPor;
    }

}