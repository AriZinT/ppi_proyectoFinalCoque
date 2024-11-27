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
                    <a class="nav-link text-danger" href="#">Nueva Cuenta</a>
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
          <h2 class="my-5">Creación de nueva cuenta</h2>
            <form action="confirmacion.php" method="post">
              <div class="mb-3 mt-3">
                  <label for="nombre_u" class="form-label">Nombre:</label>
                  <input type="text" class="form-control" id="nombre_u" placeholder="Ingrese su nombre completo" name="nombre_u">
              </div>
              <div class="mb-3 mt-3">
                <label for="correo_u" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo_u" placeholder="Ingrese su correo" name="correo_u">
              </div>
              <div class="mb-3">
                <label for="fecha_nac_u" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nac_u" name="fecha_nac_u">
              </div>
              <div class="mb-3">
                <label for="num_tarjeta_u" class="form-label">Número de tarjeta:</label>
                <input type="number" class="form-control" id="num_tarjeta_u" placeholder="Ingrese su número de tarjeta" name="num_tarjeta_u">
              </div>
              <div class="mb-3 mt-3">
                  <label for="passwd_u" class="form-label">Contraseña:</label>
                  <input type="password" class="form-control" id="passwd_u" placeholder="Ingrese una contraseña" name="passwd_u">
              </div>
              <div class="mb-3 mt-3">
                  <label for="direccion_postal_u" class="form-label">Dirección Postal:</label>
                  <input type="text" class="form-control" id="direccion_postal_u" placeholder="Ingrese su dirección" name="direccion_postal_u">
              </div>
              <div class="mb-3">
                <label for="telefono_u" class="form-label">Número telefónico:</label>
                <input type="number" class="form-control" id="telefono_u" placeholder="Ingrese su número telefónico" name="telefono_u">
              </div>
              <button type="submit" class="btn btn-danger mb-3">Registrar</button>
            </form>
        </div>
     </div>
    
</body>
</html>