<?php

require_once 'Cliente.php';
require_once 'Quarto.php';
require_once 'Recepcao.php';
require_once 'Recepcionista.php';

// session_start inicia a sessão
session_start();


class Recepcionista implements Recepcao
{

    private array $cliente = array();
    private array $quarto = array();


    //----------------------------------------------- CLIENTES ------------------------------------------------------//


    public function cadastraCliente($nome, $cpf, $nascimento, $email, $telefone, $cidade, $UF, $fumante)
    {
        $connection = $this->connection();
        if (!($this->existeCPF($cpf)) && $this->validaCPF($cpf)) {
            if ($fumante) {
                $fuma = 'Fumante';
            } else {
                $fuma = 'Não-Fumante';
            }
            $sql = mysqli_query($connection, "insert into hospedes values (default, '$nome', '$cpf', '$nascimento', '$email','$telefone', '$cidade', '$UF', '$fuma', default, default, default)");
        } else {
            echo "Erro! CPF inválido ou a pessoa já está cadastrada no sistema.";
        }
    }


    public function editaCliente($id, $nome, $cpf, $nascimento, $email, $telefone, $cidade, $UF, $fumante)
    {
        $connection = $this->connection();
        if ($fumante) {
            $fuma = 'Fumante';
        } else {
            $fuma = 'Não-Fumante';
        }
        $sql = mysqli_query($connection, "update hospedes set nome = '$nome', cpf = '$cpf', nascimento = '$nascimento', email = '$email', telefone = '$telefone', cidade = '$cidade', UF = '$UF', fumante = '$fuma' where id  = $id");
    }

    public function listaClientes()
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "select * from hospedes");

        echo "<thead><tr><th class='campos'>ID</th>";
        echo "<th class='campos'>Nome</th>";
        echo "<th class='campos'>CPF</th>";
        echo "<th class='campos'>Nascimento</th>";
        echo "<th class='campos'>Email</th>";
        echo "<th class='campos'>Telefone</th>";
        echo "<th class='campos'>Cidade</th>";
        echo "<th class='campos'>UF</th>";
        echo "<th class='campos'>Fumante</th>";
        echo "<th class='campos'>Quarto</th>";
        echo "<th class='campos'>Diarias</th>";
        echo "<th class='campos'>Pagar</th></tr></thead>";

        while ($valor = mysqli_fetch_assoc($sql)) {
            echo "<tbody><tr><td class='campos'><input type='checkbox' name='checked[]' value=" . $valor['id'] . ">[" . $valor['id'] . "]</td>";
            echo "<td class='campos'>" . $valor['nome'] . "</td>";
            echo "<td class='campos'>" . $valor['cpf'] . "</td>";
            echo "<td class='campos'>" . $valor['nascimento'] . "</td>";
            echo "<td class='campos'>" . $valor['email'] . "</td>";
            echo "<td class='campos'>" . $valor['telefone'] . "</td>";
            echo "<td class='campos'>" . $valor['cidade'] . "</td>";
            echo "<td class='campos'>" . $valor['UF'] . "</td>";
            echo "<td class='campos'>" . $valor['fumante'] . "</td>";
            if($valor['quartoHospedado'] == 0){
                echo "<td class='campos'> </td>";
            } else {
                echo "<td class='campos'>" . $valor['quartoHospedado'] . "</td>";
                echo "<td class='campos'>" . $valor['totalDiarias'] . "</td>";
                echo "<td class='campos'>R$ " . $valor['totalPagar'] . "</td></tr></tbody>";
            }
        }
    }

    public function excluiClientes($id)
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "delete from hospedes where id = $id");
    }


    //---------------------------------------------- QUARTOS --------------------------------------------------------//


    public function cadastraQuarto($localizacao, $fumante, $valorDiaria, $capacidade)
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "insert into quartos values (default, '$localizacao', '$fumante', '$valorDiaria', '$capacidade',default ,default)");
    }


    public function editaQuarto($IDQuarto, $localizacao, $fumante, $valorDiaria, $capacidade, $situacao)
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "update quartos set localizacao = '$localizacao', fumante = '$fumante', valorDiaria = '$valorDiaria', capacidade = '$capacidade', situacao = '$situacao' where id  = $IDQuarto");
    }


    public function listaQuartos()
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "select * from quartos");

        echo "<thead><tr><th class='campos'>ID</th>";
        echo "<th class='campos'>Localização</th>";
        echo "<th class='campos'>Fumante</th>";
        echo "<th class='campos'>Valor da Diária</th>";
        echo "<th class='campos'>Capacidade</th>";
        echo "<th class='campos'>Situação</th>";
        echo "<th class='campos'>Hospede</th></tr></thead>";



        while ($valor = mysqli_fetch_assoc($sql)) {
            echo "<tbody><tr><td class='campos'><input type='checkbox' name='checked[]' value=" . $valor['id'] . ">[" . $valor['id'] . "]</td>";
            echo "<td class='campos'>" . $valor['localizacao'] . "</td>";
            echo "<td class='campos'>" . $valor['fumante'] . "</td>";
            echo "<td class='campos'>R$ " . $valor['valorDiaria'] . "</td>";
            echo "<td class='campos'>" . $valor['capacidade'] . "</td>";
            echo "<td class='campos'>" . $valor['situacao'] . "</td>";
            if ($valor['nomeHospede'] != '-') {
                echo "<td class='campos'>" . $valor['nomeHospede'] . "</td>";
            }
            else {
                    echo "<td class='campos'> </td>";
                }
        }
    }

    public function listaQuartosPool()
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "select * from quartos");

        while ($valor = mysqli_fetch_assoc($sql)) {
            if ($valor['situacao'] == "Vago") {
                echo "<div class='cubos'>Quarto " . $valor['id'] . "</div>";
            }
            if ($valor['situacao'] == "Ocupado") {
                echo "<div class='cubos' style='background-color:#80142B; color:#c6c6c6;'>Quarto " . $valor['id'] . "</div>";
            }
        }
    }

    public function excluiQuartos($IDQuarto)
    {
        $connection = $this->connection();

        $sql = mysqli_query($connection, "delete from quartos where id = $IDQuarto");
    }


    //------------------------------------- FUNCOES CHECK-IN E CHECK-OUT --------------------------------------------//


    public function fazerCheckIn($cpf, $totalDiarias, $IDQuarto)
    {
        $connection = $this->connection();

        $sql = mysqli_query($connection, "select nome from hospedes where cpf = $cpf");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $nome = $valor['nome'];
        }

        $sql = mysqli_query($connection, "select quartoHospedado from hospedes where cpf = $cpf");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $quartoHospedado = $valor['quartoHospedado'];
        }

        $sql = mysqli_query($connection, "select fumante from hospedes where cpf = $cpf");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $clienteFumante = $valor['fumante'];
        }

        $sql = mysqli_query($connection, "select situacao from quartos where id = $IDQuarto");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $situacao = $valor['situacao'];
        }

        $sql = mysqli_query($connection, "select nomeHospede from quartos where id = $IDQuarto");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $nomeHospede = $valor['nomeHospede'];
        }

        $sql = mysqli_query($connection, "select fumante from quartos where id = $IDQuarto");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $quartoFumante = $valor['fumante'];
        }


        $totalPagar = $this->calculaTotal($IDQuarto, $totalDiarias);

        if ($quartoHospedado == 0 && $situacao == 'Vago') {
            if ($clienteFumante == 'Fumante' && $quartoFumante == 'Fumante') {
                $sql = mysqli_query($connection, "update quartos set situacao = 'Ocupado', nomeHospede = '$nome' where id  = $IDQuarto");
                $sql = mysqli_query($connection, "update hospedes set quartoHospedado = '$IDQuarto', totalDiarias = '$totalDiarias', totalPagar = '$totalPagar' where cpf = $cpf");
                echo "<script>alert(`Check-in realizado com sucesso!`);</script>";
                echo "<script>window.close();</script>";
                //header('Location: ' . 'areaRecepcao.php?listaClientes');
            } elseif ($clienteFumante != 'Fumante' && $quartoFumante == 'Fumante') {
                $sql = mysqli_query($connection, "update quartos set situacao = 'Ocupado', nomeHospede = '$nome' where id  = $IDQuarto");
                $sql = mysqli_query($connection, "update hospedes set quartoHospedado = '$IDQuarto', totalDiarias = $totalDiarias, totalPagar = $totalPagar where cpf = $cpf");
                echo "<script>alert(`Check-in realizado com sucesso!`);</script>";
                echo "<script>window.close();</script>";
            } elseif ($clienteFumante == 'Fumante' && $quartoFumante != 'Fumante') {
                echo "<script>alert(`O cliente é fumante. Escolha uma acomodação para fumantes!`);</script>";
            } elseif ($clienteFumante == 'Não-Fumante' && $quartoFumante == 'Não-Fumante') {
                $sql = mysqli_query($connection, "update quartos set situacao = 'Ocupado', nomeHospede = '$nome' where id  = $IDQuarto");
                $sql = mysqli_query($connection, "update hospedes set quartoHospedado = '$IDQuarto', totalDiarias = $totalDiarias, totalPagar = $totalPagar where cpf = $cpf");
                echo "<script>alert(`Check-in realizado com sucesso!`);</script>";
                echo "<script>window.close();</script>";
            }
        } elseif ($quartoHospedado != 0) {
            echo "<script>alert(`O cliente já está hospedado neste hotel.`);</script>";
            echo "<script>window.close();</script>";
        } elseif ($situacao != 'Vago') {
            echo "<script>alert(`O quarto está ocupado. Encontre outra acomodação para realizar o check-in.`);</script>";
            echo "<script>window.close();</script>";
        }
    }


    public function fazerCheckOut($cpf, $IDQuarto)
    {
        $connection = $this->connection();

        $sql = mysqli_query($connection, "select totalPagar from hospedes where cpf = $cpf");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $totalPagar = $valor['totalPagar'];
        }
        $sql = mysqli_query($connection, "select nome from hospedes where cpf = $cpf");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $nome = $valor['nome'];
        }
        $sql = mysqli_query($connection, "select quartoHospedado from hospedes where cpf = $cpf");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $quartoHospedado = $valor['quartoHospedado'];
        }

        if ($quartoHospedado == $IDQuarto) {
            $sql = mysqli_query($connection, "update quartos set situacao = 'Vago', nomeHospede = '-' where id  = $IDQuarto");
            $sql = mysqli_query($connection, "update hospedes set quartoHospedado = default, totalDiarias = '0', totalPagar = '0' where cpf = $cpf");
            echo "<script>alert(`Check-out realizado com sucesso!`);</script>";
            echo "<script>window.close();</script>";
        } else {
            echo "<script>alert(`Não é possível realizar o Check-out! O(a) cliente não está hospedado no quarto correspondente.`);</script>";
            echo "<script>window.close();</script>";
        }

    }

    public function calculaTotal($IDQuarto, $totalDiarias)
    {
        $connection = $this->connection();
        $sql = mysqli_query($connection, "select valorDiaria from quartos where id = $IDQuarto");
        while ($valor = mysqli_fetch_assoc($sql)) {
            $valorDiaria = $valor['valorDiaria'];
        }
        return $valorDiaria * $totalDiarias;
    }


    //----------------------------------------------- VALIDAÇÕES ---------------------------------------------------//


    public function validaCPF($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }


    public function existeCPF($cpf)
    {
        foreach ($this->cliente as $valor) {
            if ($cpf == $valor->getCpf()) {
                return true;
            }
        }
        return false;
    }


    //------------------------------------- MÉTODOS GETTERS AND SETTERS ---------------------------------------------//


    public function getCliente(): array
    {
        return $this->cliente;
    }


    public function setCliente(array $cliente): void
    {
        $this->cliente = $cliente;
    }


    public function getQuarto(): array
    {
        return $this->quarto;
    }


    public function setQuarto(array $quarto): void
    {
        $this->quarto = $quarto;
    }


    //----------------------------------------- FUNCTION CONNECTION ---------------------------------------------//

    public function connection()
    {
        $conexao = mysqli_connect('localhost', 'root', '');
        $banco = mysqli_select_db($conexao, 'the_gallery_hostel');
        mysqli_set_charset($conexao, 'utf8');
        return $conexao;
    }


    public function loginRecepcao($login, $senha)
    {

        $connection = $this->connection();

        $contLoginVerificado = 0;

        $sql = mysqli_query($connection, "select * from usuarios where login = '$login' and senha = '$senha'");
        $num_rows = mysqli_fetch_row($sql)[0];

        if($num_rows > 0){
            $_SESSION['login'] = $login;
            $_SESSION['senha'] = $senha;
            echo "<script>window.close();</script>";
        } else {
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
            header('location:areaLogin.html');
            echo "<script>window.close();</script>";
        }
    }
}











// ---------------------------------------- INSTANCIA DA CLASSE RECEPCIONISTA -------------------------------------//
// ------------------------------- RECEBE DADOS FORMULARIO E ENVIA PARA AS FUNÇÕES ACIMA --------------------------//


$recepcionista = new Recepcionista();
$connection = $recepcionista->connection();



//------------------------------------------------ LOGIN RECEPCAO --------------------------------------------------//


if ($_POST) {
    if (isset($_POST["entrar"])) {
        $recepcionista->loginRecepcao($_POST['flogin'], $_POST['fsenha']);
    }
}


//----------------------------------------------------- CLIENTES ---------------------------------------------------//

//Adiciona um cliente no banco de dados
if ($_POST) {
    if (isset($_POST["botaoCadastroCliente"])) {
        $recepcionista->cadastraCliente($_POST["fNome"], $_POST["fCPF"], $_POST["fNascimento"], $_POST["fEmail"], $_POST["fTelefone"], $_POST["fCidade"], $_POST["fUF"], $_POST["fFuma"]);
        header('Location: '.'areaRecepcao.php');
    }
}

//Edita um cliente no banco de dados
if($_POST){
    if (isset($_POST["botaoEditaCliente"])) {
        $recepcionista->editaCliente($_POST["fID"], $_POST["fNome"], $_POST["fCPF"], $_POST["fNascimento"], $_POST["fEmail"], $_POST["fTelefone"], $_POST["fCidade"], $_POST["fUF"], $_POST["fFuma"]);
        header('Location: '.'areaRecepcao.php');
    }
}

//Exclui um cliente no banco de dados
if($_POST){
    if (isset($_POST["excluiClientes"])) {
        if(!empty($_POST["checked"])) {
            foreach($_POST["checked"] as $id){
                $recepcionista->excluiClientes($id);
            }
        }
        header('Location: '.'areaRecepcao.php');
    }
}

//----------------------------------------------------- QUARTOS ---------------------------------------------------//

//Adiciona um quarto no banco de dados
if ($_POST) {
    if (isset($_POST["botaoCadastroQuarto"])) {
        $recepcionista->cadastraQuarto($_POST["fLocalizacao"], $_POST["fQuartoFumante"], $_POST["fValorDiaria"], $_POST["fCapacidade"]);
        header('Location: '.'areaRecepcao.php');
    }
}


//Edita um quarto no banco de dados
if($_POST){
    if (isset($_POST["botaoEditaQuarto"])) {
        $recepcionista->editaQuarto($_POST["fID"], $_POST["fLocalizacao"], $_POST["fQuartoFumante"], $_POST["fValorDiaria"], $_POST["fCapacidade"], $_POST["fSituacao"]);
        header('Location: '.'areaRecepcao.php');
    }
}

//Exclui um quarto no banco de dados
if($_POST){
    if (isset($_POST["excluiQuartos"])) {
        if(!empty($_POST["checked"])) {
            foreach($_POST["checked"] as $IDQuarto){
                $recepcionista->excluiQuartos($IDQuarto);
            }
        }
        header('Location: '.'areaRecepcao.php');
    }
}

//--------------------------------------------------- CHECK IN ---------------------------------------------------//

// Manda as informações do formulario para a classe recepcionista fazer check-in
if ($_POST) {
    if (isset($_POST["botaoCheckIn"])) {
        $recepcionista->fazerCheckIn($_POST["fCPF"],$_POST["ftotalDiarias"], $_POST["fQuartoNum"]);
    }
}

// Manda as informações do formulario para a classe recepcionista fazer check-in
if ($_POST) {
    if (isset($_POST["botaoCheckOut"])) {
        $recepcionista->fazerCheckOut($_POST["fCPF"], $_POST["fQuartoNum"]);
    }
}
