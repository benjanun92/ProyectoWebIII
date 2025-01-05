<?php include_once("../../config/conexion.php"); ?>

<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="8"><h1>Registro de Pedidos</h1></td>
    </tr>
    <tr>
        <td colspan="10" align="right">
            <a href="../pedido/pedidoNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Nuevo registro de pedido
            </a>
        </td>
    </tr>
    <tr>
        <td class="tabla1" width="32">N&ordm;</td>
        <td class="tabla1">CÓDIGO PEDIDO</td>
        <td class="tabla1">ID CLIENTE</td>
        <td class="tabla1">ID MESA</td>
        <td class="tabla1">ID CAMARERO</td>
        <td class="tabla1">ESTADO</td>
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php 
    $i = 1;
    $query = "SELECT * FROM pedido";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)) { 
    ?>
    <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
        <td class="tabla2"><?php echo $i ?></td>
        <td class="tabla2"><?php echo $row["idpedido"] ?></td>
        <td class="tabla2"><?php echo $row["idcliente"] ?></td>
        <td class="tabla2"><?php echo $row["idmesa"] ?></td>
        <td class="tabla2"><?php echo $row["idcamarero"] ?></td>
        <td class="tabla2"><?php echo $row["estado"] ?></td>
        <td class="tabla2">
            <a href="../pedido/pedidoModifica.php?PEDIDO_ID=<?php echo $row['idpedido']; ?>" 
               onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modificar
            </a>
        </td>
        <td class="tabla2">
            <a href="../pedido/pedidoElimina.php?PEDIDO_ID=<?php echo $row['idpedido']; ?>" 
               onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?');">
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
    function Confirmar(URL,Msg) {
        if (confirm(Msg))
            document.location=URL;
    }
</script>
