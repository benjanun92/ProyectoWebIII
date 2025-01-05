<?php
include("../../Config/conexion.php");

$iddetalle = $_GET["DETALLE_ID"] ?? '';  // Obtener el ID del detalle desde la URL

// Verifica si el ID del detalle fue recibido correctamente
if (!empty($iddetalle)) {
    // Eliminar el detalle del pedido de la base de datos
    $delete = "DELETE FROM detallePedido WHERE iddetalle = '" . mysqli_real_escape_string($link, $iddetalle) . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Muestra una alerta de éxito
        echo "<script type='text/javascript'>
                alert('Detalle de pedido eliminado correctamente.');
                window.location.href = '../xframe/frameDetallePedido.php';  // Redirige a la página correcta
              </script>";
    } else {
        // Muestra una alerta de error
        echo "<script type='text/javascript'>
                alert('Error al eliminar el detalle de pedido: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameDetallePedido.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID del detalle, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de detalle no recibido.');
            window.location.href = '../xframe/frameDetallePedido.php';  // Redirige a la página correcta
          </script>";
}
?>
