<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    $idmenu = $_POST['idmenu'] ?? '';
    $nombre = $_POST['txtnom'] ?? '';
    $descripcion = $_POST['txtdesc'] ?? '';
    $precio = $_POST['txtprecio'] ?? '';
    $categoria = $_POST['txtcategoria'] ?? '';

    // Verificar si el idmenu ya existe
    $checkIdQuery = "SELECT * FROM menu WHERE idmenu = '$idmenu'";
    $checkResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        ?>
        <script type="text/javascript">
            alert("El ID del menú ya existe. Por favor, ingresa un ID único.");
            window.history.back();
        </script>
        <?php
    } else {
        // Inserción del nuevo menú
        $RegMenu = "INSERT INTO menu(idmenu, nombre, descripcion, precio, categoria) 
                    VALUES ('$idmenu', '$nombre', '$descripcion', '$precio', '$categoria')";
        $Res = mysqli_query($link, $RegMenu);

        if ($Res) {
            ?>
            <script type="text/javascript">
                parent.self.location.href='../xframe/frameMenu.php';
                parent.$.modal().close();
            </script>
            <?php
        } else {
            echo 'Error al registrar el menú: ' . mysqli_error($link);
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
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Registro de Menú</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS DEL MENÚ</legend>
            <div class="filaDiv">
                <label for="idmenu">ID Menú</label>
                <input type="text" name="idmenu" id="idmenu" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="txtnom" id="txtnom" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="descripcion">Descripción</label>
                <textarea name="txtdesc" id="txtdesc" autocomplete="off"></textarea>
            </div>
            <div class="filaDiv">
                <label for="precio">Precio</label>
                <input type="number" name="txtprecio" id="txtprecio" step="0.01" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="categoria">Categoría</label>
                <input type="text" name="txtcategoria" id="txtcategoria" autocomplete="off" />
            </div>
        </fieldset>
        <div id="cssboton">
            <a class="a_demo_four" href="javascript:void(0);" onClick="Validar(document.form1,'_REGISTRAR_')">
                <img src="../../resource/imagenes/iconos/save_32.png" style="margin: 0 5px -12px 0; border:none;">Guardar
            </a>
            <a class="a_demo_four" href="javascript:void(0);" onclick="parent.$.modal().close()">
                <img src="../../resource/imagenes/iconos/close_32.png" style="margin: 0 5px -12px 0; border:none;">Cerrar
            </a>
        </div>
        <input name="OPERATOR" id="OPERATOR" type="hidden" value="" />
    </form>
</div>
</body>
</html>
