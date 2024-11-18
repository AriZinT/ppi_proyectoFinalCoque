<?php
    include("conexion_db.php");

    $query = "SELECT 
            p.nombre_p AS nombre_producto, 
            p.foto_p AS foto_producto, 
            p.descripcion_p AS descripcion_producto, 
            p.precio_p AS precio_producto, 
            c.nombre_cat AS nombre_categoria
        FROM 
            producto p
        JOIN 
            categoria c ON p.id_categoria = c.id_categoria;";
        if (mysqli_connect_errno()) {
          echo "<div class=\"alert alert-danger\"><strong>Error!</strong>" . mysqli_connect_error() . "</div>";
        }
        $result = mysqli_query($con, $query);

        $productos = []; //crea un arreglo para guardar los productos

        if ($result->num_rows > 0) { //si si hay elementos en la consulta
          while ($row = $result->fetch_assoc()) { //crea un arreglo asociativo
          $productos[] = $row;
          }
        }
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coque - Productos</title>
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
                    <a class="nav-link text-danger" href="../index.html">Página Principal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger active" href="php/productos.php">Productos</a>
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
                    <a class="nav-link text-danger" href="../about.html">Acerca de Nosotros</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav> 
        <div class="mt-4 p-5 bg-light text-white rounded">
            <h1 class="text-danger">C O Q U É</h1>
        </div>
        <div class="container">
            <h2 class="my-5">Productos</h2>
            <div class="row">
                <?php foreach ($productos as $producto): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="data:image/jpeg;base64,<?= base64_encode($producto['foto_producto']); ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre_producto']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($producto['nombre_producto']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($producto['descripcion_producto']); ?></p>
                                <p class="card-text"><strong>Precio:</strong> $<?= number_format($producto['precio_producto'], 2); ?></p>
                                <p class="card-text"><em>Categoría:</em> <?= htmlspecialchars($producto['nombre_categoria']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
     </div>
    
</body>
</html>