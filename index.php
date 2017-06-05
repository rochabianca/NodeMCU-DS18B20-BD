<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>NodeMCU - Temperaturas</title>
        <!--Descomentar a linha abaixo para ativar o refresh automatico-->
        <!--<meta http-equiv="refresh" content="60; http://localhost/NodeMCU-DS18B20-BD/index.php">-->
        <meta name="description" content="Temperaturas registradas com o nodemcu e o sensor de temperatura ds18b20">

        <meta property="og:type" content="website"/>
        <meta property="og:title" content="NodeMCU - Temperaturas"/>
        <meta property="og:description" content="Temperaturas registradas com o nodemcu e o sensor de temperatura ds18b20"/>
        <meta property="og:url" content="http://localhost/NodeMCU-DS18B20-BD/index.php"/>
        <meta property="og:image" content="http://bikcraft.com/img/og-image.png"/>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Estilos-->
        <link rel="stylesheet" href="css\reset.css">
        <link rel="stylesheet" href="css\grid.css">
        <link rel="stylesheet" href="css/style.css">

        <!--Fontes-->
        <!--<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">-->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet">
    </head>

    <header>
        <a href="http://localhost/NodeMCU-DS18B20-BD/historico.php">Histórico</a>
    </header>

    <body class="fundo">
        <script type="text/javascript">
		    document.documentElement.className += ' js';
	    </script>

        <div class="container">

            <section class="grid-1-3" data-anime="scroll">
                <h2 >Maior temperatura</h2>
                <?php
                include("conecta.php");
                $maiorTemperatura = mysql_query("SELECT * FROM dados ORDER BY temperatura DESC LIMIT 1");
                $menorTemperatura = mysql_query("SELECT * FROM dados ORDER BY temperatura ASC LIMIT 1");

                while($linha = mysql_fetch_array($maiorTemperatura))
                {
                        echo '<h2>'.$linha["temperatura"].' °C</h2>';
                        echo '<h3> em '.date('d/m/Y - H:i:s', strtotime($linha["data"])).'</h3>';
                }
                ?>
            </section>

            <section class="grid-1-3" data-anime="scroll">
                <h1>Última Temperatura Registrada</h1>
                <?php
                    include("conecta.php");
                    $ultimaTemperatura = mysql_query("SELECT * FROM dados ORDER BY id DESC LIMIT 1");
                    $maiorTemperatura = mysql_query("SELECT * FROM dados ORDER BY temperatura DESC LIMIT 1");
                    $menorTemperatura = mysql_query("SELECT * FROM dados ORDER BY temperatura ASC LIMIT 1");

                    while($linha = mysql_fetch_array($ultimaTemperatura))
                    {
                            echo '<h1>'.$linha["temperatura"].' °C</h1>';
                            echo '<h2> em '.date('d/m/Y - H:i:s', strtotime($linha["data"])).'</h2>';
                    }
                ?>
            </section>

            <section class="grid-1-3" data-anime="scroll">
            <h2>Menor temperatura</h2>
            <?php
                include("conecta.php");
                $menorTemperatura = mysql_query("SELECT * FROM dados ORDER BY temperatura ASC LIMIT 1");

                while($linha = mysql_fetch_array($menorTemperatura))
                {
                        echo '<h2>'.$linha["temperatura"].' °C</h2>';
                        echo '<h3> em '.date('d/m/Y - H:i:s', strtotime($linha["data"])).'</h3>';
                }
            ?>
            </section>
    </div>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
  </body>

</html>