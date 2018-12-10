<?php
	include_once('conexion.php');
	class Product extends Model{
		public $code;
		public $product;
		public $price;

		public function __construct(){
      parent::__construct();
    }

		public function get_products(){
      $sql = $this->db->query("SELECT * FROM PRODUCTE");
      $html = '';
      foreach ($sql as $key){
        $code = "'".$key['id_producte']."'";
        $html .= '<tr>
                    <td>'.$key['id_producte'].'</td>
                    <td>'.$key['nom_producte'].'</td>
                    <td align="right">'.$key['preu_producte'].'</td>
                    <td align="right">
                      <input type="number" id="'.$key['id_producte'].'" value="1" min="1">
                    </td>
                    <td>
                      <button onClick="addProduct('.$code.');">
                        Afegir
                      </button>
                    </td>
                  </tr>';
      }
      return $html;
   	}

 		public function search_code($code){
 			$sql = $this->db->query("SELECT * FROM PRODUCTE WHERE id_producte = '$code'");
      $product = $sql->fetch_all(MYSQLI_ASSOC);
      $status = 0;
      foreach ($product as $key){
    		$this->code = $key['id_producte'];
    		$this->product = $key['nom_producte'];
    		$this->price = $key['preu_producte'];
    		$status++;
    	}
    	return $status;
 		}
	}
?>
