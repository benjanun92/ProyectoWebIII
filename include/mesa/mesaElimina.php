<?php
include("../../Config/conexion.php");

$mesa_id = $_GET["MESA_ID"] ?? '';  // Obtener el ID de la mesa desde la URL

// Verifica si el ID de la mesa fue recibido correctamente
if (!empty($mesa_id)) {
    // Eliminar la mesa de la base de datos
    $delete = "DELETE FROM mesa WHERE idmesa = '" . $mesa_id . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Muestra una alerta de éxito
        echo "<script type='text/javascript'>
                alert('Mesa eliminada correctamente.');
                window.location.href = '../xframe/frameMesa.php';  // Redirige a la página correcta
              </script>";
    } else {
        // Muestra una alerta de error
        echo "<script type='text/javascript'>
                alert('Error al eliminar la mesa: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameMesa.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID de la mesa, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de Mesa no recibido.');
            window.location.href = '../xframe/frameMesa.php';  // Redirige a la página correcta
          </script>";
}
?>
