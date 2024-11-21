

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
        <div class="container">
              <div class="container my-5">
                <h2 class="text-center mb-4">Opciones de Administración</h2>
                <div class="row justify-content-center">
                    <!--Para modificar producto-->
                    <div class="col-md-4 mb-3">
                        <a href="admin_modificar_prod.php" class="btn btn-danger w-100 py-3">
                            Modificar Producto
                        </a>
                    </div>
                    <!-- Para crear nuevo producto -->
                    <div class="col-md-4 mb-3">
                        <a href="admin_crear_prod.php" class="btn btn-danger w-100 py-3">
                            Crear Producto
                        </a>
                    </div>
                    <!--para historial de compras-->
                    <div class="col-md-4 mb-3">
                        <a href="admin_mostrar_historial.php" class="btn btn-danger text-white w-100 py-3">
                            Mostrar Historial
                        </a>
                    </div>
                </div>
              </div>
          </div>
     </div>
    
</body>
</html>