<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/classes/classeClient.php";

if (!empty($_POST)) {
  $client = new Client($_POST['email'],$_POST['password']);

  if($client->validarLogin() == false)
  {
    include_once $_SERVER['DOCUMENT_ROOT']."/php/classes/classeEmpleat.php";
    $empleat = new Empleat($_POST['email'],$_POST['password']);
    if($empleat->validarLogin() == false)
    {
      echo "NO ESTAS REGISTRAT";
    }
    else {
      header('Location: ../gestio/index.php');
    }
  }
  else {
    header('Location: ../index.php');
  }
  /*else
  {
    if (array_key_exists('remember', $_POST)) {
        // Crear una nova cookie de sessió que expira en 7 dies
        setcookie('idu', '1', time() + 7 * 24 * 60 * 60);
        //Reemplaçar el ID de la sessio actual amb una nova i mantenir la informació de la sessio actual
        session_regenerate_id(true);
    } elseif (!$_POST['remember']) {
        //Si hi ha una COOKIE creada, atrassar-la en el temps per a que la elimine
        if (isset($_COOKIE['idu'])) {
            $past = time() - 100;
            setcookie(idu, gone, $past);
        }
    }

  }*/


}

 ?>
