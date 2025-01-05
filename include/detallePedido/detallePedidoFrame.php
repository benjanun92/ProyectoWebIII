<?php include_once("../../config/conexion.php"); ?>

<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="8"><h1>Detalles de Pedidos</h1></td>
    </tr>
    <form method="POST" action="">
        <tr>
            <td>
                <!-- Nuevo campo con el menú desplegable -->
                <label for="pedido_cliente">Buscar Pedido</label>
                <select name="pedido_cliente" id="pedido_cliente" onchange="this.form.submit()">
                    <option value="">Seleccione un pedido</option>
                    <?php
                    // Consulta SQL que obtiene los pedidos con el nombre del cliente
                    $query = "SELECT p.idpedido, CONCAT(c.nombre, ' ', c.apellido_paterno, ' ', c.apellido_materno) AS cliente_nombre 
                              FROM pedido p
                              JOIN cliente c ON p.idcliente = c.idcliente
                              ORDER BY p.idpedido ASC";
                    $result = mysqli_query($link, $query);

                    // Mostrar cada pedido con el nombre del cliente en el menú desplegable
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = (isset($_POST['pedido_cliente']) && $_POST['pedido_cliente'] == $row['idpedido']) ? 'selected' : '';
                        echo '<option value="' . $row['idpedido'] . '" ' . $selected . '>' . 'Pedido ' . $row['idpedido'] . ' - ' . $row['cliente_nombre'] . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td colspan="10" align="right">
                <a href="../detallePedido/detallePedidoNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                    <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Nuevo detalle de pedido
                </a>
            </td>
        </tr>
    </form>
    <tr>
        <td class="tabla1" width="32">CÓDIGO DE DETALLE</td>
        <td class="tabla1">ID DEL PEDIDO</td>
        <td class="tabla1">ID MENÚ</td>
        <td class="tabla1">CANTIDAD</td>
        <td class="tabla1">PRECIO TOTAL</td>
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php
    // Si se ha seleccionado un idpedido, se consulta ese pedido, de lo contrario, se muestran todos
    if (isset($_POST['pedido_cliente']) && !empty($_POST['pedido_cliente'])) {
        $idpedido = $_POST['pedido_cliente'];
        // Modificar la consulta para tomar el valor seleccionado
        $query = "SELECT * FROM detallePedido WHERE idpedido = $idpedido";
    } else {
        // Mostrar todos los detalles si no hay un idpedido seleccionado
        $query = "SELECT * FROM detallePedido";
    }

    $result = mysqli_query($link, $query);
    $i = 1;

    // Mostrar los resultados
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">

            <td class="tabla2"><?php echo $row["iddetalle"] ?></td>
            <td class="tabla2"><?php echo $row["idpedido"] ?></td>
            <td class="tabla2"><?php echo $row["idmenu"] ?></td>
            <td class="tabla2"><?php echo $row["cantidad"] ?></td>
            <td class="tabla2"><?php echo $row["precioTotal"] ?></td>
            <td class="tabla2">
                <a href="../detallePedido/detallePedidoModifica.php?DETALLE_ID=<?php echo $row['iddetalle']; ?>" 
                   onclick="$(this).modal({width:450, height:500}).open(); return false;">
                    <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modificar
                </a>
            </td>
            <td class="tabla2">
                <a href="../detallePedido/detallePedidoElimina.php?DETALLE_ID=<?php echo $row['iddetalle']; ?>" 
                   onclick="return confirm('¿Estás seguro de que deseas eliminar este detalle de pedido?');">
                    <img src="../../resource/imagenes/iconos/page_delete.png" height="25" border="0" />Eliminar
                </a>
            </td>
        </tr>
    <?php
            $i++;
        }
    ?>
</table>

<script language="JavaScript" type="text/JavaScript">
    function Confirmar(URL, Msg) {
        if (confirm(Msg))
            document.location = URL;
    }
</script>
