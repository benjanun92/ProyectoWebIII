<?php
include("../../Config/conexion.php");

$idmenu = $_GET["IDMENU"] ?? '';  // Obtener el ID del menú desde la URL

// Verifica si el ID del menú fue recibido correctamente
if (!empty($idmenu)) {
    // Eliminar el menú de la base de datos
    $delete = "DELETE FROM menu WHERE idmenu = '" . mysqli_real_escape_string($link, $idmenu) . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Muestra una alerta de éxito
        echo "<script type='text/javascript'>
                alert('Menú eliminado correctamente.');
                window.location.href = '../xframe/frameMenu.php';  // Redirige a la página correcta
              </script>";
    } else {
        // Muestra una alerta de error
        echo "<script type='text/javascript'>
                alert('Error al eliminar el menú: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameMenu.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID del menú, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID del Menú no recibido.');
            window.location.href = '../xframe/frameMenu.php';  // Redirige a la página correcta
          </script>";
}
?>
