<?php
include_once '../config/db.php';
$db = new Db();

$id = $_GET['id'];

try {
    $conn = $db->getConnection();
    $stmt = $conn->query("SELECT * FROM usuarios where id = $id;");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_POST) {
        $nombre = $_POST['nombre'];
        $apellidop = $_POST['apellidop'];
        $apellidom = $_POST['apellidom'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $telefono = $_POST['telefono'];
        $fechan = $_POST['fechan'];

        include_once '../controllers/UsuariosController.php';
        $usuario = new UsuariosController($conn);

        $usuario->update($id, $nombre, $apellidop, $apellidom, $correo, $contrasena, $telefono, $fechan);

       
    }
} catch (PDOException $e) {
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
                             <h1 id="titulo">Modificar usuario</h1>
                         </div>
                    </div>
                    <form method="post">  
                        <div class="row mt-3 gx-5">
                            <div class="col-4">
                                <label>Nombre</label>                         
                                <input type="text" name="nombre" class="form-control" value="<?php echo($user['nombre']); ?>">
                            </div>
                            <div class="col-4">
                                <label>Apellido Paterno</label>                         
                                <input type="text" name="apellidop" class="form-control" value="<?php echo($user['apellidop']); ?>">
                            </div>
                            <div class="col-4">
                                <label>Apellido Materno</label>                         
                                <input type="text" name="apellidom" class="form-control" value="<?php echo($user['apellidom']); ?>">
                            </div>
                            <div class="col-4">
                                <label>Correo</label>                         
                                <input type="text" name="correo" class="form-control" value="<?php echo($user['correo']); ?>">
                            </div>
                            <div class="col-4">
                                <label>Contraseña</label>                         
                                <input type="password" name="contrasena" class="form-control" value="<?php echo($user['contrasena']); ?>">
                            </div>
                            <div class="col-4">
                                <label>Teléfono</label>                         
                                <input type="text" name="telefono" class="form-control" value="<?php echo($user['telefono']); ?>">
                            </div>
                            <div class="col-4">
                                <label>Fecha</label>                         
                                <input type="date" name="fechan" class="form-control" value="<?php echo($user['fechan']); ?>">
                            </div>
                        </div>
                        <div class="row gx-5">
                            <div class="col right">
                                  <button type="submit" class="btn btn-secondary mt-3" >Actualizar</button>
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