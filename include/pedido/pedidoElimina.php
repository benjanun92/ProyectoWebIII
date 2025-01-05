<?php
include("../../Config/conexion.php");

$idpedido = $_GET["PEDIDO_ID"] ?? '';  // Obtener el ID del pedido desde la URL

// Verifica si el ID del pedido fue recibido correctamente
if (!empty($idpedido)) {
    // Eliminar el pedido de la base de datos
    $delete = "DELETE FROM pedido WHERE idpedido = '" . mysqli_real_escape_string($link, $idpedido) . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Muestra una alerta de éxito
        echo "<script type='text/javascript'>
                alert('Pedido eliminado correctamente.');
                window.location.href = '../xframe/framePedido.php';  // Redirige a la página correcta
              </script>";
    } else {
        // Muestra una alerta de error
        echo "<script type='text/javascript'>
                alert('Error al eliminar el pedido: " . mysqli_error($link) . "');
                window.location.href = '../xframe/framePedido.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID del pedido, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de Pedido no recibido.');
            window.location.href = '../xframe/framePedido.php';  // Redirige a la página correcta
          </script>";
}
?>
