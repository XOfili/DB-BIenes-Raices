<?php

class ClientesController {

	private $conn;
	private $table = "clientes";

	public $id;
	public $cliente;
	public $contacto;

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
    	$this->cliente = $row['cliente'];  
    	$this->contacto = $row['contacto'];

		return $stmt;
	}

	public function countItems() {
    	$query="SELECT id FROM ". $this->table .";";
    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();
    	$num = $stmt->rowCount();

    	return $num;
	}

	function create($cliente, $contacto) {

    		$query = "INSERT INTO ". $this->table ."(cliente, contacto) VALUES (?,?)";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $cliente);
    	$stmt->bindParam(2, $contacto);

    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/clientes/index.php');
			exit();
    	} else {
        	return false;
    	}
	}    

	public function update($id, $cliente, $contacto) {
    	$query="UPDATE ". $this->table ." SET cliente = :cliente, contacto = :contacto WHERE id = :id";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(':id', $id);
    	$stmt->bindParam(':cliente', $cliente);
    	$stmt->bindParam(':contacto', $contacto);
   	 
    	if ($stmt->execute()) {
        	header('Location: /dbbienesraices/clientes/index.php');
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
			header('Location: /dbbienesraices/clientes/index.php');
			exit();
    	} else {
        	return false;
    	}
	}
}
?>
