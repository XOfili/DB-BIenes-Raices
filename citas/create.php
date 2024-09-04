<?php 
	include_once '../config/db.php';
    include_once '../controllers/CitasController.php';

	$db = new Db();

	try {
		$conn = $db->getConnection();
		$stmt = $conn->query("SELECT * FROM clientes ORDER BY cliente ASC;"); 
		$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

    try {
        $conn2 = $db->getConnection();
        $stmt2 = $conn2->query("SELECT * FROM propiedades ORDER BY id ASC;"); 
        $propiedades = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    if($_POST) {

        $db = new Db();
        $db = $db->getConnection();
        $citas = new CitasController($db);

        $cliente_id = $_POST['cliente_id'];
        $propiedad_id = $_POST['propiedad_id'];
        $fecha = $_POST['fecha'];

        try {
            
         
            $response = $citas->create($cliente_id, $propiedad_id, $fecha);

            if($response) {

                header('Location: /dbbienesraices/citas/index.php');
                exit();

            } else  {

                echo "Error: " . $e->getMessage();

            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BIenes Raíces</title>
       <!-- Favicon-->
       <link rel="icon" type="image/x-icon" href="/dbbienesraices/assets/favicon.ico" />
       <!-- Bootstrap icons-->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/dbbienesraices/assets/css/styles.css" rel="stylesheet" />
        <link href="/dbbienesraices/assets/css/custom.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
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
            <!-- Features section-->
            <section class="" id="features">
                <div class="container mt-3">
                    <div class="row">
                         <div class="col">
                             <h1 id="titulo">Agregar Cita</h1>
                         </div>
                    </div>
                    <form method="post">  
                        <div class="row mt-3 gx-5">
                            <div class="col-4">
                                <label>Fecha</label>                         
                                <input type="datetime-local" name="fecha" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3 gx-5">
                            <div class="col">
                                <label>Cliente</label>
                                <select class="form-control" name="cliente_id">
                                    <option value="0">Seleccione</option>
                                    <?php
                                        foreach($clientes as $cliente) {

                                            ?>
                                            <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['cliente']; ?></option>

                                            <?php
                                        }

                                    ?>
                                </select>                         
                            </div>
                            <div class="col">
                                <label>Propiedad</label>        
                                <select name="propiedad_id" class="form-control">
                                    <option value="0">Seleccione</option>
                                    <?php
                                        foreach($propiedades as $propiedad) {
                                            ?>
                                            <option value="<?php echo $propiedad['id']; ?>"><?php echo $propiedad['ubicacion']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>         
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
        </main>
       <!-- Footer-->
       <footer class="py-5 bg-dark">
           <div class="container2"><p class="m-0 text-center text-white">Filiberto Sañudo</p></div>
       </footer>
       <!-- Bootstrap core JS-->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
       <!-- Core theme JS-->
       <script src="/dbbienesraices/assets/js/scripts.js"></script>
   </body>
</html>

     
