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
    <?php
    include("conexion_db.php");

    //obtengo las categorías
    $sql = "SELECT id_categoria, nombre_cat FROM categoria";
    $result = mysqli_query($con, $sql);

    //valido si la consulta tiene errores
    if (!$result) {
        die("Error en la consulta SQL: " . mysqli_error($con));
    }
    ?>
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
                        <li class="nav-item"><a class="nav-link text-danger active" href="../index.html">Página Principal</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="productos.php">Productos</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="carrito.php">Carrito</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="historial.php">Tu Historial</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="perfil_usuario.php">Tu Perfil</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="nueva_cuenta.php">Nueva Cuenta</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="admin.php">Administración</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="../about.html">Acerca de Nosotros</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="mt-4 p-5 bg-light text-white rounded">
            <h1 class="text-danger">C O Q U É</h1>
        </div>
        <div class="container">
            <h2 class="my-5">Creación de nuevo producto</h2>
            <form action="confirmacion.php" method="post" enctype="multipart/form-data">
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
                    <select class="form-select" id="id_categoria" name="id_categoria" required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($fila = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $fila["id_categoria"] . '">' . $fila["nombre_cat"] . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No hay categorías disponibles</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger mb-3">Registrar</button>
            </form>
        </div>
    </div>
    <?php mysqli_close($con); ?>
</body>
</html>