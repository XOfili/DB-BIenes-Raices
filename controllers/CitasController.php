<?php

class CitasController {

	private $conn;
	private $table = "citas";

	public $id;
	public $cliente_id;
	public $propiedad_id;
    public $fecha;


	public function __construct($db) {
    		$this->conn = $db;
	}

	public function getItems($page,$from_record_num,$records_per_page)  {
    	$query ="SELECT * FROM ". $this->table ." LIMIT {$from_record_num},{$records_per_page}";
        	$stmt = $this->conn->prepare($query);
        	$stmt->execute();

    	return $stmt;
	}

	public function getItem($id) {
    	$query="SELECT * FROM ". $this->table ." WHERE id=?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $id);
    	$stmt->execute();

    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->cliente = $row['cliente_id'];  
    	$this->contacto = $row['propiedad_id'];
        $this->contacto = $row['fecha'];

		return $stmt;

	}

	public function countItems() {
    	$query="SELECT id FROM ". $this->table .";";
    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();
    	$num = $stmt->rowCount();

    	return $num;
	}

	function create($cliente_id, $propiedad_id, $fecha) {

    	$query = "INSERT INTO ". $this->table ." (cliente_id, propiedad_id, fecha) VALUES (?,?,?)";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $cliente_id);
    	$stmt->bindParam(2, $propiedad_id);
        $stmt->bindParam(3, $fecha);

    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/citas/index.php');
			exit();
    	} else {
        	return false;
    	}
	}    

	public function update($id, $cliente_id, $propiedad_id, $fecha) {
    	$query="UPDATE ". $this->table ." SET cliente_id = :cliente_id, propiedad_id = :propiedad_id, fecha = :fecha WHERE id = :id";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(':id',				$id);
    	$stmt->bindParam(':cliente_id',		$cliente_id);
    	$stmt->bindParam(':propiedad_id', 	$propiedad_id);
        $stmt->bindParam(':fecha', 			$fecha);

        
   	 
    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/citas/index.php');
			exit();
    	} else {
        	return false;
    	}
	}

	public function delete($id) {
    	$query="DELETE FROM ". $this->table ." where id = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $id);

    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/citas/index.php');
			exit();
    	} else {
        	return false;
    	}
	}
}
?>
