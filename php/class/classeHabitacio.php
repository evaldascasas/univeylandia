<?php
/**
 * classeHabitacio.php: arxiu que conté els atributs i mètodes de la classe Habitacio.
 * @author Grup 3: Evaldas Casas
 * @version 1.0
 */
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";

/**
 * Classe Habitacio: classe que s'utilitza per crear objectes de tipus Habitacio,
 * per introduir habitacions en la base de dades, modificar-les, llistar-les i eliminar-les.
 * Compta amb alguns mètodes auxiliars, com per exemple un per llistar les habitacions.
 */
class Habitacio
{
    /** @var String hauria de contenir el ID_habitacio */
    private $idHab;
    /** @var String hauria de contenir el numero d'habitacio */
    private $numHab;
    /** @var String hauria de contenir el tipus d'habitacio */
    private $tipusHab;

    /**
     * __construct: Contructor de la classe.
     */
    public function __construct()
    {
        $args = func_get_args();
        $num = func_num_args();
        $f='__construct'.$num;
        if (method_exists($this, $f)) {
            call_user_func_array(array($this,$f), $args);
        }
    }

    /**
     * __construct0: Constructor buit
     * @return Void
     */
    public function __construct0()
    {
    }

    /**
     * __construct2: Constructor per utilitzar al crear un objecte de tipus habitació
     * @param  $numHab   hauria de contenir el número d'habitació
     * @param  $tipusHab hauria de contenir el tipus d'habitació
     * @return Void
     */
    public function __construct2($numHab, $tipusHab)
    {
        $this->numHab = $numHab;
        $this->tipusHab = $tipusHab;
    }


    /* MÈTODES */

    /**
    * crearHabitacio: Mètode que agafa les dades d'un formulari i les insereix en la base de dades.
    *
    * El resultat d'aquest mètode és la inserció d'un registre en la taula Habitació de la BD,
    * aquest registre conté les dades que s'han agafat del formulari de creació d'habitacions.
    *
    * @return Void
    */
    public function crearHabitacio()
    {
        try {
            $conn = crearConnexio();

            if ($conn->connect_error) {
                die("Connexió fallida: " . $conn->connect_error);
            }

            $sql = "INSERT INTO HABITACIO (num_habitacio, id_tipus_habitacio) VALUES (?,?)";

            $stmt = $conn->prepare($sql);

            if ($stmt==false) {
                throw new Exception();
            }

            $resultBP = $stmt->bind_param("si", $this->numHab, $this->tipusHab);

            if ($resultBP==false) {
                throw new Exception();
            }

            $resultEx = $stmt->execute();

            if ($resultEx==false) {
                throw new Exception();
            }
            echo '<script>alert("Registre introduit.");</script>';
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo '<script>alert("Error al introduir el registre.");</script>';
        }
    }

    /**
     * llistarHabitacio: Mètode static que llista totes les habitacions que hi ha a la base de dades relacionant el ID del tipus d'habitació amb el nom del tipus d'habitació.
     *
     * El resultat d'aquest mètode és una taula on apareixen els registres de la taula Habitació.
     * També imprimeix botons per eliminar i modificar, a part dels modals que estaran ocults fins que s'activin els botons.
     *
     * @return Void
     */
    public static function llistarHabitacio()
    {
        try {
            $conn = crearConnexio();

            if ($conn->connect_error) {
                die("Connexió fallida: " . $conn->connect_error);
            }

            $sql = "SELECT HABITACIO.id_habitacio, HABITACIO.num_habitacio, HABITACIO.id_tipus_habitacio, TIPUS_HABITACIO.nom_tipus_habitacio FROM HABITACIO, TIPUS_HABITACIO WHERE HABITACIO.id_tipus_habitacio = TIPUS_HABITACIO.id_tipus_habitacio GROUP BY HABITACIO.num_habitacio";

            $result = $conn->query($sql);

            if (!$result) {
                throw new Exception();
            }

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered table-hover table-sm">';
                echo '<thead class="thead-light">';
                echo '<tr>';
                //echo '<th>ID</th>';
                echo '<th>Número habitació</th>';
                echo '<th>Tipus habitació</th>';
                echo '</tr>';
                echo '</thead>';

                while ($row = $result->fetch_assoc()) {
                    $id_hab = $row['id_habitacio'];
                    $num_hab = $row['num_habitacio'];
                    $id_tipus_hab = $row['id_tipus_habitacio'];
                    $tipus_hab = $row['nom_tipus_habitacio'];

                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td style="display:none;">'.$id_hab.'</td>';
                    echo '<td>'.$num_hab.'</td>';
                    echo '<td>'.$tipus_hab.'</td>';
                    echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$id_hab.'">Modificar</button></td>';
                    echo '<td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModalEliminar'.$id_hab.'">Eliminar</button></td>';
                    echo '</tr>';
                    echo '</tbody>';

                    /* MODAL PER MODIFICAR */
                    echo '<!-- Modal -->';
                    echo '<div class="modal fade" id="modalModificar'.$id_hab.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                    echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                    echo '    <div class="modal-content">';
                    echo '      <div class="modal-header">';
                    echo '        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Habitació</h5>';
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
                    echo '                <label for="tipus_habitacio">Tipus Habitació</label>';
                    echo '                <div class="input-group">';
                    echo '                  <select class="form-control form-control-sm" name="tipus_hab_mod" required>';
                    include_once $_SERVER['DOCUMENT_ROOT']."/php/class/classeHabitacio.php";
                    Habitacio::llistarTipusHabitacioModificar($id_tipus_hab);
                    echo '                  </select>';
                    echo '                </div>';
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
                    echo '<div class="modal fade" id="ModalEliminar'.$id_hab.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
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
                    echo '                    <input class="form-control" type="text" value="'.$id_hab.'" name="id_hab" style="display: none;">';
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
                  <strong>Atenció!</strong> No hi ha registres.
                </div>';
            }
            $conn->close();
        } catch (Exception $e) {
            echo 'Error al realitzar la consulta.';
        }
    }

    /**
     * llistarHabitacionsBusqueda: Mètode static que realitza una cerca del valor que li
     * introduim en la barra de cerca en la taula de les habitacions en la base de dades.
     *
     * El resultat d'aquest mètode és una taula on apareixen els registres de la taula Habitació
     * que continguin el valor que s'ha escrit en la barra de cerca. També imprimeix botons per eliminar i modificar,
     * a part dels modals que estaran ocults fins que s'activin els botons.
     *
     * @return Void
     */
    public static function llistarHabitacionsBusqueda()
    {
        try {
            $conn = crearConnexio();

            if ($conn->connect_error) {
                die("Connexió fallida: " . $conn->connect_error);
            }

            $filtre = $_POST['busqueda_habitacio'];

            $sql = "SELECT HABITACIO.id_habitacio, HABITACIO.num_habitacio, HABITACIO.id_tipus_habitacio, TIPUS_HABITACIO.nom_tipus_habitacio FROM HABITACIO, TIPUS_HABITACIO
        WHERE HABITACIO.id_tipus_habitacio = TIPUS_HABITACIO.id_tipus_habitacio AND (HABITACIO.num_habitacio LIKE '%$filtre%' OR TIPUS_HABITACIO.nom_tipus_habitacio LIKE '%$filtre%') GROUP BY HABITACIO.num_habitacio";

            $result = $conn->query($sql);

            if (!$result) {
                throw new Exception();
            }

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered table-hover table-sm">';
                echo '<thead class="thead-light">';
                echo '<tr>';
                echo '<th>Número habitació</th>';
                echo '<th>Tipus habitació</th>';
                echo '</tr>';
                echo '</thead>';

                while ($row = $result->fetch_assoc()) {
                    $id_hab = $row['id_habitacio'];
                    $num_hab = $row['num_habitacio'];
                    $id_tipus_hab = $row['id_tipus_habitacio'];
                    $tipus_hab = $row['nom_tipus_habitacio'];

                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td style="display:none;">'.$id_hab.'</td>';
                    echo '<td>'.$num_hab.'</td>';
                    echo '<td>'.$tipus_hab.'</td>';
                    echo '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$id_hab.'">Modificar</button></td>';
                    echo '<td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModalEliminar'.$id_hab.'">Eliminar</button></td>';
                    echo '</tr>';
                    echo '</tbody>';

                    /* MODAL PER MODIFICAR */
                    echo '<!-- Modal -->';
                    echo '<div class="modal fade" id="modalModificar'.$id_hab.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
                    echo '  <div class="modal-dialog modal-dialog-centered modal-md" role="document">';
                    echo '    <div class="modal-content">';
                    echo '      <div class="modal-header">';
                    echo '        <h5 class="modal-title">Modificar Habitació</h5>';
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
                    echo '                <label for="tipus_habitacio">Tipus Habitació</label>';
                    echo '                <div class="input-group">';
                    echo '                  <select class="form-control form-control-sm" name="tipus_hab_mod" required>';
                    include_once $_SERVER['DOCUMENT_ROOT']."/php/class/classeHabitacio.php";
                    Habitacio::llistarTipusHabitacioModificar($id_tipus_hab);
                    echo '                  </select>';
                    echo '                </div>';
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
                    echo '<div class="modal fade" id="ModalEliminar'.$id_hab.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
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
                    echo '                    <input class="form-control" type="text" value="'.$id_hab.'" name="id_hab" style="display: none;">';
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
                  <strong>Atenció!</strong> No hi ha registres.
                </div>';
            }
            $conn->close();
        } catch (Exception $e) {
            echo 'Error al realitzar la consulta.';
        }
    }

    /**
     * modificarHabitacio: Mètode static que agafa el ID del modal modificar i realitza un UPDATE en el registre de la BD amb aquest ID.
     *
     * El resultat d'aquest mètode és la modificació d'un registre concret de la taula Habitació.
     *
     * @return Void
     */
    public static function modificarHabitacio()
    {
        $conn = crearConnexio();

        if ($conn->connect_error) {
            die("Connexió fallida: " . $conn->connect_error);
        }

        $id_hab_mod = $_POST['id_hab'];
        //$num_hab_mod = $_POST['num_hab_mod'];
        $tipus_hab_mod = $_POST['tipus_hab_mod'];

        $sql = "UPDATE HABITACIO SET id_tipus_habitacio=$tipus_hab_mod WHERE id_habitacio=$id_hab_mod";

        if ($conn->query($sql)) {
            echo '<script>window.location.href = window.location.href + "?refresh";</script>';
        } else {
            echo '<script>alert("Error!");</script>';
        }
        $conn->close();
    }



    /**
     * eliminarHabitacio: Mètode static que agafa el ID del modal eliminar i elimina el registre de la BD amb aquest ID.
     *
     * El resultat d'aquest mètode és la eliminació d'un registre concret de la taula Habitació.
     *
     * @return Void
     */
    public static function eliminarHabitacio()
    {
        $conn = crearConnexio();

        if ($conn->connect_error) {
            die("Connexió fallida: " . $conn->connect_error);
        }

        $id_hab_del = $_POST['id_hab'];

        $sql = "DELETE FROM HABITACIO WHERE id_habitacio =$id_hab_del";

        if ($conn->query($sql)) {
            echo '<script>window.location.href = window.location.href + "?refresh";</script>';
        } else {
            echo '<script>alert("Error!");</script>';
        }

        $conn->close();
    }


    /**
     * llistarTipusHabitacio: Mètode static que llista els tipus d'habitació existents des de la BD.
     *
     * El resultat d'aquest mètode ñes un desplegable on apareixen tots els tipus d'habitació que
     * existeixen en la base de dades.
     *
     * @return Void
     */
    public static function llistarTipusHabitacio()
    {
        $conn = crearConnexio();

        if ($conn->connect_errno) {
            die('Error en la connexió : '.$conn->connect_errno.'-'.$conn->connect_error);
        }

        $sql = "SELECT id_tipus_habitacio, nom_tipus_habitacio FROM TIPUS_HABITACIO ORDER BY id_tipus_habitacio";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_tipus_hab = $row['id_tipus_habitacio'];
                $nom_tipus_hab = $row['nom_tipus_habitacio'];
                echo '<option value="'.$id_tipus_hab.'">'.$nom_tipus_hab.'</option>';
            }
        } else {
            echo '<div class="alert alert-warning">
                  <strong>Atenció!</strong> No hi ha registres.
                </div>';
        }

        $conn->close();
    }

    /**
     * llistarTipusHabitacioModificar: Mètode static que llista el tipus d'habitació que té assignat una habitació en la base de dades.
     *
     * El resultat d'aquest mètode és un desplegable amb tots els tipus d'habitació que hi ha en la base de dades, però el que surt seleccionat
     * és el que l'habitació té lligat en la base de dades.
     *
     * @param  Integer $id_tipus_hab és el ID del tipus d'habitació.
     * @return Void
     */
    public static function llistarTipusHabitacioModificar($id_tipus_hab)
    {
        $conn = crearConnexio();

        if ($conn->connect_error) {
            die('Error en la connexió : '.$conn->connect_errno.'-'.$conn->connect_error);
        }

        $sql = "SELECT id_tipus_habitacio, nom_tipus_habitacio FROM TIPUS_HABITACIO ORDER BY id_tipus_habitacio";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_tipus_hab_mod = $row['id_tipus_habitacio'];
                $nom_tipus_hab_mod = $row['nom_tipus_habitacio'];

                if ($id_tipus_hab==$id_tipus_hab_mod) {
                    echo '<option selected value="'.$id_tipus_hab_mod.'">'.$nom_tipus_hab_mod.'</option>';
                } else {
                    echo '<option value="'.$id_tipus_hab_mod.'">'.$nom_tipus_hab_mod.'</option>';
                }
            }
        } else {
            echo '<div class="alert alert-warning">
                <strong>Atenció!</strong> No hi ha registres.
              </div>';
        }

        $conn->close();
    }

    /**
     * llistarPensio: Mètode static que llista els tipus de pensió.
     *
     * El resultat d'aquest mètode és un desplegable on es llisten tots els tipus de
     * pensió que hi ha definits en la base de dades.
     *
     * @return Void
     */
    public static function llistarPensio()
    {
        $conn = crearConnexio();

        if ($conn->connect_errno) {
            die('Error en la connexió : '.$conn->connect_errno.'-'.$conn->connect_error);
        }

        $sql = "SELECT * FROM PENSIO";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_pensio = $row['id_pensio'];
                $tipus_pensio = $row['tipus_pensio'];
                $preu_persona = $row['preu_persona'];
                echo '<option value="'.$id_pensio.'">'.$tipus_pensio.' '.$preu_persona.' €</option>';
            }
        } else {
            echo '<div class="alert alert-warning">
                  <strong>Atenció!</strong> No hi ha registres.
                </div>';
        }

        $conn->close();
    }

    /**
     * llistarPensioSeleccionat: Mètode static que llista el tipus de pensió que té assignat un registre de la BD.
     *
     * El resultat d'aquest mètode és un desplegable on es llisten tots els tipus de
     * pensió que hi ha definits en la base de dades, l'element seleccionat de la llista és el
     * tipus de pensió que està assignat a aquell registre.
     *
     * @param  Integer $id_pensio_seleccionat és el ID del tipus de pensió.
     * @return Void
     */
    public static function llistarPensioSeleccionat($id_pensio_seleccionat)
    {
        $conn = crearConnexio();

        if ($conn->connect_error) {
            die('Error en la connexió : '.$conn->connect_errno.'-'.$conn->connect_error);
        }

        $sql = "SELECT * FROM PENSIO";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_pensio = $row['id_pensio'];
                $tipus_pensio = $row['tipus_pensio'];
                $preu_persona = $row['preu_persona'];

                if ($id_pensio_seleccionat==$id_pensio) {
                    echo '<option selected value="'.$id_pensio.'">'.$tipus_pensio.'</option>';
                } else {
                    echo '<option value="'.$id_pensio.'">'.$tipus_pensio.'</option>';
                }
            }
        } else {
            echo '<div class="alert alert-warning">
                <strong>Atenció!</strong> No hi ha registres.
              </div>';
        }

        $conn->close();
    }

    /**
     * llistatHabitacionsPDF: Mètode static que genera un arxiu PDF amb el llistat d'habitacions.
     *
     * El resultat d'aquest mètode és un arxiu PDF amb un Header i Footer personalitzats amb tot el llistat d'habitacions
     * amb el número d'habitació, tipus d'habitació i preu de l'habitació en format de taula.
     *
     * @return Void
     */
    public static function llistatHabitacionsPDF()
    {
        require_once $_SERVER['DOCUMENT_ROOT']."/php/class/classePDF.php";

        $conn = crearConnexio();

        if ($conn->connect_error) {
            die('Error en la connexió : '.$conn->connect_errno.'-'.$conn->connect_error);
        }

        $sql = "SELECT num_habitacio, nom_tipus_habitacio, preu_tipus_habitacio FROM HABITACIO, TIPUS_HABITACIO WHERE HABITACIO.id_tipus_habitacio = TIPUS_HABITACIO.id_tipus_habitacio ORDER BY num_habitacio";

        $result = $conn->query($sql);
        $numero_de_habitacions = $result->num_rows;

        $columna_num_hab = "";
        $columna_tipus_hab = "";
        $columna_preu_hab = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $numH = $row['num_habitacio'];
                $tipusH = $row['nom_tipus_habitacio'];
                $preuH = $row['preu_tipus_habitacio'];
                $preuMostrar = number_format($row['preu_tipus_habitacio'], 2, ',', '.');

                $columna_num_hab = $columna_num_hab.$numH."\n";
                $columna_tipus_hab = $columna_tipus_hab.$tipusH."\n";
                $columna_preu_hab = $columna_preu_hab.$preuMostrar."\n";
            }
        }

        $conn->close();

        /* GENERAR PDF */
        $pdf = new PDF();

        //Canvi de títol del PDF
        $pdf->SetTitle('Llistat Habitacions');

        $pdf->SetAutoPageBreak(false);

        $pdf->AliasNbPages();

        $pdf->AddPage();

        //Fields Name position
        $Y_Fields_Name_position = 25;
        //Table position, under Fields Name
        $Y_Table_Position = 31;

        //First create each Field Name
        //Gray color filling each Field Name box
        $pdf->SetFillColor(232, 232, 232);
        //Bold Font for Field Name
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetY($Y_Fields_Name_position);
        $pdf->SetX(45);
        $pdf->Cell(20, 6, 'HAB', 1, 0, 'L', 1);
        $pdf->SetX(65);
        $pdf->Cell(100, 6, 'TIPUS', 1, 0, 'L', 1);
        $pdf->SetX(135);
        $pdf->Cell(30, 6, 'PREU (euros)', 1, 0, 'R', 1);
        $pdf->Ln();

        //Now show the columns
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(45);
        $pdf->MultiCell(20, 6, $columna_num_hab, 1);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(65);
        $pdf->MultiCell(100, 6, $columna_tipus_hab, 1);
        $pdf->SetY($Y_Table_Position);
        $pdf->SetX(135);
        $pdf->MultiCell(30, 6, $columna_preu_hab, 1, 'R');

        //Create lines (boxes) for each ROW (Product)
        //If you don't use the following code, you don't create the lines separating each row
        $i = 0;
        $pdf->SetY($Y_Table_Position);
        while ($i < $numero_de_habitacions) {
            $pdf->SetX(45);
            $pdf->MultiCell(120, 6, '', 1);
            $i = $i +1;
        }

        //Donem nom al document PDF i l'enviem per descarregar
        $pdf->Output('llistatHabitacions.pdf', 'D');
    }
}
