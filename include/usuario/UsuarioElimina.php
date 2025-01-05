<?php
include("../../Config/conexion.php");

$idusuario = $_GET["USUARIO_ID"] ?? '';  // Obtener el ID del usuario desde la URL

// Verifica si el ID del usuario fue recibido correctamente
if (!empty($idusuario)) {
    // Eliminar al usuario de la base de datos
    $delete = "DELETE FROM usuario WHERE idusuario = '" . $idusuario . "'";

    // Ejecuta la consulta
    $result = mysqli_query($link, $delete);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Muestra una alerta de éxito
        echo "<script type='text/javascript'>
                alert('Usuario eliminado correctamente.');
                window.location.href = '../xframe/frameUsuario.php';  // Redirige a la página correcta
              </script>";
    } else {
        // Muestra una alerta de error
        echo "<script type='text/javascript'>
                alert('Error al eliminar el usuario: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameUsuario.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID de usuario, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de Usuario no recibido.');
            window.location.href = '../xframe/frameUsuario.php';  // Redirige a la página correcta
          </script>";
}
?>
