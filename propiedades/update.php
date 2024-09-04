<?php

include_once  '../config/db.php';
$db = new Db();

$id = $_GET['id'];

try{
	$conn = $db->getConnection();
	$stmt = $conn->query("SELECT * FROM propiedades where id = $id;");
	$propiedad = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_POST) {

        $ubicacion = $_POST['ubicacion'];
        $terreno_m2 = $_POST['terreno_m2'];
        $construccion_m2 = $_POST['construccion_m2'];
        $habitaciones = $_POST['habitaciones'];
        $banos = $_POST['banos'];
        $disponible = $_POST['disponible'];
        $precio = $_POST['precio'];
        $extras = $_POST['extras'];
        $descripcion = $_POST['descripcion'];
    
        include_once '../controllers/PropiedadesController.php';
        $propiedad = new PropiedadesController($conn);
    
        $propiedad->update($id, $ubicacion, $terreno_m2, $construccion_m2, $habitaciones, $banos, $disponible, $precio, $extras, $descripcion);
    }

} catch(PDOException $e){
	echo 'Error: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bienes raíces</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/dbbienesraices/assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/dbbienesraices/assets/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="/dbbienesraices/index.php">Bienes Raíces</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/dbbienesraices/usuarios/index.php">Usuarios</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/dbbienesraices/clientes/index.php">Clientes</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/dbbienesraices/ventas/index.php">Ventas</a>
                          </li>
                        <li class="nav-item"><a class="nav-link" href="/dbbienesraices/citas/index.php">Citas</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/dbbienesraices/propiedades/index.php">Propiedades</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Section-->
        <section class="" id="features">
                <div class="container mt-3">
                    <div class="row">
                         <div class="col">
                             <h1 id="titulo">Modificar propiedad</h1>
                         </div>
                    </div>
                    <form method="post">  
                        <div class="row mt-3 gx-5">
                            <div class="col-6">
                                <label>Ubicación</label>                         
                                <input type="text" name="ubicacion" class="form-control" value="<?php echo($propiedad['ubicacion']) ?>">
                            </div>
                            <div class="col-6">
                                <label>Descripción</label>                         
                                <input type="text" name="descripcion" class="form-control" value="<?php echo($propiedad['descripcion']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Metros cuadrados de terreno</label>                         
                                <input type="text" name="terreno_m2" class="form-control" value="<?php echo($propiedad['terreno_m2']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Metros cuadrados de construcción</label>                         
                                <input type="text" name="construccion_m2" class="form-control" value="<?php echo($propiedad['construccion_m2']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Habitaciones</label>                         
                                <input type="text" name="habitaciones" class="form-control" value="<?php echo($propiedad['habitaciones']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Baños</label>                         
                                <input type="text" name="banos" class="form-control" value="<?php echo($propiedad['banos']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Disponible</label>                         
                                <input type="number" name="disponible" class="form-control" value="<?php echo($propiedad['disponible']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Precio</label>                         
                                <input type="double" name="precio" class="form-control" value="<?php echo($propiedad['precio']) ?>">
                            </div>
                            <div class="col-4">
                                <label>Extras</label>                         
                                <input type="text" name="extras" class="form-control" value="<?php echo($propiedad['extras']) ?>">
                            </div>

                        </div>
                        <div class="row gx-5">
                            <div class="col right">
                                  <button type="submit" class="btn btn-secondary mt-3">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/dbbienesraices/assets/js/scripts.js"></script>
    </body>
</html>