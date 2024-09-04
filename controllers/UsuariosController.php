<?php

class UsuariosController {

	private $conn;
	private $table = "usuarios";

	public $id;
	public $nombre;
	public $apellidop;
    public $apellidom;
    public $correo;
    public $contrasena;
    public $telefono;
    public $fechan;


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
    	$this->nombre = $row['nombre'];  
    	$this->apellidop = $row['apellidop'];
        $this->apellidom = $row['apellidom'];
        $this->correo = $row['correo'];
        $this->contrasena = $row['contrasena'];
        $this->telefono = $row['telefono'];
        $this->fechan = $row['fechan'];

		return $stmt;

	}

	public function countItems() {
    	$query="SELECT id FROM ". $this->table .";";
    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();
    	$num = $stmt->rowCount();

    	return $num;
	}

	function create($nombre, $apellidop, $apellidom, $correo, $contrasena, $telefono, $fechan) {

    	$query = "INSERT INTO ". $this->table ." (nombre, apellidop, apellidom, correo, contrasena, telefono, fechan) VALUES (?,?,?,?,?,?,?)";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $nombre);
    	$stmt->bindParam(2, $apellidop);
        $stmt->bindParam(3, $apellidom);
        $stmt->bindParam(4, $correo);
        $stmt->bindParam(5, $contrasena);
        $stmt->bindParam(6, $telefono);
        $stmt->bindParam(7, $fechan);
		
    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/usuarios/index.php');
			exit();
    	} else {
        	return false;
    	}
	}    

	public function update($id, $nombre, $apellidop, $apellidom, $correo, $contrasena, $telefono, $fechan) {
			$query = "UPDATE usuarios SET nombre = :nombre, apellidop = :apellidop, apellidom = :apellidom, correo = :correo, contrasena = :contrasena, telefono = :telefono, fechan = :fechan WHERE id = :id";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':nombre', $nombre);
			$stmt->bindParam(':apellidop', $apellidop);
			$stmt->bindParam(':apellidom', $apellidom);
			$stmt->bindParam(':correo', $correo);
			$stmt->bindParam(':contrasena', $contrasena);
			$stmt->bindParam(':telefono', $telefono);
			$stmt->bindParam(':fechan', $fechan);
	
			if ($stmt->execute()) {
				header('Location: /dbbienesraices/usuarios/index.php');
				exit();
			} else {
				return false;
			}
		
	}
	

	public function delete($id) {
    	$query="DELETE FROM ". $this->table ." where id = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1,$id);

    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/usuarios/index.php');
			exit();
    	} else {
        	return false;
    	}
	}
}
?>
