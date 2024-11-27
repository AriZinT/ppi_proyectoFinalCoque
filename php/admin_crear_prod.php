<?php
  session_start(); //inicia la sesión de php

  if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 10) {
    header("Location: login.php"); //redirige si no es administrador
    exit();
}

if (!isset($_SESSION['admin_confirmado']) || $_SESSION['admin_confirmado'] !== true) {
    header("Location: admin_login.php"); //manda ahora sí a a la página de login de administrador
    exit();
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
                <img src="../img/coque.jpg" alt="Coque Logo" style="width:40px;" class="rounded-pill">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link text-danger active" href="../index.php">Página Principal</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="productos.php">Productos</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="carrito.php">Carrito</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="historial.php">Tu Historial</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="perfil_usuario.php">Tu Perfil
                    <?php
                      if (isset($_SESSION['id_usuario'])){
                        echo ": " . $_SESSION['nombre'];
                      }else{
                        echo '';
                      }
                    ?>
                    </a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="nueva_cuenta.php">Nueva Cuenta</a></li>
                        <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 10): ?>
                            <li class="nav-item">
                            <a class="nav-link text-danger" href="admin_login.php">Administración</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link text-danger" href="../about.php">Acerca de Nosotros</a></li>
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
            <h2 class="my-5">Creación de nuevo producto</h2>
            <form action="admin_confirmar_carga_prod.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <label for="nombre_p" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre_p" placeholder="Ingrese el nombre del producto" name="nombre_p" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="descripcion_p" class="form-label">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion_p" placeholder="Ingrese una descripción breve" name="descripcion_p" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="foto_p" class="form-label">Cargar Foto:</label>
                    <input type="file" class="form-control" id="foto_p" name="foto_p" accept="image/*" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="precio_p" class="form-label">Precio del Producto:</label>
                    <input type="number" class="form-control" id="precio_p" name="precio_p" placeholder="Ingrese el precio del producto" step="0.01" max="9999.99" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="cant_almacen_p" class="form-label">Cantidad en almacén:</label>
                    <input type="number" class="form-control" id="cant_almacen_p" placeholder="Ingrese la cantidad en almacén" name="cant_almacen_p" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="id_categoria" class="form-label">Categoría:</label>
                    <p>Seleccione una de las siguientes:<p>
                        <ul>1: Pasteles y Tartas</ul>
                        <ul>2: Galletas y Panecillos</ul>
                        <ul>3: Otros Postres</ul>
                        <ul>4: Panes dulces</ul>
                        <ul>5: Panes Salados</ul>
                        <ul>6: Acompañamientos</ul>
                        <!-- Abajo: se controla con min y max que las flechas solo puedan elegir entre 1 y 6, pero el usuario podría ingresar otro número, eso se valida en admin_confirmar_carga_prod -->
                    <input type="number" class="form-control" id="id_categoria" placeholder="Ingrese el ID de categoría" name="id_categoria" min="1" max="6" required>
                </div>
                <button type="submit" class="btn btn-danger mb-3">Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>
