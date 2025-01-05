<?php
include("../../Config/conexion.php");

$idCamarero = $_GET["ID_CAMARERO"] ?? '';  // Obtener el ID del camarero desde la URL

// Verifica si el ID del camarero fue recibido correctamente
if (!empty($idCamarero)) {
    // Eliminar al camarero de la base de datos
    $delete = "DELETE FROM camarero WHERE idcamarero = '" . $idCamarero . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Muestra una alerta de éxito
        echo "<script type='text/javascript'>
                alert('Camarero eliminado correctamente.');
                window.location.href = '../xframe/frameCamarero.php';  // Redirige a la página correcta
              </script>";
    } else {
        // Muestra una alerta de error
        echo "<script type='text/javascript'>
                alert('Error al eliminar el camarero: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameCamarero.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID del camarero, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de Camarero no recibido.');
            window.location.href = '../xframe/frameCamarero.php';  // Redirige a la página correcta
          </script>";
}
?>
