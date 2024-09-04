<?php


$id = $_GET['id'];

include_once '../config/db.php';
include_once '../controllers/PropiedadesController.php';
$database = new Db();
$db = $database->getConnection();
$propiedad = new PropiedadesController($db);

$stmt = $propiedad->delete($id);


?>
