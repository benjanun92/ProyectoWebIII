<?php
include("../../Config/conexion.php");

$cliente_id = $_GET["CLIENTE_ID"] ?? '';  // Obtener el ID del cliente desde la URL

// Verifica si el ID del cliente fue recibido correctamente
if (!empty($cliente_id)) {
    // Primero, eliminar los pedidos asociados al cliente
    $delete_pedidos = "DELETE FROM pedido WHERE idcliente = '" . mysqli_real_escape_string($link, $cliente_id) . "'";
    $result_pedidos = mysqli_query($link, $delete_pedidos);

    // Si la eliminación de los pedidos es exitosa, eliminar las facturas asociadas
    if ($result_pedidos) {
        // Eliminar las facturas asociadas al cliente
        $delete_facturas = "DELETE FROM factura WHERE idcliente = '" . mysqli_real_escape_string($link, $cliente_id) . "'";
        $result_facturas = mysqli_query($link, $delete_facturas);

        // Si la eliminación de las facturas es exitosa, eliminar el cliente
        if ($result_facturas) {
            // Eliminar el cliente de la base de datos
            $delete_cliente = "DELETE FROM cliente WHERE idcliente = '" . mysqli_real_escape_string($link, $cliente_id) . "'";

            // Ejecuta la consulta
            $result_cliente = mysqli_query($link, $delete_cliente);

            // Verifica si la eliminación del cliente fue exitosa
            if ($result_cliente) {
                // Muestra una alerta de éxito
                echo "<script type='text/javascript'>
                        alert('Cliente, pedidos y facturas eliminados correctamente.');
                        window.location.href = '../xframe/frameCliente.php';  // Redirige a la página correcta
                      </script>";
            } else {
                // Muestra una alerta de error al eliminar el cliente
                echo "<script type='text/javascript'>
                        alert('Error al eliminar el cliente: " . mysqli_error($link) . "');
                        window.location.href = '../xframe/frameCliente.php';  // Redirige a la página correcta
                      </script>";
            }
        } else {
            // Muestra una alerta de error al eliminar las facturas
            echo "<script type='text/javascript'>
                    alert('Error al eliminar las facturas asociadas al cliente: " . mysqli_error($link) . "');
                    window.location.href = '../xframe/frameCliente.php';  // Redirige a la página correcta
                  </script>";
        }
    } else {
        // Muestra una alerta de error al eliminar los pedidos
        echo "<script type='text/javascript'>
                alert('Error al eliminar los pedidos asociados al cliente: " . mysqli_error($link) . "');
                window.location.href = '../xframe/frameCliente.php';  // Redirige a la página correcta
              </script>";
    }
} else {
    // Si no se recibió el ID de cliente, muestra una alerta de error
    echo "<script type='text/javascript'>
            alert('ID de Cliente no recibido.');
            window.location.href = '../xframe/frameCliente.php';  // Redirige a la página correcta
          </script>";
}
?>
