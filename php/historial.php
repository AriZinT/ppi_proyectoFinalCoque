<?php
  session_start();
  include("conexion_db.php");

  if (!isset($_SESSION['id_usuario'])) {
      header("Location: login.php"); //debe redirigir a login para poder ver el historial
      exit();
  }

  $id_usuario = $_SESSION['id_usuario'];


    $query_carrito = "
    SELECT 
        p.nombre_p AS nombre_producto, 
        h.cantidad_h AS cantidad, 
        (h.cantidad_h * p.precio_p) AS total_producto
    FROM 
        historial_compras h
    JOIN 
        producto p ON h.id_producto = p.id_producto
    WHERE 
        h.id_usuario = $id_usuario;";

    if (mysqli_connect_errno()) {
        echo "<div class=\"alert alert-danger\"><strong>Error!</strong>" . mysqli_connect_error() . "</div>";
    }
    $result_carrito = mysqli_query($con, $query_carrito);
    
    $query_total = "
    SELECT 
        SUM(h.cantidad_h * p.precio_p) AS total_precio
    FROM 
        historial_compras h
    JOIN 
        producto p ON h.id_producto = p.id_producto
    WHERE 
        h.id_usuario = $id_usuario;";

    $result_total = mysqli_query($con, $query_total);
    $total_precio = mysqli_fetch_assoc($result_total)['total_precio'];

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
                  <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 10): ?>
                    <li class="nav-item">
                      <a class="nav-link text-danger" href="admin.php">Administración</a>
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
          <h2 class="my-5">Tu historial de compras: <?php echo $_SESSION['nombre'] ?></h2>
            <table class="table striped">
            <thead>
                <tr>
                    <th>Nombre del producto</th>
                    <th>Cantidad</th>
                    <th>Total por producto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result_carrito)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_producto'] . "</td>";
                        echo "<td>" . $row['cantidad'] . "</td>";
                        echo "<td>" . $row['total_producto'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <p><strong>Importe total de compra (histórico):</strong> $<?= number_format($total_precio, 2); ?></p>
        </div>
     </div>
    
</body>
</html>