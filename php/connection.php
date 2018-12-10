<?php

function crearConnexio(){
  $server = "localhost";
  $usuari = "g1gestio";
  $passwd = "g1gestio";
  $namedb = "univeylandia";

  $connection= new mysqli($server, $usuari, $passwd, $namedb);

  if($connection->connect_error){
    die("Error: ". $connection->connect_error);
  }
  //echo "Conexio correcta";
  return $connection;
}

?>
