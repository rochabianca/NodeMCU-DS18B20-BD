<?php
include("conecta.php");

$temperatura = $_GET['temperatura'];

$sql_insert = "insert into dados (temperatura) values ('$temperatura')";

mysql_query($sql_insert);

if($sql_insert) {
    echo "salvo com sucesso";
}
else {
    echo "erro";
}

?>