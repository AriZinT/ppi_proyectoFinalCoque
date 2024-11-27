<?php
  session_start();
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
              <img src="img/coque.jpg" alt="Coque Logo" style="width:40px;" class="rounded-pill">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link text-danger active" href="index.php">Página Principal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="php/productos.php">Productos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="php/carrito.php">Carrito</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="php/historial.php">Tu Historial</a>
                  </li>
                  <li class="nav-item"><a class="nav-link text-danger" href="php/perfil_usuario.php">Tu Perfil
                    <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo ": " . $_SESSION['nombre'];
                      }else{
                        echo '';
                      }
                    ?>
                    </a></li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="php/nueva_cuenta.php">Nueva Cuenta</a>
                  </li>
                  <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 10): ?>
                    <li class="nav-item">
                      <a class="nav-link text-danger" href="php/admin_login.php">Administración</a>
                    </li>
                  <?php endif; ?>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="about.php">Acerca de Nosotros</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-danger" href=
                    <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo "php/logout.php";
                      }else{
                        echo "php/login.php";
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
                  <!--https://www.w3schools.com/bootstrap5/bootstrap_carousel.php -->
                  <!-- Carousel -->
          <div id="demo" class="carousel slide" data-bs-ride="carousel">

          <!-- Indicators/dots -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
          </div>

          <!-- The slideshow/carousel -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/nombre.jpg" alt="Coque" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
              <img src="img/ladybug.jpg" alt="Catarina" class="d-block" style="width:100%">
            </div>
          </div>

          <!-- Left and right controls/icons -->
          <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
          </div>

        <div class="container">
            <h1 class="my-5 text-danger" style="text-align: center; font-size: 2em;">Bienvenido.</h1>
            <h2 style="text-align: center; font-size: 1.5em;">Si lo que buscas es probar algo hecho con pasión por la cocina, estás en el lugar correcto.</h2>
            <br>
            <br>
            <div class="row justify-content-center">
                    <!--Para modificar producto-->
                    <div class="col-md-4 mb-3">
                        <a href="php/productos.php" class="btn btn-danger w-100 py-3">
                            Ver Productos
                        </a>
                    </div>
            </div>
        </div>
     </div>
    
</body>
</html>