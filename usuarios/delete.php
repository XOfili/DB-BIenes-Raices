<?php


$id = $_GET['id'];

include_once '../config/db.php';
include_once '../controllers/UsuariosController.php';
$database = new Db();
$db = $database->getConnection();
$usuario = new UsuariosController($db);

$stmt = $usuario->delete($id);


?>
