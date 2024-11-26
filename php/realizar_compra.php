<?php
    session_start();
    include("conexion_db.php");

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: login.php");
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'];

    // Consulta del carrito
    $query_carrito = "
        SELECT 
            c.id_producto, 
            c.cantidad_c, 
            p.cant_almacen_p
        FROM 
            carrito c
        JOIN 
            producto p ON c.id_producto = p.id_producto
        WHERE 
            c.id_usuario = $id_usuario";
    $result_carrito = mysqli_query($con, $query_carrito);

    // Verificar que el carrito no esté vacío
    if (mysqli_num_rows($result_carrito) > 0) {
        while ($row = mysqli_fetch_assoc($result_carrito)) {
            $id_producto = $row['id_producto'];
            $cantidad_c = $row['cantidad_c'];
            $cant_almacen_p = $row['cant_almacen_p'];

            // Verificar inventario
            if ($cant_almacen_p >= $cantidad_c) {
                // Insertar en historial_compras
                $query_historial = "
                    INSERT INTO historial_compras (id_usuario, id_producto, cantidad_h) 
                    VALUES ($id_usuario, $id_producto, $cantidad_c)";
                if (!mysqli_query($con, $query_historial)) {
                    die("Error en historial_compras: " . mysqli_error($con));
                }

                // Actualizar inventario
                $query_update_producto = "
                    UPDATE producto 
                    SET cant_almacen_p = cant_almacen_p - $cantidad_c 
                    WHERE id_producto = $id_producto";
                if (!mysqli_query($con, $query_update_producto)) {
                    die("Error en producto: " . mysqli_error($con));
                }
            } else {
                // Inventario insuficiente
                echo '<br><br><div class="alert alert-danger alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Lo sentimos!</strong> De momento no hay existencias de algunos productos seleccionados.</div>';
                mysqli_close($con);
            }
        }

        // Vaciar el carrito
        $query_vaciar_carrito = "DELETE FROM carrito WHERE id_usuario = $id_usuario";
        if (!mysqli_query($con, $query_vaciar_carrito)) {
            die("Error al vaciar el carrito: " . mysqli_error($con));
        }

        // Compra exitosa
        echo '<br><br><div class="alert alert-success alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Transacción exitosa!</strong> Muchas gracias por tu compra.</div>';
        mysqli_close($con);
    } else {
        // Carrito vacío
        echo '<br><br><div class="alert alert-danger alert-dismissible"><button type="button" class="btn-close" data-bs-dismiss="alert"></button><strong>Lo sentimos!</strong> Parece que tu carrito está vacío.</div>';
        mysqli_close($con);
    }
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
        <div class="container">
        <form action="historial.php" method="POST">
          <button type="submit" class="btn btn-danger">Ver historial de compras</button>
        </form>
        </div>
     </div>
    
</body>
</html>