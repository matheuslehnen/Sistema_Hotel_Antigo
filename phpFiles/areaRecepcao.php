<?php
require_once 'Recepcionista.php';
$recepcionista = new Recepcionista();
$connection = $recepcionista->connection();

//if ((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
//    header('location:../htmlFiles/index.html');
//}
//$logado = $_SESSION['login'];
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
    <link rel="stylesheet" href="../css/areaRecepcao.css">
</head>
<body>
<main>
    <header>
        <div id="logo"><img src="../img/logoTheGallery.jpg" alt=""></div>
        <?php
        echo "<div id='welcome' <span>Bem vindo " . $_SESSION['login'] . "</span></div>";
        ?>
        <h1><a href="../htmlFiles/index.html">The Gallery Hostel</a></h1>
        <nav class="menu">
            <ul>
                <li id="Menu_Principal_NONE">Menu Principal</li>
                <li><a href="../htmlFiles/index.html">Home</a></li>
                <li><a href="../htmlFiles/Acomodações.html">Acomodações</a></li>
                <li><a href="../htmlFiles/Reservas.html">Reservas</a></li>
                <li><a href="../htmlFiles/Contato.html">Contato</a></li>
                <li><a href="../htmlFiles/index.html" onclick="window.open('../htmlFiles/areaLogin.html', 'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=140, LEFT=500, WIDTH=500, HEIGHT=500');">Login</a></li>
                <li><a href="areaRecepcao.php">Recepção</a></li>
            </ul>
        </nav>
    </header>
    <section id="corpo">
        <div id="fundo">
            <div id="titulo">
                <h2>The Gallery Hostel Floripa</h2>
                <h3>Área reservada para os Recepcionistas!</h3>
            </div>
            <div id="subTitulo">
                <div id="Clientes"><a href='areaRecepcao.php?listaClientes'>Clientes</a></div>
                <div id="Quartos"><a href='areaRecepcao.php?listaQuartos'>Quartos</a></div>
                <div id="poolQuartos"><a href="areaRecepcao.php?poolQuartos">poolQuartos</a></div>
            </div>
            <div id="areaEscolhas">
                <div id="areaEscolhasClientes">
                    <form action="Recepcionista.php" method="post">
                        <div id="addClientes"><a href="../htmlFiles/cadastroCliente.html">addClientes</a></div>
                        <div id="editaClientes"><a href="editaCliente.php">editaClientes</a></div>
                        <input type="submit" class="botoesAreaRecepcao" name="excluiClientes" id="excluiClientes" value="Excluir Clientes">
                        <div id="check-In"><a href="#" onclick="window.open('check-In.php', 'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=140, LEFT=500, WIDTH=500, HEIGHT=500');">Check-In</a></div>
                </div>
                <div id="areaEscolhasQuartos">
                    <div id="addQuartos"><a href="../htmlFiles/cadastroQuarto.html">addQuartos</a></div>
                    <div id="editaQuartos"><a href="editaQuarto.php">editaQuartos</a></div>
                    <input type="submit" class="botoesAreaRecepcao" name="excluiQuartos" id="excluiQuartos" value="Excluir Quartos">
                    <div id="check-Out"><a href='areaRecepcao.php?listaClientes' onclick="window.open('check-Out.php', 'Titulo da Janela', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=140, LEFT=500, WIDTH=500, HEIGHT=500');">Check-Out</a></div>
                </div>
                <div id="poolArea">
                    <?php
                    if (isset($_GET["poolQuartos"])) {
                        $recepcionista->listaQuartosPool();
                    }
                    ?>
                </div>
                <div id="areaResposta">
                    <table id="resposta">
                        <?php
                        if (isset($_GET["listaClientes"])) {
                            $recepcionista->listaClientes();
                        }
                        if (isset($_GET["listaQuartos"])) {
                            $recepcionista->listaQuartos();
                        }
                        ?>
                    </table>
                </div>
            </div>
    </section>
</main>
<footer>
    <a href="https://github.com/matheuslehnen" target="_blank">&copyCopyright 2022 - by Matheus Lehnen</a>
</footer>

</body>
</html>
