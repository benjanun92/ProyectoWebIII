<?php
include("../../Config/conexion.php");

// Obtener el ID de la factura desde la URL
$idfactura = $_GET["IDFACTURA"] ?? '';  

// Verifica si el ID de la factura fue recibido correctamente
if (!empty($idfactura)) {
    // Eliminar la factura de la base de datos
    $delete = "DELETE FROM factura WHERE idfactura = '" . mysqli_real_escape_string($link, $idfactura) . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        echo "<script type='text/javascript'>
                alert('Factura eliminada correctamente.');
                window.location.href = '../xframe/frameFactura.php';  // Redirige a la página correcta
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error al eliminar la factura: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameFactura.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID de factura, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de Factura no recibido.');
            window.location.href = '../xframe/frameFactura.php';  // Redirige a la página correcta
          </script>";
}
?>
