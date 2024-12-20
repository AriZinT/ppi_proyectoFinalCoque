<?php
  session_start();
  include("conexion_db.php");

  if (!isset($_SESSION['id_usuario'])) {
      header("Location: login.php"); //debe redirigir a login para poder agregar al carrito
      exit();
  }

  $id_usuario = $_SESSION['id_usuario'];

  
    //para ver todo el carrito del usuario con la sesión activa, con join a producto para ver el nombre del prod
    $query_carrito = "
    SELECT 
        p.id_producto AS id_prod,
        p.nombre_p AS nombre_producto, 
        c.cantidad_c AS cantidad, 
        (c.cantidad_c * p.precio_p) AS total_producto
    FROM 
        carrito c
    JOIN 
        producto p ON c.id_producto = p.id_producto
    WHERE 
        c.id_usuario = $id_usuario;";

    if (mysqli_connect_errno()) {
        echo "<div class=\"alert alert-danger\"><strong>Error!</strong>" . mysqli_connect_error() . "</div>";
    }
    $result_carrito = mysqli_query($con, $query_carrito);
    //query para ver el total acumulado
    $query_total = "
    SELECT 
        SUM(c.cantidad_c * p.precio_p) AS total_precio
    FROM 
        carrito c
    JOIN 
        producto p ON c.id_producto = p.id_producto
    WHERE 
        c.id_usuario = $id_usuario;";

    $result_total = mysqli_query($con, $query_total);
    $total_precio = mysqli_fetch_assoc($result_total)['total_precio'];

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
                    <a class="nav-link text-danger" href="#">Carrito</a>
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
        <div class="container">
            <h2 class="my-5">Tu Carrito: <?php echo $_SESSION['nombre'] ?></h2>
            <table class="table striped">
            <thead>
                <tr>
                    <th>Nombre del producto</th>
                    <th>Cantidad</th>
                    <th>Total por producto</th>
                    <th>Edición</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result_carrito)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_producto'] . "</td>";
                        echo "<td>" . $row['cantidad'] . "</td>";
                        echo "<td>" . $row['total_producto'] . "</td>";
                        echo "<td><form method='POST' action='actualizar_carrito.php'><input type='hidden' name='id_prod' value=" . $row['id_prod'] . "><button type='submit' class='btn btn-danger btn-sm'>Eliminar</button></form></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <p><strong>Total del carrito:</strong> $<?= number_format($total_precio, 2); ?></p>
        <form action="realizar_compra.php" method="POST">
          <button type="submit" class="btn btn-danger">Realizar compra</button>
        </form>
              <!--botón para seguir comprando-->
              <div class="col-md-4 mb-3 mt-3">
                  <a href="productos.php" class="btn btn-danger w-40 py-1">
                      Ver productos
                  </a>
              </div>
        </div>
     </div>
     <?php mysqli_close($con); ?>
</body>
</html>
