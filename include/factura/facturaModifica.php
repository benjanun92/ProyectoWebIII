<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$id_factura = $_GET["FACTURA_ID"] ?? null; // Validar si FACTURA_ID está definido

if (!$id_factura) {
    die("Error: FACTURA_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    $idpedido = $_POST['idpedido'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $total = $_POST['total'];
    $fecha = $_POST['fecha'];

    $update = "UPDATE factura 
               SET idpedido = '$idpedido', 
                   nombre = '$nombre', 
                   apellido_paterno = '$apellido_paterno', 
                   apellido_materno = '$apellido_materno', 
                   total = '$total', 
                   fecha = '$fecha' 
               WHERE idfactura = '$id_factura'";

    $modifica = mysqli_query($link, $update);
    
    if (!$modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameFactura.php';
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
    <h1 class="titulo1">Modificar Factura</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM factura WHERE idfactura = '".mysqli_real_escape_string($link, $id_factura)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS FACTURA</legend>
            <div class="filaDiv">
                <label for="idpedido">ID Pedido</label>
                <input type="text" name="idpedido" id="idpedido" autocomplete="off" value="<?php echo $row['idpedido']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $row['nombre']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" id="apellido_paterno" autocomplete="off" value="<?php echo $row['apellido_paterno']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" name="apellido_materno" id="apellido_materno" autocomplete="off" value="<?php echo $row['apellido_materno']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="total">Total</label>
                <input type="number" name="total" id="total" step="0.01" value="<?php echo $row['total']; ?>"/>
            </div>
            <div class="filaDiv">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo $row['fecha']; ?>"/>
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
        <input name="factura_id" id="factura_id" type="hidden" value="<?php echo $id_factura; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
