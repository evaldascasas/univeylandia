<?php
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";

class ReservaHabitacio
{
  private $idTipusHabitacio;
  private $id_habitacio;
  private $id_usuari;
  private $nom;
  private $cognom1;
  private $cognom2;
  private $doc_iden;
  private $num_persones;
  private $dataEntrada;
  private $dataSortida;
  private $id_pensio;
  private $preu_reserva;

  /* CONSTRUCTORS */
  public function __construct()
  {
      $args = func_get_args();
      $num = func_num_args();
      $f='__construct'.$num;
      if (method_exists($this, $f)) {
          call_user_func_array(array($this,$f), $args);
      }
  }

  public function __construct0()
  {

  }

  public static function comprovarReserves($dataEntrada, $dataSortida, $idTipusHabitacio)
  {
    try {
      $conn = crearConnexio();

      if ($conn->connect_error) {
          die("Connexió fallida: " . $conn->connect_error);
      }

      $sql = "SELECT HABITACIO.id_habitacio, HABITACIO.num_habitacio, TIPUS_HABITACIO.nom_tipus_habitacio, TIPUS_HABITACIO.preu_tipus_habitacio FROM HABITACIO, TIPUS_HABITACIO WHERE NOT EXISTS
      (SELECT * from RESERVA_HABITACIO WHERE
      (($dataEntrada BETWEEN data_entrada AND date_sub(data_sortida, interval +1 day)) OR
      ($dataSortida BETWEEN date_sub(data_entrada, interval -1 day) AND data_sortida) OR
      (data_entrada <= $dataEntrada AND data_sortida >= $dataSortida) OR (data_entrada >= $dataEntrada AND data_sortida <= $dataSortida)) AND
      HABITACIO.id_habitacio = RESERVA_HABITACIO.id_habitacio) AND (HABITACIO.id_tipus_habitacio = TIPUS_HABITACIO.id_tipus_habitacio AND HABITACIO.id_tipus_habitacio = $idTipusHabitacio)";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          echo '<span>HABITACIONS '.$idTipusHabitacio.' LLIURES DEL '.$dataEntrada.' al '.$dataSortida.'';
          echo '<div class="table-responsive">';
          echo '<table class="table table-bordered table-hover table-sm">';
          echo '<thead class="thead-light">';
          echo '<tr>';
          //echo '<th>ID</th>';
          echo '<th>Número habitació</th>';
          echo '<th>Tipus habitació</th>';
          echo '<th>Preu habitació (€)</th>';
          echo '</tr>';
          echo '</thead>';

          while ($row = $result->fetch_assoc()) {
            $id_hab = $row['id_habitacio'];
            $num_hab = $row['num_habitacio'];
            //$id_tipus_hab = $row['id_tipus_habitacio'];
            $tipus_hab = $row['nom_tipus_habitacio'];
            $preu_habitacio = $row['preu_tipus_habitacio'];

            echo '<tbody>';
            echo '<tr>';
            echo '<td style="display:none;">'.$id_hab.'</td>';
            echo '<td>'.$num_hab.'</td>';
            echo '<td>'.$tipus_hab.'</td>';
            echo '<td>'.$preu_habitacio.'</td>';
            echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSeleccionar'.$id_hab.'">Seleccionar</button></td>';
            echo '</tr>';
            echo '</tbody>';

            /* MODAL PER SELECCIONAR */
            echo '<!-- Modal -->';
            echo '<div class="modal fade" id="modalSeleccionar'.$id_hab.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
            echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
            echo '    <div class="modal-content">';
            echo '      <div class="modal-header">';
            echo '        <h5 class="modal-title">Seleccionar Habitació</h5>';
            echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '          <span aria-hidden="true">&times;</span>';
            echo '        </button>';
            echo '      </div>';
            echo '      <div class="modal-body">';
            echo '        <div class="container">';
            echo '          <form method="post">';
            echo '            <div class="form-row">';
            echo '              <div class="col-md-12 mb-3" style="display: none;">';
            echo '                <input class="form-control" type="text" value="'.$id_hab.'" name="id_hab">';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="num_habitacio">Número habitació</label>';
            echo '                <input disabled class="form-control" type="text" value="'.$num_hab.'" name="num_hab_mod">';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="data_entrada">Data Entrada</label>';
            echo '                <input disabled class="form-control" type="date" value="'.$dataEntrada.'" name="data_entrada">';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="data_sortida">Data Sortida</label>';
            echo '                <input disabled class="form-control" type="date" value="'.$dataSortida.'" name="data_sortida">';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="nom">Nom *</label>';
            echo '                <input class="form-control" type="text" name="nom" required>';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="cognom1">Cognom 1 *</label>';
            echo '                <input class="form-control" type="text" name="cognom1" required>';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="cognom2">Cognom 2</label>';
            echo '                <input class="form-control" type="text" name="cognom2">';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="dni">Nº Document Identitat *</label>';
            echo '                <input class="form-control" type="text" name="dni" required>';
            echo '              </div>';
            echo '              <div class="col-md-12 mb-3">';
            echo '                <label for="tipus_pensio">Tipus Pensió</label>';
            echo '                <div class="input-group">';
            echo '                  <select class="form-control form-control-sm" name="tipus_pensio" required>';
            include_once $_SERVER['DOCUMENT_ROOT']."/php/classes/classeHabitacio.php";
            Habitacio::llistarTipusHabitacio();
            echo '                  </select>';
            echo '                </div>';
            echo '              </div>';
            echo '            </div>';
            echo '            <input type="submit" class="btn btn-primary" name="modificar" value="Reservar">';
            echo '            <input type="button" class="btn btn-secondary" data-dismiss="modal" name="cancelar" value="Cancel·lar">';
            echo '          </form>';
            echo '        </div>';
            echo '       </div>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
          }
      } else {
          echo "0 resultats";
      }
      //echo '<script>alert("Registre introduit.");</script>';
      $conn->close();

    }
    catch (Exception $e) {
      echo '<script>alert("Error al buscar reserves");</script>';
    }

  }





}

 ?>
