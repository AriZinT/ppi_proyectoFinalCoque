<?php
session_start(); //abre la sesión
include("conexion_db.php"); //establece la conexión con la bd

if (!isset($_SESSION['id_usuario'])) { //revisa si hay una id de usuario guardada eb la supervariable de sesión
    header("Location: login.php"); // Redirigir si no hay sesión
    exit();
}

$id_usuario = $_SESSION['id_usuario']; //guarda la id en una variable temporal que se puede usar

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_prod'])) { //se revisa que la solicitud se enviara con post y que el form enviado sí tenga un id_prod en la supervariable post 
    $id_producto = intval($_POST['id_prod']); //consigue un valor entero de la variable

    //verifica la cantidad actual del producto en el carrito para el usuario activo
    $query_verificar = "SELECT cantidad_c FROM carrito WHERE id_usuario = $id_usuario AND id_producto = $id_producto;";
    $result_verificar = mysqli_query($con, $query_verificar); // guarda el resultado de la query en una variable

    if ($result_verificar && mysqli_num_rows($result_verificar) > 0) { //si se obtuvo un set de resultado
        $row = mysqli_fetch_assoc($result_verificar); //lo pasa a un arreglo asociativo
        $cantidad_actual = $row['cantidad_c']; //guarda la cantidad en una variable

        if ($cantidad_actual > 1) {
            //Si hay más de un producto en cantidad, la reduce en lugar de borrar ese registro con un update
            $query_update = "UPDATE carrito SET cantidad_c = cantidad_c - 1 WHERE id_usuario = $id_usuario AND id_producto = $id_producto;";
            if (!mysqli_query($con, $query_update)) {
                echo '<div class="alert alert-danger">Error al reducir la cantidad: ' . mysqli_error($con) . '</div>';
            }
        } else {
            //si solo hay un producto, borra el registro con un delete
            $query_eliminar = "DELETE FROM carrito WHERE id_usuario = $id_usuario AND id_producto = $id_producto;";
            if (!mysqli_query($con, $query_eliminar)) {
                echo '<div class="alert alert-danger">Error al eliminar el producto: ' . mysqli_error($con) . '</div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger">Producto no encontrado en el carrito.</div>';
    }
}

mysqli_close($con); //cierra la conexión con la base
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
                      if (isset($_SESSION['id_usuario'])){ //si hay usuario activo:
                        echo ": " . $_SESSION['nombre']; //pone su nombre en la barra
                      }else{
                        echo ''; //si no, no
                      }
                    ?>
                    </a></li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="nueva_cuenta.php">Nueva Cuenta</a>
                  </li>
                  <!-- Abajo: solo se puede ver la liga a la pag de Admin, si el id del usuario activo es 10 (id del admin) -->
                  <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 10): ?>
                    <li class="nav-item">
                      <!-- pide la contraseña del admin para poder acceder (filtro extra) -->
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
                        echo "./logout.php"; //si hay usuario activo, da la opcion de cerrar sesión
                      }else{
                        echo "./login.php"; //si no hay usuario activo, da la opción de iniciar sesión
                      }
                    ?>
                    > 
                      <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo 'Cerrar Sesión'; //texto correspondiente según lo menccionado arriba
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

        ?>
       <div class="row justify-content-center">
            <!--regresa a productos-->
            <div class="col-md-4 mb-3">
                <a href="productos.php" class="btn btn-danger w-100 py-3">
                    Ver productos
                </a>
            </div>
            <!-- regresa a carrito -->
            <div class="col-md-4 mb-3">
                <a href="carrito.php" class="btn btn-danger w-100 py-3">
                    Ver carrito
                </a>
            </div>
        </div>
     </div>
</body>
</html>

