<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$pedido_id = $_GET["PEDIDO_ID"] ?? null; // Validar si PEDIDO_ID está definido

if (!$pedido_id) {
    die("Error: PEDIDO_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asignar los valores del formulario a las variables
    $idcliente = $_POST['idcliente'];
    $idmesa = $_POST['idmesa'];
    $idcamarero = $_POST['idcamarero'];
    $estado = $_POST['estado'];
   
    // Realizar la actualización del pedido
    $Update = "UPDATE pedido 
               SET idcliente = '$idcliente', 
                   idmesa = '$idmesa', 
                   idcamarero = '$idcamarero', 
                   estado = '$estado' 
               WHERE idpedido = '$pedido_id'";

    $Modifica = mysqli_query($link, $Update);
    
    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/framePedido.php';
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
    <h1 class="titulo1">Modificar Pedido</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM pedido WHERE idpedido = '".mysqli_real_escape_string($link, $pedido_id)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS DEL PEDIDO</legend>
            <div class="filaDiv">
                <label for="idcliente">Cliente</label>
                <select name="idcliente" id="idcliente">
                    <?php 
                    // Obtenemos los clientes para seleccionar uno en el formulario
                    $clientes = mysqli_query($link, "SELECT * FROM cliente");
                    while ($cliente = mysqli_fetch_assoc($clientes)) {
                        echo '<option value="' . $cliente['idcliente'] . '" ' . ($cliente['idcliente'] == $row['idcliente'] ? 'selected' : '') . '>' . $cliente['nombre'] . ' ' . $cliente['apellidoPaterno'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filaDiv">
                <label for="idmesa">Mesa</label>
                <select name="idmesa" id="idmesa">
                    <?php 
                    // Obtenemos las mesas disponibles
                    $mesas = mysqli_query($link, "SELECT * FROM mesa");
                    while ($mesa = mysqli_fetch_assoc($mesas)) {
                        echo "<option value='{$mesa['idmesa']}'>Mesa {$mesa['numero']} (cap: {$mesa['capacidad']} ) ( {$mesa['estado']})</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="filaDiv">
                <label for="idcamarero">Camarero</label>
                <select name="idcamarero" id="idcamarero">
                    <?php 
                    // Obtenemos los camareros disponibles
                    $camareros = mysqli_query($link, "SELECT * FROM camarero");
                    while ($camarero = mysqli_fetch_assoc($camareros)) {
                        echo '<option value="' . $camarero['idcamarero'] . '" ' . ($camarero['idcamarero'] == $row['idcamarero'] ? 'selected' : '') . '>' . $camarero['nombre'] . ' ' . $camarero['apellido'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filaDiv">
                <label for="estado">Estado</label>
                <select name="estado" id="estado">
                    <option value="Pendiente" <?php echo ($row['estado'] == 'Pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                    <option value="En preparación" <?php echo ($row['estado'] == 'En preparación' ? 'selected' : ''); ?>>En preparación</option>
                    <option value="Listo" <?php echo ($row['estado'] == 'Listo' ? 'selected' : ''); ?>>Listo</option>
                    <option value="Entregado" <?php echo ($row['estado'] == 'Entregado' ? 'selected' : ''); ?>>Entregado</option>
                </select>
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
        <input name="pedido_id" id="pedido_id" type="hidden" value="<?php echo $pedido_id; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
