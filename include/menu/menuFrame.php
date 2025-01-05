<?php include_once("../../config/conexion.php");?>
<link rel="stylesheet" type="text/css" href="../../resource/css/styleMenu.css" />
<body id="body">
    <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td colspan="6"><h1>Registro Menú</h1></td>
        </tr>
        <tr>
            <td colspan="6" align="right">
                <a href="../menu/menuNuevo.php" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                    <img src="../../resource/imagenes/iconos/page_add.png" height="25" border="0" /> Nuevo menú
                </a>
            </td>
        </tr>               
        <tr class="container">
            <td class="tabla1" width="32">N&ordm;</td>
            <td class="tabla1">ID MENU</td>
            <td class="tabla1">NOMBRE</td>
            <td class="tabla1">DESCRIPCIÓN</td>
            <td class="tabla1">PRECIO</td>
            <td class="tabla1">CATEGORÍA</td>
            <td class="tabla1" width="32">&nbsp;</td>
            <td class="tabla1" width="32">&nbsp;</td>
        </tr>
        <?php 
        $i = 1;
        $query = "SELECT idmenu, nombre, descripcion, precio, categoria FROM menu";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result)) { 
        ?>
        <tr onmouseover="this.style.backgroundColor='#FFFF80'" onmouseout="this.style.backgroundColor='#FFFFFF'">
            <td class="tabla2"><?php echo $i ?></td>
            <td class="tabla2"><?php echo $row["idmenu"]?></td>
            <td class="tabla2"><?php echo $row["nombre"]?></td>
            <td class="tabla2"><?php echo $row["descripcion"]?></td>
            <td class="tabla2"><?php echo $row["precio"]?></td>
            <td class="tabla2"><?php echo $row["categoria"]?></td>
            <td class="tabla2">
                <a href="../menu/menuModifica.php?IDMENU=<?php echo $row['idmenu']; ?>" onclick="$(this).modal({width:450, height:500}).open(); return false;">
                    <img src="../../resource/imagenes/iconos/page_edit.png" height="25" border="0" /> Modificar
                </a>
            </td>
            <td class="tabla2">
                <a href="../menu/menuElimina.php?IDMENU=<?php echo $row['idmenu']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este menú?');">
                    <img src="../../resource/imagenes/iconos/page_delete.png" height="25" border="0" /> Eliminar
                </a>
            </td>
        </tr>
        <?php 
            $i++;
        } 
        ?>
    </table>
    <br>
    <center>
        <br>
        <h1>GALERIA DE FOTOS</h1>
        <table>
            <tr class="container">
                <td class="tabla1" ><img src="../../resource/imagenes/fotos/foto1.jpg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto2.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto3.jpeg" width="200" height="200"></td>
                <td class="tabla1" ><img src="../../resource/imagenes/fotos/foto4.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto5.jpeg" width="200" height="200"></td>
            </tr>
            <tr class="container">
                <td class="tabla1" ><img src="../../resource/imagenes/fotos/foto6.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto7.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto8.jpeg" width="200" height="200"></td>
                <td class="tabla1" ><img src="../../resource/imagenes/fotos/foto9.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto10.jpeg" width="200" height="200"></td>
            </tr>
            <tr class="container">
                <td class="tabla1" ><img src="../../resource/imagenes/fotos/foto11.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto12.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto13.jpeg" width="200" height="200"></td>
                <td class="tabla1" ><img src="../../resource/imagenes/fotos/foto14.jpeg" width="200" height="200"></td>
                <td class="tabla1"><img src="../../resource/imagenes/fotos/foto15.jpeg" width="200" height="200"></td>
            </tr>
        </table>
    </center>
    <script language="JavaScript" type="text/JavaScript">
        function Confirmar(URL, Msg) {
            if (confirm(Msg))
                document.location = URL;
        }
    </script>
</body>