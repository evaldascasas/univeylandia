<?php
include_once("connection.php");
include_once("class/class_noticia.php");

$noticia = new noticia($_POST["titol_noticia"], $_POST["descripcio_noticia"], $_POST["data_noticia"]);

  $noticia->inserir_noticia();
  $noticia->validar_noticia();

?>
