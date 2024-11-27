<?php
include("conexion_db.php"); //establece la conexión con la bd

//revisa y valida los campos del formulario, quita caracteres especiales
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_prod = mysqli_real_escape_string($con, $_POST["nombre_p"]);
    $descripcion_prod = mysqli_real_escape_string($con, $_POST["descripcion_p"]);
    $foto_prod = $_FILES['foto_p']['tmp_name']; //se necesita guardar el archivo y su ubicación temporal en una supervariable $_FILES
    $precio_prod = floatval($_POST["precio_p"]); //recupera un float
    $cantidad_prod = intval($_POST["cant_almacen_p"]); //recupera un int
    $categoria_prod = intval($_POST["id_categoria"]); //recupera un int

    //aquí se verifica que el rango esté dentro de 1 y 6, porque el usuario puede insertar otro número
    if ($categoria_prod < 1 || $categoria_prod > 6) {
        die('<div class="alert alert-danger text-center">Error: Categoría no válida.</div>');
    }

  
    if ($_FILES['foto_p']['error'] !== UPLOAD_ERR_OK) { //aquí se revisa que no haya error al cargar la imagen
        die('<div class="alert alert-danger text-center">Error al cargar la imagen.</div>'); //si lo hay, detiene la ejecución del script
    }
    $foto_bin = addslashes(file_get_contents($foto_prod));//addslashes equivale al mysql_real_escape_string, caracteres de escape

    //aquí prepara query para insert
    $query_insertar = "INSERT INTO producto (nombre_p, descripcion_p, foto_p, precio_p, cant_almacen_p, id_categoria) 
                       VALUES ('$nombre_prod', '$descripcion_prod', '$foto_bin', '$precio_prod', '$cantidad_prod', '$categoria_prod');";

    //la ejecuta y revisa que se haya logrado, para si no, mandar mensajes de alerta y detener script
    if (!mysqli_query($con, $query_insertar)) {
        die('<div class="alert alert-danger text-center">Error en la base de datos: ' . mysqli_error($con) . '</div>');
    }
    echo '<div class="alert alert-success text-center">¡Producto registrado exitosamente!</div>';
} else {
    die('<div class="alert alert-danger text-center">Método de solicitud no válido.</div>');
}

mysqli_close($con); //cierra conexión
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
        <!-- el echo de abajo podría ir fuera de código php -->
        <?php
        if (!mysqli_query($con, $query)) {
            die('Error: ' . mysqli_error($con));
        }
        echo '<br><br><div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Éxito!</strong> El producto se registró correctamente</div>';
        mysqli_close($con);
        ?>
     </div>
    
</body>
</html>