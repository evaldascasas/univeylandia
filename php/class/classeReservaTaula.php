<?php
/**
 * classeReservaTaula.php: conté els atributs i mètodes de la classe ReservaTaula.
 */
/**
 * include_once de la connexió a la BD.
 */
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";
/**
 * [Classe reservaTaula es per a inserir, modificar, eliminar, consultar reserves]
 */
class reservaTaula
{
    /** @var string Guarda el nom */
    private $nom;
    /** @var string Guarda el cognom */
    private $cognom;
    /** @var string Guarda el segon cognom */
    private $cognom2;
    /** @var date Guarda la data de la reserva */
    private $data;
    /** @var time Guarda L'hora de la reserva */
    private $hora;
    /** @var int Guarda el numero de persones */
    private $numeroPax;

    /**
     * Constructor de la classe.
     */
    public function __construct()
    {
        $args = func_get_args();
        $num = func_num_args();
        $f='__construct'. $num;
        if (method_exists($this, $f)) {
            call_user_func_array(array($this,$f), $args);
        }
    }

    /**
     * Contructor que s'utilitza per crear un objecte ReservaTaula amb 2 paràmetres.
     * @param  int $numeroPax numero de persones de la reserva
     * @param  date $data      data de reserva
     * @return void
     */
    public function __construct2($numeroPax, $data)
    {
        $this->numeroPax= $numeroPax;
        $this->data= $data;
    }

    /**
     * Constructor que s'utilitza per crear un objecte ReservaTaula amb 6 paràmetres per crear una reserva.
     * @param  [String] $nom       [Nom del client]
     * @param  [String] $cognom    [Cognom del client]
     * @param  [String] $cognom2   [Segon cognom del client]
     * @param  [date] $data      [data de la reserva]
     * @param  [time] $hora      [hora de la reserva]
     * @param  [integer] $numeroPax [Persones de la reserva]
     * @return [type]            [no retorna res]
     */
    public function __construct6($nom, $cognom, $cognom2, $data, $hora, $numeroPax)
    {
        $this->nom = $nom;
        $this->cognom = $cognom;
        $this->cognom2 = $cognom2;
        $this->data = $data;
        $this->hora = $hora;
        $this->numeroPax = $numeroPax;
    }

    /**
     * consultarLliures Mètode per a consultar les taules lliures cuant volem inserir una reserva un dia determinat
     * @param  integer $numeroPax número de persones
     * @param  date $dataHora data de reserva
     * @return void
     */
    public static function consultarLliures($numeroPax, $dataHora)
    {
        $aforo = 300;
        $numeroPax;
        $nom="";
        $cognom="";
        $cognom2="";
        $hora="";

        $conn = crearConnexio();

        $sql = "select id_taula, numero_taula from TAULA where not exists
    (select id_taula from RESERVA_TAULA where TAULA.id_taula = RESERVA_TAULA.id_taula and RESERVA_TAULA.data_reserva = '$dataHora')";

        $sql2 = "SELECT sum(num_persones) totalPersones FROM `RESERVA_TAULA`";

        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        while ($row = $result2->fetch_assoc()) {
            $personesReserva = $row['totalPersones'];
        }
        $personesTotal = $numeroPax + $personesReserva;

        if ($personesTotal < $aforo) {
            if ($result->num_rows > 0) {
                echo '<br/>';
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered table-hover table-sm">';
                echo '<thead class="thead-light">';
                echo '<tr>';
                echo '<th>Numero_Taula';

                while ($row = $result->fetch_assoc()) {
                    $id_taula = $row['id_taula'];

                    $numero_taula = $row['numero_taula'];
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td style="display:none;">'.$id_taula.'</td>';
                    echo '<td>'.$numero_taula.'</td>';
                    echo '<td><button class="btn btn-primary" data-toggle="modal" data-target="#modalReservar'.$id_taula.'">Seleccionar</button></td>';
                    echo '</tr>';
                    echo '</tbody>';

                    echo '<div class="modal fade" id="modalReservar'.$id_taula.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                    echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                    echo '    <div class="modal-content">';
                    echo '      <div class="modal-header">';
                    echo '        <h5 class="modal-title">Inserir reserva Taula</h5>';
                    echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    echo '          <span aria-hidden="true">&times;</span>';
                    echo '        </button>';
                    echo '      </div>';
                    echo '      <div class="modal-body">';
                    echo '        <div class="container">';
                    echo '          <form method="post">';
                    echo '            <div class="form-row">';
                    echo '              <div class="col-md-12 mb-3" style="display: none;">';
                    echo '                <input class="form-control" type="text" value="'.$id_taula.'" name="id_taula">';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="num_habitacio">Número Taula</label>';
                    echo '                <input  class="form-control" type="text" value="'.$numero_taula.'" name="numero_Taula2">';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="Dia_Reserva">Dia Reserva</label>';
                    echo '                <input  class="form-control" type="text" value="'.$dataHora.'" name="Dia_Reserva">';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="Dia_Reserva">Num Pax</label>';
                    echo '                <input  class="form-control" type="text" value="'.$numeroPax.'" name="numPer">';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="tipus_habitacio">Nom Client</label>';
                    echo '                <input type="text" class="form-control form-control-sm" placeholder="Nom" value="'.$nom.'"name="nom" required>';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="tipus_habitacio">Cognom Client</label>';
                    echo '                <input type="text" class="form-control form-control-sm" placeholder="Primer Cognom" value="'.$cognom.'"name="cognom" required>';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="tipus_habitacio">Segon Cognom Client</label>';
                    echo '                <input type="text" class="form-control form-control-sm" placeholder="Segon Cognom" value="'.$cognom2.'"name="cognom2" required>';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <label for="tipus_habitacio">Hora arribada</label>';
                    echo '                <input type="time" class="form-control form-control-sm" placeholder="Hora arribada" value="'.$hora.'"name="hora" required>';
                    echo '              </div>';
                    echo '              <div class="col-md-12 mb-3">';
                    echo '                <input  type="submit" class="btn btn-primary" name="InsertReservaTaula" value="Inserir Reserva" px-5 py-5>';
                    echo '                <input  type="button" class="btn btn-secondary" data-dismiss="modal" name="cancelar" value="Cancel·lar" px-5 py-5>';
                    echo '              </div>';
                    echo '          </form>';
                    echo '        </div>';
                    echo '       </div>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
                echo '</table>';
                echo '</div>';
            }
        } else {
            echo '<script>alert("Atenció aforo complet!");</script>';
        }
    }

    /**
     * inserirReserva Metode per a inserir reserva
     * @param  string $nom     Rebra per parametre el nom del client
     * @param  string $cognom  Rebra per parametre el cognom del client
     * @param  string $cognom2 Rebra per parametre el segon cognom del client
     * @param  date $hora    Rebra per parametre la data de la reserva
     * @return void
     */
    public function inserirReserva($nom, $cognom, $cognom2, $hora)
    {
        $idTaula = $_POST['id_taula'];
        $numTaula = $_POST['numero_Taula2'];
        $dia = $_POST['Dia_Reserva'];
        $numPax = $_POST['numPer'];

        $conn = crearConnexio();

        if ($conn->connect_error) {
            die("Connexió fallida: " . $conn->connect_error);
        }

        $sql = "INSERT INTO RESERVA_TAULA (id_taula, num_persones, data_reserva, nom, cognom, cognom2, hora)
                VALUES ('$idTaula','$numPax','$dia','$nom','$cognom','$cognom2','$hora')";

        $result = mysqli_query($conn, $sql);

        if ($result ==  false) {
            echo '<script>alert("Error al introduir registre.");</script>';
        } else {
            echo '<script>alert("Registre introduit correctament.");</script>';
        }

        $conn->close();
    }

    /**
     * llistarReserves Metode per a llistar les reserves
     * @return void
     */
    public function llistarReserves()
    {
        $conn = crearConnexio();

        $sql= "SELECT * FROM RESERVA_TAULA";

        $result=$conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-sm">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th>Numero_Taula';
            echo '<th> nom';
            echo '<th>  cognom';
            echo '<th> cognom2';
            echo '<th> data';
            echo '<th>hora';
            echo '<th> Num_Pax';

            while ($row = $result->fetch_assoc()) {
                $id_reserva = $row ['id_linia_reserva_taula'];
                $numero_taula = $row['id_taula'];
                $nom = $row['nom'];
                $cognom =  $row ['cognom'];
                $cognom2 = $row['cognom2'];
                $data = $row ['data_reserva'];
                $hora = $row['hora'];
                $numPax = $row['num_persones'];

                echo '<tbody>';
                echo '<tr>';
                echo '<td style="display:none;">'.$id_reserva.'</td>';
                echo '<td>'.$numero_taula.'</td>';
                echo '<td>'.$nom.'</td>';
                echo '<td>'.$cognom.'</td>';
                echo '<td>'.$cognom2.'</td>';
                echo '<td>'.$data.'</td>';
                echo '<td>'.$hora.'</td>';
                echo '<td>'.$numPax.'</td>';
                echo '<td></td>';
                echo '<td><button class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$id_reserva.'">Modificar</button></td>
                     <td><button class="btn btn-secondary"data-toggle="modal" data-target="#ModalEliminar'.$id_reserva.'">Eliminar</button></td>';
                echo '</tr>';
                echo '</tbody>';

                echo '<!-- Modal -->';

                /* Modal modificarReserva */
                echo '<div class="modal fade" id="modalModificar'.$id_reserva.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                echo '    <div class="modal-content">';
                echo '      <div class="modal-header">';
                echo '        <h5 class="modal-title">Modificar Reserva</h5>';
                echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '          <span aria-hidden="true">&times;</span>';
                echo '        </button>';
                echo '      </div>';
                echo '      <div class="modal-body">';
                echo '        <div class="container">';
                echo '          <form method="post">';
                echo '            <div class="form-row">';
                echo '              <div class="col-md-12 mb-3" style="display: none;">';
                echo '                <input class="form-control" type="text" value="'.$id_reserva.'" name="id_reserva">';
                echo '              </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label for="num_habitacio">Número Taula</label>';
                echo '                <input disabled class="form-control" type="text" value="'.$numero_taula.'" name="numero_Taula">';
                echo '              </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Nom</label>';
                echo '                <input type="text" class="form-control form-control-sm" placeholder="Nom" value="'.$nom.'"name="nom" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Cognom</label>';
                echo '                <input type="text" class="form-control form-control-sm" placeholder="cognom" value="'.$cognom.'"name="cognom" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Cognom2</label>';
                echo '                <input type="text" class="form-control form-control-sm" placeholder="Cognom2" value="'.$cognom2.'"name="cognom2" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Data</label>';
                echo '                <input type="date" class="form-control form-control-sm" value="'.$data.'"name="data" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Hora</label>';
                echo '                <input type="time" class="form-control form-control-sm" value="'.$hora.'"name="hora" required>';
                echo '              </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Num Pax</label>';
                echo '                <input type="number" class="form-control form-control-sm" value="'.$numPax.'"name="numPer" required>';
                echo '              </div>';
                echo '            </div>';
                echo '            <input type="submit" class="btn btn-primary" name="modificar" value="Modificar">';
                echo '            <input type="button" class="btn btn-secondary" data-dismiss="modal" name="cancelar" value="Cancel·lar">';
                echo '          </form>';
                echo '        </div>';
                echo '       </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';

                /* MODAL PER ELIMINAR */
                echo '<!-- Modal -->';
                echo '<div class="modal fade" id="ModalEliminar'.$id_reserva.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                echo '    <div class="modal-content">';
                echo '       <div class="modal-header">';
                echo '          <h5 class="modal-title">Atenció!</h5>';
                echo '          <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '            <span aria-hidden="true">&times;</span>';
                echo '          </button>';
                echo '       </div>';
                echo '       <div class="modal-body">';
                echo '          <div class="container">';
                echo '            <form method="post">';
                echo '              <div class="form-row">';
                echo '                <div class="col-md-12 mb-3">';
                echo '                  <div class="input-group">';
                echo '                    <input class="form-control" type="text" value="'.$id_reserva.'" name="id_taula" style="display: none;">';
                echo '                    <span>Segur que vols eliminar aquessta Reserva?</span>';
                echo '                  </div>';
                echo '                </div>';
                echo '              </div>';
                echo '              <input type="submit" class="btn btn-primary" name="eliminar" value="Eliminar">';
                echo '              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>';
                echo '            </form>';
                echo '          </div>';
                echo '       </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning">
                     <strong>Atenció!</strong> No hi ha registres.
                   </div>';
        }
        $conn->close();
    }

    /**
     * llistarReservesBusqueda Metode per a llistar les reserves del buscador
     * @return void
     */
    public static function llistarReservesBusqueda()
    {
        $conn = crearConnexio();

        $filtre = $_POST['busqueda_reserva'];

        $sql ="SELECT * FROM RESERVA_TAULA WHERE nom LIKE '%$filtre%' /*OR cognom LIKE '%$filtre%'*/";
        $result = $conn->query($sql);

        if (!$result) {
            throw new Exception();
        }

        if ($result->num_rows > 0) {
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-sm">';
            echo '<thead class="thead-light">';
            echo '<tr>';
            echo '<th>Numero_Taula';
            echo '<th> nom';
            echo '<th>  cognom';
            echo '<th> cognom2';
            echo '<th> data';
            echo '<th>hora';
            echo '<th> Num_Pax';

            while ($row = $result->fetch_assoc()) {
                $id_reserva = $row ['id_linia_reserva_taula'];
                $numero_taula = $row['id_taula'];
                $nom = $row['nom'];
                $cognom =  $row ['cognom'];
                $cognom2 = $row['cognom2'];
                $data = $row ['data_reserva'];
                $hora = $row['hora'];
                $numPax = $row['num_persones'];

                echo '<tbody>';
                echo '<tr>';
                echo '<td style="display:none;">'.$id_reserva.'</td>';
                echo '<td>'.$numero_taula.'</td>';
                echo '<td>'.$nom.'</td>';
                echo '<td>'.$cognom.'</td>';
                echo '<td>'.$cognom2.'</td>';
                echo '<td>'.$data.'</td>';
                echo '<td>'.$hora.'</td>';
                echo '<td>'.$numPax.'</td>';

                echo '<td></td>';
                echo '<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalModificar'.$id_reserva.'">Modificar</button>
                       <button class="btn btn-secondary btn-sm ml-4"data-toggle="modal" data-target="#ModalEliminar'.$id_reserva.'">Eliminar</button></td>';
                echo '</tr>';
                echo '</tbody>';

                echo '<!-- Modal -->';
                /*modal Modificar Reserva*/
                echo '<div class="modal fade" id="modalModificar'.$id_reserva.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                echo '    <div class="modal-content">';
                echo '      <div class="modal-header">';
                echo '        <h5 class="modal-title">Modificar Reserva</h5>';
                echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '          <span aria-hidden="true">&times;</span>';
                echo '        </button>';
                echo '      </div>';
                echo '      <div class="modal-body">';
                echo '        <div class="container">';
                echo '          <form method="post">';
                echo '            <div class="form-row">';
                echo '              <div class="col-md-12 mb-3" style="display: none;">';
                echo '                <input class="form-control" type="text" value="'.$id_reserva.'" name="id_reserva">';
                echo '              </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label for="num_habitacio">Número Taula</label>';
                echo '                <input disabled class="form-control" type="text" value="'.$numero_taula.'" name="numero_Taula">';
                echo '              </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Nom</label>';
                echo '                <input type="text" class="form-control form-control-sm" placeholder="Nom" value="'.$nom.'"name="nom" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Cognom</label>';
                echo '                <input type="text" class="form-control form-control-sm" placeholder="cognom" value="'.$cognom.'"name="cognom" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Cognom2</label>';
                echo '                <input type="text" class="form-control form-control-sm" placeholder="Cognom2" value="'.$cognom2.'"name="cognom2" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Data</label>';
                echo '                <input type="date" class="form-control form-control-sm" value="'.$data.'"name="data" required>';
                echo '            </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Hora</label>';
                echo '                <input type="time" class="form-control form-control-sm" value="'.$hora.'"name="hora" required>';
                echo '              </div>';
                echo '              <div class="col-md-12 mb-3">';
                echo '                <label>Num Pax</label>';
                echo '                <input type="number" class="form-control form-control-sm" value="'.$numPax.'"name="numPer" required>';
                echo '              </div>';
                echo '            </div>';
                echo '            <input type="submit" class="btn btn-primary" name="modificar" value="Modificar">';
                echo '            <input type="button" class="btn btn-secondary" data-dismiss="modal" name="cancelar" value="Cancel·lar">';
                echo '          </form>';
                echo '        </div>';
                echo '       </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';

                /* MODAL PER ELIMINAR */
                echo '<!-- Modal -->';
                echo '<div class="modal fade" id="ModalEliminar'.$id_reserva.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                echo '    <div class="modal-content">';
                echo '       <div class="modal-header">';
                echo '          <h5 class="modal-title">Atenció!</h5>';
                echo '          <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '            <span aria-hidden="true">&times;</span>';
                echo '          </button>';
                echo '       </div>';
                echo '       <div class="modal-body">';
                echo '          <div class="container">';
                echo '            <form method="post">';
                echo '              <div class="form-row">';
                echo '                <div class="col-md-12 mb-3">';
                echo '                  <div class="input-group">';
                echo '                    <input class="form-control" type="text" value="'.$id_reserva.'" name="id_taula" style="display: none;">';
                echo '                    <span>Segur que vols eliminar aquesta habitació?</span>';
                echo '                  </div>';
                echo '                </div>';
                echo '              </div>';
                echo '              <input type="submit" class="btn btn-primary" name="eliminar" value="Eliminar">';
                echo '              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>';
                echo '            </form>';
                echo '          </div>';
                echo '       </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</table>';
            echo '</div>';
        } else {
            echo '<div class="alert alert-warning">
                     <strong>Atenció!</strong> No hi ha taules lliures.
                   </div>';
        }
        $conn->close();
    }

    /**
     * modificarReserva Mètode per a modificar la reserva de taula
     * @return void
     */
    public function modificarReserva()
    {
        $conn = crearConnexio();

        if ($conn->connect_error) {
            die("Connexió fallida: " . $conn->connect_error);
        }

        $id_reserva = $_POST['id_reserva'];
        $nom_mod = $_POST['nom'];
        $cognom_mod = $_POST['cognom'];
        $cognom2_mod =   $_POST['cognom2'];
        $data_mod = $_POST['data'];
        $hora_mod = $_POST['hora'];
        $per_mod = $_POST['numPer'];
        $aforo = 300;
        $perTotal;

        $sql2 = "SELECT sum(num_persones) totalPersones FROM `RESERVA_TAULA`";

        $result2= mysqli_query($conn, $sql2);

        while ($row = $result2->fetch_assoc()) {
            $personesReserva = $row['totalPersones'];
        }

        $perTotal = $personesReserva + $per_mod;

        if ($perTotal <  $aforo) {
            $sql  = "UPDATE RESERVA_TAULA SET data_reserva = '$data_mod', nom = '$nom_mod', cognom ='$cognom_mod' , cognom2 ='$cognom2_mod' , hora = '$hora_mod', num_persones = '$per_mod'
                      WHERE id_linia_reserva_taula ='$id_reserva'";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_query($conn, $sql)) {
            echo '<script>window.location.href = window.location.href + "?refresh";</script>';
        } else {
            echo '<script>alert("Error!");</script>';
        }

        $conn->close();
    }

    /**
    * eliminarReserva Mètode per a eliminar una reserva
    * @return void
    */
    public static function eliminarReserva()
    {
        $conn = crearConnexio();

        if ($conn->connect_error) {
            die("Connexió fallida: " . $conn->connect_error);
        }

        $id_taula_del = $_POST['id_taula'];

        $sql = "DELETE FROM RESERVA_TAULA WHERE id_linia_reserva_taula =$id_taula_del";

        if (mysqli_query($conn, $sql)) {
            echo '<script>window.location.href = window.location.href + "?refresh";</script>';
        } else {
            echo '<script>alert("Error!");</script>';
        }

        $conn->close();
    }

    /**
     * datalistLlistarReserves descarga al cercador tots els noms per a fer un buscador seleccionable
     * @return void
     */
    public static function datalistLlistarReserves()
    {
        $conn = crearConnexio();

        $sql= "SELECT * FROM RESERVA_TAULA";
        $result=$conn->query($sql);

        echo '<datalist id="buscarTaula">';

        foreach ($result as $key => $row) {
            echo '<option value="'.$row['nom'].'">';
        }
        echo '</datalist>';
    }
}

?>
