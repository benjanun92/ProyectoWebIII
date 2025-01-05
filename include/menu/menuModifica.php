<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$idmenu = $_GET["IDMENU"] ?? null; // Validar si IDMENU está definido

if (!$idmenu) {
    die("Error: IDMENU no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    $Update = "UPDATE menu 
               SET nombre = '$nombre',
                   descripcion = '$descripcion', 
                   precio = '$precio', 
                   categoria = '$categoria'
               WHERE idmenu = '$idmenu'";

    $Modifica = mysqli_query($link, $Update);
    
    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameMenu.php';
    </script>
    <?php
}
?>
<link rel="stylesheet" type="text/css" href="../../Resource/Css/stylePopup.css" />
<script type="text/javascript">
function Validar(f, op) {
    if (op == '_REGISTRAR_') {
        document.getElementById("OPERATOR").value = op;
        f.submit();
    }    
}
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Modificar Menú</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM menu WHERE idmenu = '".mysqli_real_escape_string($link, $idmenu)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS DEL MENÚ</legend>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $row['nombre']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" autocomplete="off" value="<?php echo $row['descripcion']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" autocomplete="off" value="<?php echo $row['precio']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="categoria">Categoría</label>
                <input type="text" name="categoria" id="categoria" autocomplete="off" value="<?php echo $row['categoria']; ?>"/>
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
        <input name="idmenu" id="idmenu" type="hidden" value="<?php echo $idmenu; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
