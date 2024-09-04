<?php

class VentasController {

	private $conn;
	private $table = "ventas";

	public $id;
	public $propiedad_id;
	public $cliente_id;
    public $monto;
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
    	$query="SELECT v.id, c.cliente, v.monto, v.fecha FROM ventas AS v INNER JOIN clientes AS c ON cliente_id = c.id where cliente = 'Laura López'" ." WHERE id=?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $id);
    	$stmt->execute();

    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->cliente = $row['propiedad_id'];  
    	$this->contacto = $row['cliente_id'];
        $this->contacto = $row['monto'];
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

	function create($propiedad_id, $cliente_id, $monto, $fecha) {

    	$query = "INSERT INTO ". $this->table ."(propiedad_id, cliente_id, monto, fecha) VALUES (?,?,?,?)";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $propiedad_id);
    	$stmt->bindParam(2, $cliente_id);
        $stmt->bindParam(3, $monto);
        $stmt->bindParam(4, $fecha);


    	if ($stmt->execute()) {
        	header('Location: /dbbienesraices/ventas/index.php');
			exit();
    	} else {
        	return false;
    	}
	}    

	public function update($id, $propiedad_id, $cliente_id, $monto, $fecha) {
		$query = "UPDATE ventas SET propiedad_id = :propiedad_id, cliente_id = :cliente_id, monto = :monto, fecha = :fecha WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':propiedad_id', $propiedad_id);
		$stmt->bindParam(':cliente_id', $cliente_id);
		$stmt->bindParam(':monto', $monto);
		$stmt->bindParam(':fecha', $fecha);

		if ($stmt->execute()) {
			header('Location: /dbbienesraices/ventas/index.php');
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
			header('Location: /dbbienesraices/ventas/index.php');
			exit();
    	} else {
        	return false;
    	}
	}
}
?>
