<?php
    session_start();
    include("conexion_db.php"); // Conexión a la base de datos

            //si no ha iniciado sesion nadie:
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: login.php"); //debe redirigir a login para poder agregar al carrito
            exit();
        }

        //productos.php mandó un id_producto
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $id_producto = intval($_POST['id_producto']);
            // echo $id_producto;
            $cantidad = 1; //solo se puede de uno en uno

            // Verificar si el producto ya está en el carrito del usuario
            $query_revisa = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario' AND id_producto = '$id_producto';";
            $result_revisa = mysqli_query($con, $query_revisa);
            // echo mysqli_num_rows($result_revisa);

            if (mysqli_num_rows($result_revisa) > 0) {
                //si el producto ya está en el carrito, aumenta la cantidad
                $query_update = "UPDATE carrito SET cantidad_c = cantidad_c + '$cantidad' WHERE id_usuario = '$id_usuario' AND id_producto = '$id_producto';";
                mysqli_query($con, $query_update);
            } else {
                //si no está en el carrito, hace un insert nuevo
                $query_insert = "INSERT INTO carrito (id_usuario, id_producto, cantidad_c) VALUES ('$id_usuario', '$id_producto', '$cantidad');";
                echo $query_insert;

                mysqli_query($con, $query_insert);
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
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="perfil_usuario.php">Tu Perfil</a>
                  </li>
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
        echo '<br><br><div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Éxito!</strong> Tu producto se agregó correctamente al carrito.</div>';
        mysqli_close($con);
        ?>
        <a href="productos.php" class="btn btn-danger">Seguir comprando</a>
     </div>
    
</body>
</html>