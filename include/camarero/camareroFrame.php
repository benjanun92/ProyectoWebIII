<?php include_once("../../config/conexion.php"); ?>
<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="8"><h1>Registro Camarero</h1></td>
    </tr>
    <tr>
        <td colspan="9" align="right">
            <a href="../camarero/camareroNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Nuevo camarero
            </a>
        </td>
    </tr>               
    <tr>
        <td class="tabla1" width="32">N&ordm;</td>
        <td class="tabla1">ID CAMARERO</td>
        <td class="tabla1">PATERNO</td>
        <td class="tabla1">MATERNO</td>
        <td class="tabla1">NOMBRE</td>
        <td class="tabla1">TELÉFONO</td>
        <td class="tabla1">SALARIO</td>
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php 
    $i=1;
    $query = "SELECT c.idcamarero, c.apellido_paterno, c.apellido_materno, c.nombre, c.telefono, c.salario FROM camarero c";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)) { 
    ?>
    <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
        <td class="tabla2"><?php echo $i ?></td>
        <td class="tabla2"><?php echo $row["idcamarero"] ?></td>
        <td class="tabla2"><?php echo $row["apellido_paterno"] ?></td>
        <td class="tabla2"><?php echo $row["apellido_materno"] ?> </td>
        <td class="tabla2"><?php echo $row["nombre"] ?></td>
        <td class="tabla2"><?php echo $row["telefono"] ?></td>
        <td class="tabla2"><?php echo $row["salario"] ?></td>
        <td class="tabla2">
            <a href="../camarero/camareroModifica.php?CAMARERO_ID=<?php echo $row['idcamarero']; ?>" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modifica
            </a>
        </td>
        <td class="tabla2">
            <a href="../camarero/camareroElimina.php?ID_CAMARERO=<?php echo $row['idcamarero']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este camarero?');">
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
