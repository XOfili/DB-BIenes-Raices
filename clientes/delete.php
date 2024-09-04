<?php


$id = $_GET['id'];

include_once '../config/db.php';
include_once '../controllers/ClientesController.php';
$database = new Db();
$db = $database->getConnection();
$cliente = new ClientesController($db);

$stmt = $cliente->delete($id);


?>