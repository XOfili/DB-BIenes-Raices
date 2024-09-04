<?php


$id = $_GET['id'];

include_once '../config/db.php';
include_once '../controllers/CitasController.php';
$database = new Db();
$db = $database->getConnection();
$cita = new CitasController($db);

$stmt = $cita->delete($id);


?>