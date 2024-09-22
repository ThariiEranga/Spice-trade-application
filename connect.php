<?php
//database connection details
$servername = "localhost:8000";
$un = "root";
$pw = "";
$databasename = "spice_trade";

$connect  = mysqli_connect($servername,$un,$pw,$databasename);

if($connect==false){
    echo("Error:can't connect to the database");
}
?>
