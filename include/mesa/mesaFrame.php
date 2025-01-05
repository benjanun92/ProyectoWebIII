<?php include_once("../../config/conexion.php"); ?>
<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="8"><h1>Registro Mesa</h1></td>
    </tr>
    <tr>
        <td colspan="9" align="right">
            <a href="../mesa/mesaNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Nueva mesa
            </a>
        </td>
    </tr>               
    <tr>
        <td class="tabla1" width="32">Nº</td>
        <td class="tabla1">ID MESA</td>
        <td class="tabla1">NÚMERO</td>
        <td class="tabla1">CAPACIDAD</td>
        <td class="tabla1">ESTADO</td>
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php 
    $i = 1;
    $query = "SELECT m.idmesa, m.numero, m.capacidad, m.estado FROM mesa m";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result)) { 
    ?>
    <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
        <td class="tabla2"><?php echo $i ?></td>
        <td class="tabla2"><?php echo $row["idmesa"] ?></td>
        <td class="tabla2"><?php echo $row["numero"] ?></td>
        <td class="tabla2"><?php echo $row["capacidad"] ?> </td>
        <td class="tabla2"><?php echo $row["estado"] ?></td>
        <td class="tabla2">
            <a href="../mesa/mesaModifica.php?MESA_ID=<?php echo $row['idmesa']; ?>" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modifica
            </a>
        </td>
        <td class="tabla2">
            <a href="../mesa/mesaElimina.php?MESA_ID=<?php echo $row['idmesa']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta mesa?');">
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
