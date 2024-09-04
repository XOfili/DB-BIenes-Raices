<?php


   $page = isset($_GET['page']) ? $_GET['page'] : 1;
   $records_per_page = 15;
   $from_record_num = ($records_per_page * $page) - $records_per_page;
   include_once '../config/db.php';
   include_once '../controllers/UsuariosController.php';
   $database = new Db();
   $id = $_GET['id'];
   $db = $database->getConnection();
   $product = new UsuariosController($db);
   $stmt = $db->query("SELECT * FROM usuarios where id=$id;");
       $num = $stmt->rowCount();
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
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                    <div class="col">
                        <h1>Usuario</h1>
                    </div>
      
      <table class="table table-bordered table-hover table-striped">
          <thead class="table-dark">
          <tr>
                  <th>Nombre</th>
                  <th>Apellido paterno</th>
                  <th>Apellido materno</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Fecha de nacimiento</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
          <?php
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              
                  extract($row);
          ?>
              <tr>
                      <?php echo "<td>{$nombre}</td>" ?>
                      <?php echo "<td>{$apellidop}</td>" ?>
                      <?php echo "<td>{$apellidom}</td>" ?>
                      <?php echo "<td>{$correo}</td>" ?>
                      <?php echo "<td>{$telefono}</td>" ?>
                      <?php echo "<td>{$fechan}</td>" ?>
                      <?php echo "<td width='100px'>
                      <a class='btn btn-warning btn-sm' href='update.php?id={$id}' role='button'>Modificar</a>
                      <a class='btn btn-danger btn-sm' href='delete.php?id={$id}' role='button'>Eliminar</a></td>" ?>
              </tr> 
          <?php
              }
          ?>
          </tbody>
      </table>
   
                </div>
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