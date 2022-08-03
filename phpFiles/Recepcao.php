<?php

interface Recepcao
{
  //---------------------------------------------- CLIENTES -------------------------------------------------------//

    public function cadastraCliente($nome, $cpf, $nascimento, $email, $telefone, $cidade, $UF, $fumante);
    public function editaCliente($id, $nome, $cpf, $nascimento, $email, $telefone, $cidade, $UF, $fumante);
    public function listaClientes();
    public function excluiClientes($id);

  //---------------------------------------------- QUARTOS --------------------------------------------------------//

    public function cadastraQuarto($localizacao, $fumante, $valorDiaria, $capacidade);
    public function editaQuarto($IDQuarto, $localizacao, $fumante, $valorDiaria, $capacidade, $situacao);
    public function listaQuartos();
    public function listaQuartosPool();
    public function excluiQuartos($IDQuarto);

  //----------------------------------------------- VALIDAÇÕES ----------------------------------------------------//

    public function validaCPF($cpf);
    public function existeCPF($cpf);


  //------------------------------------- FUNCOES CHECK-IN E CHECK-OUT --------------------------------------------//

    public function fazerCheckIn($cpf, $totalDiarias, $IDQuarto);
    public function fazerCheckOut($cpf, $IDQuarto);
    public function calculaTotal($IDQuarto, $totalDiarias);

}