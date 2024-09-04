<?php

class db {

		private $host = "localhost";
		private $user = "bienesraices";
		private $password = "BiEnEsRaIcEs1_";
		private $database = "bienesraices";
		private $conn = null;
		
		public function getConnection() {
			$this->conn = null;

			try {
				$this->conn = new PDO("mysql:host=".$this->host."; dbname=".
				$this->database, $this->user, $this->password);
			} catch(PDOException $e){
				echo "Error de conexión: " . $e->getMessage();
			}

			return $this->conn;
		}
	} 

?>

