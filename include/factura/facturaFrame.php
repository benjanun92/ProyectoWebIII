<?php include_once("../../config/conexion.php"); ?>

<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="9"><h1>Registro de Facturas</h1></td>
    </tr>
    <tr>


        <td colspan="10" align="right">
            <a href="../factura/facturaCobro.php " onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Cobrar Factura
            </a>
        </td>
    </tr>
    <tr>
        <td class="tabla1" width="32">N&ordm;</td>
        <td class="tabla1">CÓDIGO FACTURA</td>
        <td class="tabla1">ID PEDIDO</td>
        <td class="tabla1">NOMBRE</td>
        <td class="tabla1">APELLIDO PATERNO</td>
        <td class="tabla1">APELLIDO MATERNO</td>
        <td class="tabla1">TOTAL</td>
        <td class="tabla1">FECHA</td>
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php 
    $i = 1;
    $query = "SELECT * FROM factura";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)) { 
    ?>
    <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
        <td class="tabla2"><?php echo $i ?></td>
        <td class="tabla2"><?php echo $row["idfactura"] ?></td>
        <td class="tabla2"><?php echo $row["idpedido"] ?></td>
        <td class="tabla2"><?php echo $row["nombre"] ?></td>
        <td class="tabla2"><?php echo $row["apellido_paterno"] ?></td>
        <td class="tabla2"><?php echo $row["apellido_materno"] ?></td>
        <td class="tabla2"><?php echo $row["total"] ?></td>
        <td class="tabla2"><?php echo $row["fecha"] ?></td>
        <td class="tabla2">
            <a href="../factura/facturaModifica.php?FACTURA_ID=<?php echo $row['idfactura']; ?>" 
               onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modificar
            </a>
        </td>
        <td class="tabla2">
            <a href="../factura/facturaElimina.php?IDFACTURA=<?php echo $row['idfactura']; ?>" 
               onclick="return confirm('¿Estás seguro de que deseas eliminar esta factura?');">
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
