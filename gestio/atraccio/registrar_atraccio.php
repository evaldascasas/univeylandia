
<?php
//include_once("php/class/class_atraccio.php");
include_once $_SERVER['DOCUMENT_ROOT']."/php/class/classeAtraccio.php";

$Atraccio = new Atraccio ($_POST['nom'],$_POST['tipusatraccio'],$_POST['datainauguracio'],$_POST['alturamin'],$_POST['alturamax'],$_POST['accessible'],$_POST['accesexpress']);

$Atraccio->Registrar();




if($Atraccio->Registrar() == true){
  //header('Location: ./registreAtraccions.php');
    header('Location: ./registreAtraccions.php');
}


 ?>
