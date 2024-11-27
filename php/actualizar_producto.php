<?php
session_start();//abre la sesión
include("conexion_db.php"); //establece conexión a bd

//ABAJO: si no hay usuario activo o si el usuario activo no es el admin, manda a login antes de dar acceso a la página. 
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 10) { 
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $accion = $_POST['accion']; //se recibe la accion y se guarda su valor para revisarlo más adelante
    $id_producto = intval($_POST['id_producto']); //tambien se guarda la id del producto a modificar

    if ($accion === 'actualizar') { //comparacion estricta para revisar si se recibio exactamente esa palabra
        //si se hizo click en "modificar", entonces se guardan los valores recibidos con POST
        $nombre_p = mysqli_real_escape_string($con, $_POST['nombre_p']);
        $descripcion_p = mysqli_real_escape_string($con, $_POST['descripcion_p']);
        $cant_almacen_p = intval($_POST['cant_almacen_p']);
        $id_categoria = intval($_POST['id_categoria']);

        //Se prepara el query para insertar los nuevos valores luego de "limpiarlos"
        $query_actualizar = "
            UPDATE producto 
            SET 
                nombre_p = '$nombre_p',
                descripcion_p = '$descripcion_p',
                cant_almacen_p = $cant_almacen_p,
                id_categoria = $id_categoria
            WHERE id_producto = $id_producto;
        ";

        if (!mysqli_query($con, $query_actualizar)) {
            echo "Error al actualizar el producto: " . mysqli_error($con);
        }
    } elseif ($accion === 'eliminar') { //compara estrictamente para ver si recibió la acción con el valor de eliminar
        $query_eliminar = "DELETE FROM producto WHERE id_producto = $id_producto;"; //prepara query para eliminar y lo hace en ese prod

        if (!mysqli_query($con, $query_eliminar)) {
            echo "Error al eliminar el producto: " . mysqli_error($con); //echo que revisa ejecución correcta de query
        }
    }
}

mysqli_close($con); //cierra conexión
header("Location: admin_inventario.php");//recarga la página de inventario para que se pueda ver actualizada
exit();
?>
