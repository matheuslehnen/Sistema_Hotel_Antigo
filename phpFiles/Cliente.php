<?php

class Cliente
{

    private $id;
    private $nome;
    private $cpf;
    private $nascimento;
    private $email;
    private $telefone;
    private $cidade;
    private $UF;
    private $fumante;
    private $diasHospedado;
    private $totalPagar;


    function __construct($id, $nome, $cpf, $nascimento, $email, $telefone, $cidade, $UF, $fumante)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->nascimento = $nascimento;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cidade = $cidade;
        $this->UF = $UF;
        if ($fumante) {
            $this->fumante = 'Fumante';
        } else {
            $this->fumante = 'Nao-fumante';
        }
    }



  // ------------------------   Métodos Getters and Setters da Classe Cliente --------------------------------------//

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;
    }


    public function getCpf()
    {
        return $this->cpf;
    }


    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }


    public function getNascimento()
    {
        return $this->nascimento;
    }


    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function getTelefone()
    {
        return $this->telefone;
    }


    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }


    public function getCidade()
    {
        return $this->cidade;
    }


    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }


    public function getUF()
    {
        return $this->UF;
    }


    public function setUF($UF)
    {
        $this->UF = $UF;
    }


    public function getFumante()
    {
        return $this->fumante;
    }


    public function setFumante($fumante)
    {
        $this->fumante = $fumante;
    }


    public function getDiasHospedado()
    {
        return $this->diasHospedado;
    }


    public function setDiasHospedado($diasHospedado)
    {
        $this->diasHospedado = $diasHospedado;
    }


    public function getTotalPagar()
    {
        return $this->totalPagar;
    }


    public function setTotalPagar($totalPagar)
    {
        $this->totalPagar = $totalPagar;
    }
}