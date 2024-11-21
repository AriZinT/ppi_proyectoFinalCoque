<?php
session_start(); // Inicia la sesión
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
    <div class="container mt-5">
        <h2 class="text-center">Sesión Cerrada</h2>
        <?php
            session_unset();
            session_destroy();
        ?>
        <a href="../index.php" class="btn btn-danger">Regresar al Inicio</a>
    </div>
</body>
</html>
