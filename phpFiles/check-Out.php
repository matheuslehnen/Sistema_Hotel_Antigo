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
    <link rel="stylesheet" href="../css/check-Out.css">
</head>
<body>
<main>
    <header>
        <div id="logo"><img src="../img/logoTheGallery.jpg" alt=""></div>
        <h1><a href="../htmlFiles/index.html">The Gallery Hostel</a></h1>
    </header>
    <section id="corpo">
        <div id="fundo">
            <div id="titulo">
                <h2>The Gallery Hostel Floripa</h2>
            </div>
            <form action="Recepcionista.php" method="post" id="formCheckIn">
                <fieldset class="fs">
                    <legend><h3>Check-Out</h3></legend>
                    <label for="fCPF">CPF: <input type="text" id="fCPF" name="fCPF" placeholder="CPF do cliente"></label><br>
                    <label for="fquartoNumOut">Liberar quarto:
                        <select name="fQuartoNum" id="fQuartoNum">
                            <?php  //FAZER APARECER APENAS OS QUARTOS OCUPADOS
                            $sql = mysqli_query($connection, "select id from quartos where situacao = 'Ocupado';");

                            while ($valor = mysqli_fetch_assoc($sql)) {
                                echo "<option value='$valor[id]'>" .  $valor['id'] . "</option>";
                            }
                            ?>
                        </select>
                    </label><br>
                    <input id="botaoCheckOut" name="botaoCheckOut" class="botoesRecepcao" type="submit">
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

