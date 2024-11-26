<?php
session_start();
include("conexion_db.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Redirigir si no hay sesión
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_prod'])) {
    $id_producto = intval($_POST['id_prod']);

    // Verificar la cantidad actual del producto en el carrito
    $query_verificar = "SELECT cantidad_c FROM carrito WHERE id_usuario = $id_usuario AND id_producto = $id_producto;";
    $result_verificar = mysqli_query($con, $query_verificar);

    if ($result_verificar && mysqli_num_rows($result_verificar) > 0) {
        $row = mysqli_fetch_assoc($result_verificar);
        $cantidad_actual = $row['cantidad_c'];

        if ($cantidad_actual > 1) {
            //Si hay más de una una pieza en cantidad, la reduce en lugar de borrar ese registro con un update
            $query_update = "UPDATE carrito SET cantidad_c = cantidad_c - 1 WHERE id_usuario = $id_usuario AND id_producto = $id_producto;";
            if (!mysqli_query($con, $query_update)) {
                echo '<div class="alert alert-danger">Error al reducir la cantidad: ' . mysqli_error($con) . '</div>';
            }
        } else {
            // Si solo hay una pieza, borra el registro con un delete
            $query_eliminar = "DELETE FROM carrito WHERE id_usuario = $id_usuario AND id_producto = $id_producto;";
            if (!mysqli_query($con, $query_eliminar)) {
                echo '<div class="alert alert-danger">Error al eliminar el producto: ' . mysqli_error($con) . '</div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger">Producto no encontrado en el carrito.</div>';
    }
}

mysqli_close($con);
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
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="nueva_cuenta.php">Nueva Cuenta</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="admin.php">Administración</a>
                  </li>
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
        echo '<br><br><div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Éxito!</strong> Tu producto se eliminó del carrito.</div>';
        mysqli_close($con);
        ?>
       <div class="row justify-content-center">
            <!--Para ver producto-->
            <div class="col-md-4 mb-3">
                <a href="productos.php" class="btn btn-danger w-100 py-3">
                    Ver productos
                </a>
            </div>
            <!-- Para ver carrito -->
            <div class="col-md-4 mb-3">
                <a href="carrito.php" class="btn btn-danger w-100 py-3">
                    Ver carrito
                </a>
            </div>
        </div>
     </div>
</body>
</html>