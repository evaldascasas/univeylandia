<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/class/classeHabitacio.php";
if (isset($_POST['Exportar'])) {
  Habitacio::llistatHabitacionsPDF();
}
?>
