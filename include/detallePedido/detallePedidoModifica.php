<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

$detalle_id = $_GET["DETALLE_ID"] ?? null; // Validar si DETALLE_ID está definido

if (!$detalle_id) {
    die("Error: DETALLE_ID no está definido.");
}

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asignar los valores del formulario a las variables
    $idpedido = $_POST['idpedido'];
    $idmenu = $_POST['idmenu'];
    $cantidad = $_POST['cantidad'];
    $precioTotal = $_POST['precioTotal'];
   
    // Realizar la actualización del detalle de pedido
    $Update = "UPDATE detallepedido 
               SET idpedido = '$idpedido', 
                   idmenu = '$idmenu', 
                   cantidad = '$cantidad', 
                   precioTotal = '$precioTotal' 
               WHERE iddetalle = '$detalle_id'";

    $Modifica = mysqli_query($link, $Update);
    
    if (!$Modifica) {
        die("Error al actualizar: " . mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        parent.self.location.href='../xframe/frameDetallePedido.php';
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
    <h1 class="titulo1">Modificar Detalle de Pedido</h1>
    <form name="form1" method="POST" action="">
    <?php 
    $repord = mysqli_query($link, "SELECT * FROM detallepedido WHERE iddetalle = '".mysqli_real_escape_string($link, $detalle_id)."'");
    if (!$repord) {
        die("Error en la consulta: " . mysqli_error($link));
    }
    if ($row = mysqli_fetch_assoc($repord)) { ?>
        <fieldset>
            <legend>DATOS DEL DETALLE DE PEDIDO</legend>
            <div class="filaDiv">
                <label for="idpedido">Pedido</label>
                <select name="idpedido" id="idpedido">
                    <?php 
                    // Obtenemos los pedidos disponibles y mostramos el cliente asociado
                    $pedidos = mysqli_query($link, "SELECT p.idpedido, p.idcliente, c.nombre, c.apellido_paterno, c.apellido_materno 
                                                    FROM pedido p 
                                                    JOIN cliente c ON p.idcliente = c.idcliente");
                    while ($pedido = mysqli_fetch_assoc($pedidos)) {
                        // Nombre completo del cliente
                        $clienteNombre = $pedido['nombre'] . " " . $pedido['apellido_paterno'] . " " . $pedido['apellido_materno'];
                        echo '<option value="' . $pedido['idpedido'] . '" ' . ($pedido['idpedido'] == $row['idpedido'] ? 'selected' : '') . '>' . $pedido['idpedido'] . ' - ' . $clienteNombre . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filaDiv">
                <label for="idmenu">Menú</label>
                <select name="idmenu" id="idmenu">
                    <?php 
                    // Obtenemos los menús disponibles
                    $menus = mysqli_query($link, "SELECT * FROM menu");
                    while ($menu = mysqli_fetch_assoc($menus)) {
                        echo '<option value="' . $menu['idmenu'] . '" ' . ($menu['idmenu'] == $row['idmenu'] ? 'selected' : '') . '>' . $menu['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="filaDiv">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" value="<?php echo $row['cantidad']; ?>" step="1"/>
            </div>
            <div class="filaDiv">
                <label for="precioTotal">Precio Total</label>
                <input type="number" name="precioTotal" id="precioTotal" value="<?php echo $row['precioTotal']; ?>" step="0.01"/>
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
        <input name="detalle_id" id="detalle_id" type="hidden" value="<?php echo $detalle_id; ?>" />
    <?php } ?>
    </form>
</div>
</body>
</html>
