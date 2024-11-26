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
                  <li class="nav-item">
                    <a class="nav-link text-danger" href="php/admin.php">Administración</a>
                  </li>
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
        <div class="mt-4 p-5 bg-light text-white rounded">
            <h1 class="text-danger">C O Q U É</h1>
        </div>
        <div class="container">
            <h2 class="my-5">Acerca de Coqué</h2>
            <h5>C O Q U É  surge del amor por la buena cocina, del cuidado a los detalles y de la pasión por los ingredientes de calidad. 
              Cocinar es un arte y una ciencia, por lo que nuestros productos están inspirados en grandes figuras , influyentes en su ramo. </h5>
              <br>
              <h5>Cada receta tiene un origen especial, ya sea una herencia familiar que ha pasado de generación en generación, o la inspiración en una receta con tradición y gran riqueza cultural. </h5>
              <br>
            <h5>Cada detalle es lo más importante. Por eso, nuestros empaques son completamente reciclabes. Todo es elaborado con materiales especiales para evitar el uso de plásticos. El papel puede desprenderse, desdoblarse y utilizarse para notas, dibujos e incluso diseños de origami. </h5>
            <br>
            <h5>Te invitamos a seguir la iniciativa y compartirnos las creativas formas en las que decidas reutilizar nuestros empaques.</h5>
            <br>
            <h5>Gracias por elegirnos y así formar parte de un proyecto tan especial.</h5>
            <br>
            <p><strong>Contacto: </strong> 55 1122 3344 </p>
            <p><strong>Instagram: </strong> <a href="https://www.instagram.com/coque_mx/" target="_blank" class="text-danger">@coque_mx</a></p>
        </div>
     </div>
    
</body>
</html>