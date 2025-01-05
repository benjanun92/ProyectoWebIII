<?php include_once("../../config/conexion.php"); ?>
<link rel="stylesheet" type="text/css" href="../../resource/css/style.css" />
<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td colspan="8"><h1>Registro Usuario</h1></td>
    </tr>
    <tr>
        <td colspan="8" align="right">
        <img id="eye-icon" class="eye-icon" src="../../resource/imagenes/iconos/eye.png" width="25" onclick="togglePassword()" alt="Mostrar/Ocultar contraseña" />
        </td>
        <td colspan="10" align="right">
            <a href="../usuario/usuarioNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" />Nuevo usuario</a>
        </td>
    </tr>               
    <tr>
        <td class="tabla1" width="32">N&ordm;</td>
        <td class="tabla1">CÓDIGO</td>
        <td class="tabla1">PATERNO</td>
        <td class="tabla1">MATERNO</td>
        <td class="tabla1">NOMBRE</td>
        <td class="tabla1">CARGO</td>
        <td class="tabla1">USUARIO</td>
        <td class="tabla1">PASSWORD</td> 
        <td class="tabla1" width="32">&nbsp;</td>
        <td class="tabla1" width="32">&nbsp;</td>
    </tr>
    <?php 
    $i=1;
    $query = "SELECT u.idusuario, u.paterno, u.materno, u.nombre, u.cargo, u.user, u.password FROM usuario u";
    $result = mysqli_query($link, $query);
    while($row = mysqli_fetch_array($result))
    { 
    ?>
    <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
        <td class="tabla2"><?php echo $i ?></td>
        <td class="tabla2"><?php echo $row["idusuario"] ?></td>
        <td class="tabla2"><?php echo $row["paterno"] ?></td>
        <td class="tabla2"><?php echo $row["materno"] ?></td>
        <td class="tabla2"><?php echo $row["nombre"] ?></td>
        <td class="tabla2"><?php echo $row["cargo"] ?></td>
        <td class="tabla2"><?php echo $row["user"] ?></td>
        <td class="tabla2"><?php echo $row["password"] ?></td> 
        <td class="tabla2">
            <a href="../usuario/usuarioModifica.php?USUARIO_ID=<?php echo $row['idusuario']; ?>" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" />Modifica</a>
        </td>
        <td class="tabla2">
            <a href="../usuario/usuarioElimina.php?USUARIO_ID=<?php echo $row['idusuario']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                <img src="../../resource/imagenes/iconos/page_delete.png" height="25" border="0" />Eliminar</a>
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
            document.location=URL;
    }
</script>