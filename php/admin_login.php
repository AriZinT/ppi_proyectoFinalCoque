<?php
session_start();
//el archivo al que es redirigido el usuario que intenta acceder con trampa a la pestaña de admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['contrasena'];

    if ($password === "admin24") { //checa que si sea la contraseña del admin
        $_SESSION['admin_confirmado'] = true;
        header("Location: admin.php"); // carga otra vez a admin.php si es correcto
        exit();
    } else {
        $error = "Contraseña incorrecta. Intenta nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-danger">Acceso de Administrador</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="admin_login.php" class="mt-4">
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña de administrador:</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Ingresar</button>
            </div>
        </form>
    </div>
</body>
</html>
