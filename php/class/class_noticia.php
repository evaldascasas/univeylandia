    <?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";
    class noticia {
      private $titol_noticia;
      private $descripcio_noticia;
      private $data_noticia;
      private $id_usuari;

    //constructor

      function __construct() {
        $args = func_get_args();
        $num = func_num_args();
        $f='__construct'. $num;
        if (method_exists($this,$f)) {
          call_user_func_array(array($this,$f),$args);
        }
      }

      function __construct0()
      {

      }


    function __construct3($titol_noticia,$descripcio_noticia,$data_noticia){
      $this->titol_noticia = $titol_noticia;
      $this->descripcio_noticia = $descripcio_noticia;
      $this->data_noticia = $data_noticia;
      $this->id_usuari = 2;
    }
    //rip consturctor

      function getTitol_Noticia(){
        return $titol_noticia;
      }
      function setTitol_Noticia($titol_noticia){
          $this->titol_noticia = $titol_noticia;
      }

      function getDescripcio_Noticia(){
        return $descripcio_noticia;
      }
      function setDescripcio_Noticia($descripcio_noticia){
          $this->descripcio_noticia = $descripcio_noticia;
      }

      function getData_Noticia(){
        return $data_noticia;
      }
      function setData_Noticia($data_noticia){
          $this->data_noticia = $data_noticia;
      }
    //fi get i setTelefon


    //inserir
      public function inserir_noticia(){
        try {
          $connection = crearConnexio();
          $sql = "INSERT INTO NOTICIA (titol_noticia, descripcio_noticia, data_noticia, id_usuari) VALUES (?,?,?,?);";
          $sentencia = $connection->prepare($sql);
          $sentencia->bind_param("sssi",$this->titol_noticia,$this->descripcio_noticia,$this->data_noticia,$this->id_usuari);
            if($sentencia->execute()){

              $connection->close();
              $sentencia->close();
              return true;
              }
            else{
              $connection->close();
              $sentencia->close();
              return "Error en el registre.";
            }
          }catch(Exception $error){
              echo $error;
              $connection->close();
              $sentencia->close();
              return false;

          }
        }

        public function validar_noticia(){
          ini_set( 'display_errors', 1 );
          error_reporting( E_ALL );

          echo "Noticia creada";
        }

        /*
        public function validar_client(){
          ini_set( 'display_errors', 1 );
          error_reporting( E_ALL );

          $from = "contacto@univeylandia-parc.cat";
          $to = "$this->email";
          var_dump($this->email);
          $subject = "Validacio de Univeylandia";
          $message = "Validar el compte";
          $header = "From". $from;

          mail($to,$subject,$message,$header);

          echo "Revisa el teu correu i valida el compte";
        }
        */

        public function llistar_noticia(){
          try{
            $connection = crearConnexio();
            $sql = "SELECT * FROM NOTICIA";
            $resultat = $connection->query($sql);
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">id_noticia</th>';
            echo '<th scope="col">titol_noticia</th>';
            echo '<th scope="col">descripcio_noticia</th>';
            echo '<th scope="col">data_noticia</th>';
            echo '<th scope="col">id_usuari</th>';
            echo '</tr>';
            echo '</thead>';

            if($resultat){
              while($row = $resultat->fetch_assoc()){
                $this->id_noticia = $row["id_noticia"];
                $this->titol_noticia = $row["titol_noticia"];
                $this->descripcio_noticia = $row["descripcio_noticia"];
                $this->data_noticia = $row["data_noticia"];
                $this->id_usuari = $row["id_usuari"];

                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="row">'.$row["id_noticia"].'</th>';
                echo '<td>'.$row["titol_noticia"].'</th>';
                echo '<td>'.$row["descripcio_noticia"].'</th>';
                echo '<td>'.$row["data_noticia"].'</th>';
                echo '<td>'.$row["id_usuari"].'</td>';
                echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalModificar'.$this->id_noticia.'">Modificar</button></td>"';
                echo   '<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar'.$this->id_noticia.'">Eliminar</button></td>"';
                echo   '<br>';
                echo '</tr>';
                echo '</tbody>';

                /*Modal de modificar*/
              echo '<!-- Modal -->
            <div class="modal fade" id="modalModificar'.$this->id_noticia.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modificar zona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <form method="post">
                      <div class="form-group row">
                       <div class="col-10">
                         <input class="form-control" type="text" value="'.$this->id_noticia.'" id="example-text-input" name="id_noticia" style="display: none;">
                       </div>
                      </div>
                      <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Titol noticia</label>
                        <div class="form-group row">
                        <div class="col-10">
                          <input class="form-control" type="text" value="'.$this->titol_noticia.'" id="example-text-input" name="titol_noticia"">
                        </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Descripcio noticia</label>
                        <div class="form-group row">
                        <div class="col-10">
                          <input class="form-control" type="text" value="'.$this->descripcio_noticia.'" id="example-text-input" name="descripcio_noticia"">
                        </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Data de la noticia</label>
                        <div class="form-group row">
                        <div class="col-10">
                          <input class="form-control" type="text" value="'.$this->data_noticia.'" id="example-text-input" name="data_noticia"">
                        </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">ID del usuari</label>
                        <div class="form-group row">
                        <div class="col-10">
                          <input class="form-control" type="text" value="'.$this->id_usuari.'" id="example-text-input" name="id_usuari"">
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="modificar" value="Modificar"">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                  </div>
                </form>
                </div>
              </div>
            </div>';
var_dump($this->id_noticia);


            if (isset($_POST['modificar'])) {
              $noticia = new noticia();
              $noticia->modificar_noticia($connection);
            }
              }
            }
          } catch(Exception $error){
                  echo $error;
                  $connection->close();
                  $sentencia->close();
                  return false;

              }
                    var_dump($this->id_noticia);
                        var_dump($this->titol_noticia);


        }
        public function modificar_noticia($connection){
            var_dump($this->id_noticia);
    $id_noticia = $_POST['id_noticia'];
    var_dump($id_noticia);
    $titol_noticia = $_POST['titol_noticia'];
    var_dump($titol_noticia);
    $descripcio_noticia = $_POST['descripcio_noticia'];
    $data_noticia = $_POST['data_noticia'];
    $sql_update = "UPDATE NOTICIA SET titol_noticia='$titol_noticia',descripcio_noticia='$descripcio_noticia',data_noticia='$data_noticia' WHERE id_noticia=$id_noticia";
      if (mysqli_query($connection, $sql_update)) {
          echo "<script>window.location.href='llistarNoticia.php';</script>";
          echo "Okay";
      } else {
          echo "Error updating record: " . mysqli_error($connection);
      }
  }

      }
    ?>
