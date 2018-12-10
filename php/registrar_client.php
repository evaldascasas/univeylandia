<?php
include_once("connection.php");
include_once("class/class_client.php");

$client = new client($_POST["nom"], $_POST["cognom1"], $_POST["cognom2"], $_POST["email"], $_POST["contrasenya"], $_POST["date"], $_POST["adreca"], $_POST["ciutat"], $_POST["provincia"], $_POST["cp"], $_POST["tipus_document"], $_POST["numero_document"],  $_POST["sexe"], $_POST['telefon']);

  $client->inserir_client();
  $client->validar_client();

?>
