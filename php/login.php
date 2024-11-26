<?php
session_start(); // Inicia la sesión
include 'conexion_db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = mysqli_real_escape_string($con, $_POST['correo']);
    $passwd = mysqli_real_escape_string($con, $_POST['passwd']);

    $query = "SELECT * FROM usuario WHERE correo_u='$correo' AND passwd_u='$passwd'";
    $result = mysqli_query($con, $query);
//mysqli_num_rows devuelve la cantidad de líneas que devuelve el query, sería 0 si no hay coincidencia, 1 si la hay
    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre_u'];
        header("Location: perfil_usuario.php"); // Redirige al perfil, indica al navegador que se diriga a otro lado
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Coqué</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a class="nav-link text-danger" href="productos.php">Productos</a>
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
     </div>
    <div class="container mt-5">
        <h2 class="text-center">Antes, inicia Sesión:</h2>
    <!-- isset determina si una varibale esta definida y no es null -->
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="passwd" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="passwd" name="passwd" required>
            </div>
            <button type="submit" class="btn btn-danger">Iniciar Sesión</button>
        </form>
        <p class="mt-3">¿No tienes cuenta? <a href="nueva_cuenta.php" class="text-danger">Regístrate aquí</a>.</p>
    </div>
    <?php mysqli_close($con); ?>
</body>
</html>
