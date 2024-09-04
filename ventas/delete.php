<?php


$id = $_GET['id'];

include_once '../config/db.php';
include_once '../controllers/VentasController.php';
$database = new Db();
$db = $database->getConnection();
$ventas = new VentasController($db);

$stmt = $ventas->delete($id);


?>
