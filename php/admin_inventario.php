<?php
session_start();
include("conexion_db.php");

if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 10) {
    header("Location: login.php"); // Redirigir si no hay sesión iniciada por nadie
    exit();
}

if (!isset($_SESSION['admin_confirmado']) || $_SESSION['admin_confirmado'] !== true) {
    header("Location: admin_login.php"); //redirige también si no es admin, para evitar cambiar la URL y entrar por ahí
    exit();
}

//query para obtener toda la tabla producto sin el campo foto_p
$query_inventario = "SELECT id_producto, nombre_p, descripcion_p, cant_almacen_p, id_categoria FROM producto;";
$result_inventario = mysqli_query($con, $query_inventario);
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
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
                        <li class="nav-item"><a class="nav-link text-danger" href="perfil_usuario.php">Tu Perfil</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="nueva_cuenta.php">Nueva Cuenta</a></li>
                        <?php if (isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == 10): ?>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="admin_login.php">Administración</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link text-danger" href="../about.php">Acerca de Nosotros</a></li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?php echo isset($_SESSION['id_usuario']) ? './logout.php' : './login.php'; ?>">
                                <?php echo isset($_SESSION['id_usuario']) ? 'Cerrar Sesión' : 'Iniciar Sesión'; ?>
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
            <h2 class="my-5">Inventario:</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID de producto</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Cantidad en Almacén</th>
                        <th>ID de Categoría</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result_inventario)): ?>
                        <tr>
                            <td><?php echo $row['id_producto']; ?></td>
                            <td>
                                <form method="POST" action="actualizar_producto.php">
                                    <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                                    <input type="text" name="nombre_p" class="form-control" value="<?php echo $row['nombre_p']; ?>" required>
                            </td>
                            <td>
                                <input type="text" name="descripcion_p" class="form-control" value="<?php echo $row['descripcion_p']; ?>" required>
                            </td>
                            <td>
                                <input type="number" name="cant_almacen_p" class="form-control" value="<?php echo $row['cant_almacen_p']; ?>" min="0" required>
                            </td>
                            <td>
                                <input type="number" name="id_categoria" class="form-control" value="<?php echo $row['id_categoria']; ?>" min="1" max="6" required>
                            </td>
                            <td>
                                <button type="submit" name="accion" value="actualizar" class="btn btn-danger">Modificar</button>
                                <!-- el valor de "accion" va a revisarse en el archivo que actualiza el inventario con comparación estricta-->
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="actualizar_producto.php">
                                    <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
                                    <button type="submit" name="accion" value="eliminar" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
