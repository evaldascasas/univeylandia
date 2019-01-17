<?php
/**
 * classeEmpleat.php: conté els atributs i alguns dels mètodes de la classeEmpleat.
 * @author Grup 3: Evaldas Casas
 * @version 1.0
 */
include_once $_SERVER['DOCUMENT_ROOT']."/php/connection.php";

/**
 * Classe Empleat: classe que s'utilitza per crear objectes de tipus ReservaHabitacio,
 * per introduir reserves en la base de dades i validar el login d'un usuari empleat.
 *
 */
class Empleat {
  /** @var Integer Hauria de contenir el ID de l'usuari */
  private $id_empleat;
  /** @var String Hauria de contenir el nom de l'usuari */
  private $nom;
  /** @var String Hauria de contenir el cognom1 de l'usuari */
  private $cognom1;
  /** @var String Hauria de contenir el cognom2 de l'usuari */
  private $cognom2;
  /** @var String Hauria de contenir el email de l'usuari */
  private $email;
  /** @var String Hauria de contenir la contrasenya de l'usuari */
  private $pass;
  /** @var String Hauria de contenir la data de naixement de l'usuari */
  private $data;
  /** @var String Hauria de contenir l'adreça de l'usuari */
  private $adreca;
  /** @var String Hauria de contenir la ciutat on viu l'usuari */
  private $ciutat;
  /** @var String Hauria de contenir la província on viu l'usuari */
  private $provincia;
  /** @var String Hauria de contenir el codi postal de la ciutat on viu l'usuari */
  private $codi_postal;
  /** @var String Hauria de contenir el tipus de document de l'usuari */
  private $tipus_doc;
  /** @var String Hauria de contenir el número de identificació del document identificatiu de l'usuari */
  private $num_doc;
  /** @var String Hauria de contenir el sexe de l'usuari */
  private $sexe;
  /** @var String Hauria de contenir el telèfon de l'usuari */
  private $tlf;
  /** @var Integer Hauria de contenir el rol de l'usuari */
  private $rol;
  /** @var Integer Hauria de contenir si l'usuari està activat o no */
  private $actiu;
  /** @var String Hauria de contenir el codi de la Seguretat Social de l'usuari */
  private $codi_ss;
  /** @var String Hauria de contenir el número de nòmina de l'usuari */
  private $num_nomina;
  /** @var String Hauria de contenir el IBAN de l'usuari */
  private $iban;
  /** @var String Hauria de contenir la especialitat de l'usuari */
  private $especialitat;
  /** @var String Hauria de contenir el càrrec de l'usuari */
  private $carrec;
  /** @var String Hauria de contenir la data d'inici del contracte de l'usuari */
  private $data_inici;
  /** @var String Hauria de contenir la data de fi del contracte de l'usuari */
  private $data_fi;
  /** @var Integer Hauria de contenir el horari de l'usuari */
  private $horari;

  /* CONSTRUCTORS */

  /**
   * __construct: Constructor de la classe Empleat.
   */
  function __construct() {
    $args = func_get_args();
    $num = func_num_args();
    $f='__construct'.$num;
    if (method_exists($this,$f)) {
      call_user_func_array(array($this,$f),$args);
    }
  }

  /**
   * __construct2: mètode per agafar el email i contrasenya que introdueix un usuari quan realitza un login.
   * @param  String $email Hauria de contenir el email de l'usuari
   * @param  String $pass  Hauria de contenir la contrasenya de l'usuari
   * @return Void
   */
  function __construct2($email, $pass)
  {
    $this->email = $email;
    $this->pass = $pass;
  }

  /* CONSTRUCTOR PER A QUAN CREEM UN USUARI DES DE ADMINISTRACIO */

  /**
   * __construct23: S'utilitza per crear un objecte de tipus Empleat que farem servir per crear un usuari de tipus empleat.
   * @param  String $nom          Hauria de contenir el nom de l'usuari
   * @param  String $cognom1      Hauria de contenir el cognom1 de l'usuari
   * @param  String $cognom2      Hauria de contenir el cognom2 de l'usuari
   * @param  String $tipus_doc    Hauria de contenir el tipus de document de l'usuari
   * @param  String $num_doc      Hauria de contenir el número identificador del document de l'usuari
   * @param  String $data         Hauria de contenir la data de naixement de l'usuari
   * @param  String $sexe         Hauria de contenir el sexe de l'usuari
   * @param  String $tlf          Hauria de contenir el telèfon de l'usuari
   * @param  String $email        Hauria de contenir el email de l'usuari
   * @param  String $adreca       Hauria de contenir l'adreça de l'usuari
   * @param  String $ciutat       Hauria de contenir la ciutat de l'usuari
   * @param  String $provincia    Hauria de contenir la província de l'usuari
   * @param  String $codi_postal  Hauria de contenir el codi postal de l'usuari
   * @param  String $pass         Hauria de contenir la contrasenya de l'usuari
   * @param  Integer $rol          Hauria de contenir el rol de l'usuari
   * @param  String $codi_ss      Hauria de contenir el codi de la Seguretat Social de l'usuari
   * @param  String $num_nomina   Hauria de contenir el número de nòmina de l'usuari
   * @param  String $iban         Hauria de contenir el IBAN de l'usuari
   * @param  String $especialitat Hauria de contenir la especialitat de l'usuari
   * @param  String $carrec       Hauria de contenir el càrrec de l'usuari
   * @param  String $data_inici   Hauria de contenir la data d'inici del contracte de l'usuari
   * @param  String $data_fi      Hauria de contenir la data de fi del contracte de l'usuari
   * @param  Integer $horari       Hauria de contenir el horari de l'usuari
   * @return Void
   */
  function __construct23($nom, $cognom1, $cognom2, $tipus_doc, $num_doc, $data, $sexe, $tlf,
  $email, $adreca, $ciutat, $provincia, $codi_postal, $pass, $rol, $codi_ss, $num_nomina, $iban, $especialitat, $carrec, $data_inici, $data_fi, $horari) {

   $this->id_empleat = NULL;
   $this->nom = $nom;
   $this->cognom1 = $cognom1;
   $this->cognom2 = $cognom2;
   $this->tipus_doc = $tipus_doc;
   $this->num_doc = $num_doc;
   $this->data = $data;
   $this->sexe = $sexe;
   $this->tlf = $tlf;
   $this->email = $email;
   $this->adreca = $adreca;
   $this->ciutat = $ciutat;
   $this->provincia = $provincia;
   $this->codi_postal = $codi_postal;  //NPI de si deixar el codi o no
   $this->pass = password_hash($pass, PASSWORD_DEFAULT); //ENCRIPTAR CONTRASENYA PER DEFECTE
   $this->rol = $rol;
   $this->actiu = '1';
   $this->codi_ss = $codi_ss;
   $this->num_nomina = $num_nomina;
   $this->iban = $iban;
   $this->especialitat = $especialitat;
   $this->carrec = $carrec;
   $this->data_inici = $data_inici;
   $this->data_fi = $data_fi;
   $this->horari = $horari;

  }

  /**
   * crearEmpleat: mètode que inserta un registre en les taules USUARI i DADES_USUARI de la base de dades.
   *
   * El resultat d'aquest mètode és una inserció de dades d'un usuari empleat en dues taules de la base de dades, concretament
   * en USUARI i DADES_EMPLEAT, primer es modifica un paràmetre de la BD, l'autocommit, per a que si quan introdueix dades en una taula falla
   * pugui tornar a un estat anterior, ja que no volem que es creen dades en una taula i no el l'altra, si hi ha algun error en la inserció de dades
   * es realitza un Rollback.
   *
   * @return Void
   */
  public function crearEmpleat()
  {
    try
    {
        $connection = crearConnexio();

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $connection->autocommit(FALSE);

        $sql= "INSERT INTO DADES_EMPLEAT (codi_seg_social, num_nomina, IBAN, especialitat, carrec, data_inici_contracte, data_fi_contracte, id_horari) VALUES (?,?,?,?,?,?,?,?);";

        $stmt = $connection->prepare($sql);

        if($stmt==false){
          var_dump($stmt);
          die("Secured");
        }

        $resultBP = $stmt->bind_param("sssssssi",$this->codi_ss, $this->num_nomina, $this->iban, $this->especialitat, $this->carrec, $this->data_inici, $this->data_fi, $this->horari);

        if($resultBP==false) {
          var_dump($stmt);
          die("Secured2");
        }

        $resultEx = $stmt->execute();
        if($resultEx==false) {
          var_dump($stmt);
          die("Secured3");
        }

        $sql2= "INSERT INTO USUARI (id_usuari, nom, cognom1, cognom2, email, password, data_naixement, adreca, ciutat, provincia, codi_postal,
          tipus_document, numero_document, sexe, telefon, id_rol, actiu, id_dades_empleat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,LAST_INSERT_ID());";

        $stmt2 = $connection->prepare($sql2);

        if($stmt2==false){
          var_dump($stmt2);
          die("Secured4");
        }

        $resultBP2 = $stmt2->bind_param("isssssssssisssiii",$this->id_empleat, $this->nom, $this->cognom1, $this->cognom2, $this->email, $this->pass, $this->data,
        $this->adreca, $this->ciutat, $this->provincia, $this->codi_postal, $this->tipus_doc, $this->num_doc, $this->sexe, $this->tlf, $this->rol, $this->actiu);

        if($resultBP2==false) {
          var_dump($stmt2);
          die("Secured5");
        }

        $resultEx2 = $stmt2->execute();
        if($resultEx2==false) {
          var_dump($stmt2);
          die("Secured6");
        }
        else {
          $msg = "S'ha afegit l'empleat correctament!";
          echo '<script>alert("'.$msg.'");</script>';
        }

        $stmt->close();
        $stmt2->close();
        $connection->autocommit(TRUE);
        $connection->close();
    }
    catch (Exception $e) {
      $connection->rollback();
      throw $e;
    }

  }

  /**
   * validarLogin: mètode per comprovar que el usuari que fa login és un usuari empleat i les dades que introdueix són vàlides.
   *
   * El resultat d'aquest mètode és el inici de sessió d'un usuari empleat en la web.
   * Aquest mètode verifica la contrasenya mitjançant un password_verify (ja que la contrasenya està encriptada amb password_hash).
   * Si el usuari i contrasenya són vàlids, iniciem sessió i afegim dades de l'usuari en sessió.
   *
   * @return Boolean true -> usuari vàlid, false -> usuari no vàlid
   */
  public function validarLogin()
  {
    $connection = crearConnexio();

    $sql = "SELECT id_usuari, id_rol, password, email FROM USUARI WHERE email=? AND id_rol!=1 AND actiu=1";

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("s",$this->email);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $username = $row['email'];
        $userID = $row['id_usuari'];
        $rol = $row['id_rol'];
        $hash = $row['password'];
    }

    $isValid = password_verify($this->pass, $hash);

    if ($isValid)
    {
      echo 'VALID';
      session_start();

      if (array_key_exists('remember', $_POST)) {
          // Crear una nova cookie de sessió que expira en 7 dies
          setcookie('idu', $username, time() + 7 * 24 * 60 * 60);
          //Reemplaçar el ID de la sessio actual amb una nova i mantenir la informació de la sessio actual
          session_regenerate_id(true);
      } elseif (!$_POST['remember']) {
          //Si hi ha una COOKIE creada, atrassar-la en el temps per a que la elimine
          if (isset($_COOKIE['idu'])) {
              $past = time() - 100;
              setcookie(idu, gone, $past);
          }
      }

      $_SESSION['id_usuari'] = $userID;
      $_SESSION['username'] = $username;
      $_SESSION['rol'] = $rol;

      return true;
    }
    else
    {
      return false;
    }
    $connection->close();
  }

}


 ?>
