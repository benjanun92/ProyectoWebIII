<?php include_once("../../config/conexion.php"); ?>
<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="8"><h1>Registro Cliente</h1></td>
    </tr>
    <tr>
        <td colspan="9" align="right">
            <a href="../cliente/clienteNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Nuevo cliente
            </a>
        </td>
    </tr>               
    <tr>
        <td class="tabla1" width="32">N&ordm;</td>
        <td class="tabla1">ID CLIENTE</td>
        <td class="tabla1">NOMBRE</td>
        <td class="tabla1">PATERNO</td>
        <td class="tabla1">MATERNO</td>
        <td class="tabla1">FECHA DE NACIMIENTO</td>
        <td class="tabla1">GÉNERO</td>
        <td class="tabla1">TELÉFONO</td>
        <td class="tabla1">DIRECCIÓN</td>
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php 
    $i=1;
    $query = "SELECT c.idcliente, c.nombre, c.apellido_paterno, c.apellido_materno, c.fecha_nacimiento, c.genero, c.telefono, c.direccion FROM cliente c";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result))
    { 
    ?>
    <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
        <td class="tabla2"><?php echo $i ?></td>
        <td class="tabla2"><?php echo $row["idcliente"] ?></td>
        <td class="tabla2"><?php echo $row["nombre"] ?></td>
        <td class="tabla2"><?php echo $row["apellido_paterno"] ?></td>
        <td class="tabla2"><?php echo $row["apellido_materno"] ?></td>
        <td class="tabla2"><?php echo $row["fecha_nacimiento"] ?></td>
        <td class="tabla2"><?php echo $row["genero"] ?></td>
        <td class="tabla2"><?php echo $row["telefono"] ?></td>
        <td class="tabla2"><?php echo $row["direccion"] ?></td>
        <td class="tabla2">
            <a href="../cliente/ClienteModifica.php?CLIENTE_ID=<?php echo $row['idcliente']; ?>" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modifica
            </a>
        </td>
        <td class="tabla2">
            <a href="../cliente/clienteElimina.php?CLIENTE_ID=<?php echo $row['idcliente']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
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
