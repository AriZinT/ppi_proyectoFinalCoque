<?php
    session_start();
    include("conexion_db.php"); // Conexión a la base de datos

            //si no ha iniciado sesion nadie:
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: login.php"); //debe redirigir a login para poder agregar al carrito
            exit();
        }

        //productos.php mandó un id_producto
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $id_producto = intval($_POST['id_producto']);
            // echo $id_producto;
            $cantidad = 1; //solo se puede de uno en uno

            // Verificar si el producto ya está en el carrito del usuario
            $query_revisa = "SELECT * FROM carrito WHERE id_usuario = '$id_usuario' AND id_producto = '$id_producto';";
            $result_revisa = mysqli_query($con, $query_revisa);
            // echo mysqli_num_rows($result_revisa);

            if (mysqli_num_rows($result_revisa) > 0) {
                //si el producto ya está en el carrito, aumenta la cantidad
                $query_update = "UPDATE carrito SET cantidad_c = cantidad_c + '$cantidad' WHERE id_usuario = '$id_usuario' AND id_producto = '$id_producto';";
                mysqli_query($con, $query_update);
            } else {
                //si no está en el carrito, hace un insert nuevo
                $query_insert = "INSERT INTO carrito (id_usuario, id_producto, cantidad_c) VALUES ('$id_usuario', '$id_producto', '$cantidad');";
                echo $query_insert;

                mysqli_query($con, $query_insert);
            }
        }
    mysqli_close($con);
?>
