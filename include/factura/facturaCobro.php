<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asigna las variables para la consulta
    $iddetalle = $_POST['iddetalle'] ?? '';
    $idpedido = $_POST['idpedido'] ?? '';
    $idmenu = $_POST['idmenu'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $precioTotal = $_POST['precioTotal'] ?? '';
    ////
    $idfactura = $_POST['idfactura'] ?? '';

    $total = $_POST['total'] ?? '';
    $fecha = $_POST['fecha'] ?? ''; // Fecha de la factura

    // Verificar si la factura ya existe
    $checkIdQuery = "SELECT * FROM factura WHERE idfactura = '$idfactura'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0|| $idfactura == '0' || $idfactura == null ) {
        // Si la factura ya existe, muestra un mensaje emergente
        ?>
        <script type="text/javascript">
            alert("El ID de factura ya existe. Por favor, ingresa un ID único.");
            window.history.back(); // Regresa a la página anterior
        </script>
        <?php
    } else {
        // Obtener los datos del cliente asociado al idpedido
        $clienteQuery = "SELECT c.nombre, c.apellido_paterno, c.apellido_materno 
                        FROM pedido p
                        JOIN cliente c ON p.idcliente = c.idcliente
                        WHERE p.idpedido = '$idpedido'";
        $clienteResult = mysqli_query($link, $clienteQuery);
        $clienteData = mysqli_fetch_assoc($clienteResult);

        // Asignar los valores a las variables
        $nombre = $clienteData['nombre'];
        $apellido_paterno = $clienteData['apellido_paterno'];
        $apellido_materno = $clienteData['apellido_materno'];
               
        // Si el idfactura no existe, realiza la inserción
        $RegFactura = "INSERT INTO factura(idfactura, idpedido, nombre, apellido_paterno, apellido_materno, total, fecha) 
                       VALUES ('$idfactura', '$idpedido', '$nombre', '$apellido_paterno', '$apellido_materno', '$total', '$fecha')";
        $Res = mysqli_query($link, $RegFactura);
        //////////////
        $delete = "DELETE FROM detallePedido WHERE idpedido = '" . mysqli_real_escape_string($link, $idpedido) . "'";
        $result1 = mysqli_query($link, $delete);
        
        $delete2 = "DELETE FROM pedido WHERE idpedido = '" . mysqli_real_escape_string($link, $idpedido) . "'";
        $result2 = mysqli_query($link, $delete2);

        if ($Res && $result1 && $result2) {
            // Si la inserción es exitosa, redirige
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameFactura.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            // Si hay algún error con la consulta
            echo 'Error al registrar factura: ' . mysqli_error($link);
        }
    }
}
?>
<link rel="stylesheet" type="text/css" href="../../Resource/Css/stylePopup.css" />
<script type="text/javascript">
function Validar(f, op){
    if (op == '_REGISTRAR_') {
        document.getElementById("OPERATOR").value = op;
        f.submit();
    }
}

function actualizarTabla() {
    var idpedido = document.getElementById("idpedido").value;
    window.location.href = "facturaCobro.php?idpedido=" + idpedido;
}

function calcularTotal() {
    var total = 0;
    var rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function(row) {
        var precioTotal = parseFloat(row.cells[3].textContent) || 0; // Obtener el precio de la columna 4 (Índice 3)
        total += precioTotal;
    });
    document.getElementById('total').value = total.toFixed(2); // Mostrar el total en el input
}
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Cobro de Pedido</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>SELLECCIONE EL PEDIDO A COBRAR</legend>
            
            <!-- Campo de Pedido con menú desplegable -->
            <div class="filaDiv">
                <label for="idpedido">Pedido</label>
                <select name="idpedido" id="idpedido" onchange="actualizarTabla()">
                    <?php
                    // Consulta para obtener todos los pedidos junto con el nombre del cliente
                    $resultPedidos = mysqli_query($link, "
                        SELECT p.idpedido, c.nombre, c.apellido_paterno, c.apellido_materno 
                        FROM pedido p
                        JOIN cliente c ON p.idcliente = c.idcliente
                    ");
                    
                    // Determinar el valor del idpedido a mostrar, si se pasa como parámetro
                    $selectedIdpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : '';

                    while ($pedido = mysqli_fetch_assoc($resultPedidos)) {
                        $nombreCompleto = $pedido['nombre'] . ' ' . $pedido['apellido_paterno'] . ' ' . $pedido['apellido_materno'];
                        $selected = ($pedido['idpedido'] == $selectedIdpedido) ? 'selected' : '';
                         
            
        
                        echo "<option value='{$pedido['idpedido']}' {$selected}>Pedido {$pedido['idpedido']} - {$nombreCompleto}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Tabla de detalles del pedido con idpedido seleccionado dinámicamente -->
            <div class="filaDiv">
                <label for="detallesPedido">Detalles del Pedido</label>
                <table border="1" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>ID Menú</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Obtener el idpedido de la URL si está disponible
                        $idpedido = isset($_GET['idpedido']) ? $_GET['idpedido'] : 1;

                        // Consulta para obtener los detalles de los productos del pedido con el idpedido seleccionado
                        $resultDetalles = mysqli_query($link, "
                            SELECT idpedido, idmenu, cantidad, precioTotal
                            FROM detallepedido 
                            WHERE idpedido = '$idpedido'
                        ");
                        
                        while ($detalle = mysqli_fetch_assoc($resultDetalles)) {
                            echo "<tr>
                                    <td>{$detalle['idpedido']}</td>
                                    <td>{$detalle['idmenu']}</td>
                                    <td>{$detalle['cantidad']}</td>
                                    <td>{$detalle['precioTotal']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        
            <!-- Mostrar total de la columna Precio Total -->
            <div class="filaDiv">
                <label for="total">Total del Pedido</label>
                <input type="text" id="total" name="total" readonly>
            </div>
        

        </fieldset>
        <fieldset>
        <legend>Al Cobrar se eliminaran los el pedido y sus detalles</legend>
        <div class="filaDiv">
                <label for="idfactura">ID Factura</label>
                <input type="text" name="idfactura" id="idfactura" placeholder="" autocomplete="off" />
        </div>
        <div class="filaDiv">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" placeholder="Fecha" autocomplete="off" />
        </div>
        </fieldset>
        <div id="cssboton">
            <a class="a_demo_four" href="javascript:void(0);" 
            onClick="if (confirm('Al cobrar se eliminaran los pedidos asociados al cliente')) { Validar(document.form1, '_REGISTRAR_'); }">
                <img src="../../resource/imagenes/iconos/cobrar.png" style="margin: 0 5px -12px 0; border:none;">Cobrar
            </a>
            <a class="a_demo_four" href="javascript:void(0);" onclick="parent.$.modal().close()">
                <img src="../../resource/imagenes/iconos/close_32.png" style="margin: 0 5px -12px 0; border:none;">Cerrar
            </a>
        </div>
        <input name="OPERATOR" id="OPERATOR" type="hidden" value="" />
        
    </form>
</div>

<script type="text/javascript">
    // Llamar a la función para calcular el total después de cargar la página
    window.onload = calcularTotal;
</script>

</body>
</html>
