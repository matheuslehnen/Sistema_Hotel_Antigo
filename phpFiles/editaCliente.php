<?php
require_once 'Recepcionista.php';
$recepcionista = new Recepcionista();
$connection = $recepcionista->connection();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercicio Desafio Hotel</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/editaCliente.css">

</head>
<body>
<main>
    <header>
        <div id="logo"><img src="../img/logoTheGallery.jpg" alt=""></div>
        <h1><a href="../htmlFiles/index.html">The Gallery Hostel</a></h1>
        <nav class="menu">
            <ul>
                <li id="Menu_Principal_NONE">Menu Principal</li>
                <li><a href="../htmlFiles/index.html">Home</a></li>
                <li><a href="../htmlFiles/Acomodações.html">Acomodações</a></li>
                <li><a href="../htmlFiles/Reservas.html">Reservas</a></li>
                <li><a href="../htmlFiles/Contato.html">Contato</a></li>
                <li><a href="../htmlFiles/index.html" onclick="window.open('areaLogin.php', 'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=140, LEFT=500, WIDTH=500, HEIGHT=500');">Login</a></li>
                <li><a href="areaRecepcao.php">Recepção</a></li>
            </ul>
        </nav>
    </header>
    <section id="corpo">
        <div id="fundo">
            <div id="titulo">
                <h2>The Gallery Hostel Floripa</h2>
                <h3>Area reservada para recepção.</h3>
            </div>
            <form action="Recepcionista.php" method="post" id="formularioEditaCliente">
                <fieldset class="fs">
                    <legend>Edite o cliente </legend>
                    <label for="fID">ID:
                            <select name="fID" id="fID">
                                <?php
                                $sql = mysqli_query($connection, "select id from hospedes order by id");

                                while ($valor = mysqli_fetch_assoc($sql)) {
                                    echo "<option value='$valor[id]'>" .  $valor['id'] . "</option>";
                                }
                                ?>
                            </select>
                        </label><br>
                    <label for="fNome">Nome: <input type="text" id="fNome" name="fNome" size="20" maxlength="30" placeholder="Nome Completo"></label><br>
                    <label for="fCPF">CPF: <input type="text" id="fCPF" name="fCPF"
                                                  placeholder="CPF do cliente"></label><br>
                    <label for="fNascimento">Nascimento: <input type="text" id="fNascimento" name="fNascimento"
                                                                placeholder="Data de Nascimento"></label><br>
                    <label for="fEmail">Email: <input type="email" id="fEmail" name="fEmail" size="20" maxlength="40"
                                                      placeholder="Email"></label><br>
                    <label for="fTelefone">Telefone<input type="tel" id="fTelefone" name="fTelefone"
                                                          placeholder="(xx)xxxx-xxxx"></label><br>
                    <label for="fCidade">Cidade: <input type="text" id="fCidade" name="fCidade"
                                                        placeholder="Cidade"></label><br>
                    <label for="fUF">UF:</label>
                    <select id="fUF" name="fUF">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC" selected="selected">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        <option value="DF">Distrito Federal</option>
                    </select><br>
                    <fieldset class="fieldsetinterno">
                        <legend>Fumante:</legend>
                        <label for="fumante">Sim<input type="radio" id="fumante" name="fFuma" class="fFuma"
                                                       value="1"></label>
                        <label for="Nao-fumante">Não<input type="radio" id="Nao-fumante" name="fFuma" class="fFuma"
                                                           value="0"></label>
                    </fieldset>
                    <input id="botaoEditaCliente" name="botaoEditaCliente" class="botoesRecepcao" type="submit">
                </fieldset>
            </form>
        </div>
    </section>
</main>
    <footer>
        <a href="https://github.com/matheuslehnen" target="_blank">&copyCopyright 2022 - by Matheus Lehnen</a>
    </footer>
</body>
</html>
