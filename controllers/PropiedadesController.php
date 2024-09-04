<?php

class PropiedadesController {

	private $conn;
	private $table = "propiedades";

	public $id;
	public $ubicacion;
	public $terreno_m2;
    public $construccion_m2;
    public $habitaciones;
    public $banos;
	public $disponible;
	public $precio;
    public $extras;
    public $descripcion;



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
    	$this->ubicacion = $row['ubicacion'];  
    	$this->terreno_m2 = $row['tereno_m2'];
        $this->construccion_m2 = $row['construccion_m2'];
        $this->habitaciones = $row['habitaciones'];
        $this->banos = $row['banos'];  
    	$this->disponible = $row['disponible'];
        $this->precio = $row['precio'];
        $this->extras = $row['extras'];
        $this->descripcion = $row['descripcion'];  

		return $stmt;
		
	}

	public function countItems() {
    	$query="SELECT id FROM ". $this->table .";";
    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();
    	$num = $stmt->rowCount();

    	return $num;
	}

	function create($ubicacion, $terreno_m2, $construccion_m2, $habitaciones, $banos, $disponible, $precio, $extras, $descripcion) {

    	$query = "INSERT INTO ". $this->table ."(ubicacion, terreno_m2, construccion_m2, habitaciones, banos, disponible, precio, extras, descripcion) VALUES (?,?,?,?,?,?,?,?,?)";
    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $ubicacion);
    	$stmt->bindParam(2, $terreno_m2);
        $stmt->bindParam(3, $construccion_m2);
        $stmt->bindParam(4, $habitaciones);
        $stmt->bindParam(5, $banos);
        $stmt->bindParam(6, $disponible);
        $stmt->bindParam(7, $precio);
        $stmt->bindParam(8, $extras);
        $stmt->bindParam(9, $descripcion);



    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/propiedades/index.php');
			exit();
    	} else {
        	return false;
    	}
	}    

	public function update($id, $ubicacion, $terreno_m2, $construccion_m2, $habitaciones, $banos, $disponible, $precio, $extras, $descripcion) {
		$query = "UPDATE propiedades SET ubicacion = :ubicacion, terreno_m2 = :terreno_m2, construccion_m2 = :construccion_m2, habitaciones = :habitaciones, banos = :banos, disponible = :disponible, precio = :precio, extras = :extras, descripcion = :descripcion WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':ubicacion', $ubicacion);
		$stmt->bindParam(':terreno_m2', $terreno_m2);
		$stmt->bindParam(':construccion_m2', $construccion_m2);
		$stmt->bindParam(':habitaciones', $habitaciones);
		$stmt->bindParam(':banos', $banos);
		$stmt->bindParam(':disponible', $disponible);
		$stmt->bindParam(':precio', $precio);
		$stmt->bindParam(':extras', $extras);
		$stmt->bindParam(':descripcion', $descripcion);
   	 
    	if ($stmt->execute()) {
			header('Location: /dbbienesraices/propiedades/index.php');
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
			header('Location: /dbbienesraices/propiedades/index.php');
			exit();
    	} else {
        	return false;
    	}
	}
}
?>
