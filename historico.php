<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>NodeMCU + DS18B20 - Histórico</title>
        
        <meta name="description" content="Temperaturas registradas com o nodemcu e o sensor de temperatura ds18b20">

        <meta property="og:type" content="website"/>
        <meta property="og:title" content="NodeMCU + DS18B20 - Histórico"/>
        <meta property="og:description" content="Temperaturas registradas com o nodemcu e o sensor de temperatura ds18b20"/>
        <meta property="og:url" content="http://localhost/arduino/index.php"/>
        <meta property="og:image" content="http://bikcraft.com/img/og-image.png"/>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Estilos-->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/grid.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css\historico.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!--Fontes-->
        <!--<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">-->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet">
    </head>

    <header>
        <a href="http://localhost/NodeMCU-DS18B20-BD/index.php">Voltar</a>
        <h1 data-anime="scroll">NodeMCU + DS18B20 - Histórico</h1>
    </header>

    <body>
        <script type="text/javascript">
		    document.documentElement.className += ' js';
	    </script>

        <section class="container fundo">
            
            <table class="table table-responsive" data-anime="scroll">
                <tr class=" info">
                    <td>ID</td>
                    <td>Data e Hora</td>
                    <td>Temperatura</td>
                </tr>
                
                    <?php
                        include("conecta.php");
                        $resultado = mysql_query("select * from dados order by id desc");

                        while($linha = mysql_fetch_array($resultado))
                        {
                            echo '<tr>';
                                echo '<td>'.$linha["id"].'</td>';
                                echo '<td>'.date('d/m/Y - H:i:s', strtotime($linha["data"])).'</td>';
                                echo '<td>'.$linha["temperatura"].'</td>';
                        echo '</tr>';
                        }

                    ?>
            
            </table>
        </section>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	    <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>