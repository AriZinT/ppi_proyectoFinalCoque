<?php
include("conexion_db.php");
//limpieza caracteres de escape
$nombre = mysqli_real_escape_string($con, $_POST["nombre_u"]);
$correo = mysqli_real_escape_string($con, $_POST["correo_u"]);
$fecha = mysqli_real_escape_string($con, $_POST["fecha_nac_u"]);
$tarjeta = mysqli_real_escape_string($con, $_POST["num_tarjeta_u"]);
$passwd = mysqli_real_escape_string($con, $_POST["passwd_u"]);
$direccion = mysqli_real_escape_string($con, $_POST["direccion_postal_u"]);
$telefono = mysqli_real_escape_string($con, $_POST["telefono_u"]);
//query para insertar los datos del nuevo usuario
$query = "INSERT INTO usuario (nombre_u, correo_u, fecha_nac_u, num_tarjeta_u, passwd_u, direccion_postal_u, telefono_u) VALUES ('$nombre', '$correo', '$fecha', '$tarjeta', '$passwd', '$direccion', '$telefono');";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coque</title>
      <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body>
    <!-- Contenedor principal de BS5 -->
     <div class="container-fluid">
        <nav class="navbar navbar-expand-sm bg-light navbar-light">
            <div class="container-fluid">
              <!-- <a class="navbar-brand" href="#">Logo</a> -->
              <img src="../img/coque.jpg" alt="Coque Logo" style="width:40px;" class="rounded-pill"> 
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link text-danger active" href="../index.php">Página Principal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-danger" href="productos.php">Productos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="carrito.php">Carrito</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="historial.php">Tu Historial</a>
                  </li>
                  <li class="nav-item"><a class="nav-link text-danger" href="perfil_usuario.php">Tu Perfil
                    <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo ": " . $_SESSION['nombre'];
                      }else{
                        echo '';
                      }
                    ?>
                    </a></li>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="#">Nueva Cuenta</a>
                  </li>
                  <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 10): ?>
                    <li class="nav-item">
                      <a class="nav-link text-danger" href="admin_login.php">Administración</a>
                    </li>
                  <?php endif; ?>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="../about.php">Acerca de Nosotros</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href=
                    <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo "./logout.php";
                      }else{
                        echo "./login.php";
                      }
                    ?>
                    > 
                      <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo 'Cerrar Sesión';
                      }else{
                        echo 'Iniciar Sesión';
                      }
                    ?>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </nav> 
        <div class="mt-4 p-5 bg-light text-white rounded">
            <h1 class="text-danger">C O Q U É</h1>
        </div>
        <?php
        if (!mysqli_query($con, $query)) {
            die('Error: ' . mysqli_error($con));
        }
        echo '<br><br><div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Éxito!</strong> Se registró correctamente</div>';
        mysqli_close($con);
        ?>
        <!-- <a href="../index.php" class="btn btn-danger">Regresar a inicio</a> -->
     </div>
    
</body>
</html>