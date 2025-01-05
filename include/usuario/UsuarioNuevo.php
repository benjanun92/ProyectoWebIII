<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php
include("../../Config/conexion.php");

if (isset($_POST['OPERATOR']) && $_POST['OPERATOR'] == '_REGISTRAR_') {
    // Asigna las variables para la consulta
    $idusuario = $_POST['txtidusuario'] ?? '';
    $txtnom = $_POST['txtnom'] ?? '';
    $txtpat = $_POST['txtpat'] ?? '';
    $txtmat = $_POST['txtmat'] ?? '';
    $txtcargo = $_POST['txtcargo'] ?? '';
    $txtuser = $_POST['txtuser'] ?? '';
    $txtpassword = $_POST['txtpassword'] ?? '';

    // Verificar si el idusuario ya existe
    $checkIdQuery = "SELECT * FROM usuario WHERE idusuario = '$idusuario'";
    $checkIdResult = mysqli_query($link, $checkIdQuery);
    
    if (mysqli_num_rows($checkIdResult) > 0) {
        // Si el idusuario ya existe, muestra un mensaje emergente
        ?>
        <script type="text/javascript">
            alert("El ID de Usuario ya existe. Por favor, ingresa un ID único.");
            window.history.back(); // Regresa a la página anterior
        </script>
        <?php
    } else {
        // Verificar si el nombre de usuario ya existe
        $checkUserQuery = "SELECT * FROM usuario WHERE user = '$txtuser'";
        $checkUserResult = mysqli_query($link, $checkUserQuery);

        if (mysqli_num_rows($checkUserResult) > 0) {
            // Si el user ya existe, muestra un mensaje emergente
            ?>
            <script type="text/javascript">
                alert("El nombre de usuario ya está en uso. Por favor, elige otro.");
                window.history.back(); // Regresa a la página anterior
            </script>
            <?php
        } else {
            // Si el idusuario y el user son únicos, realiza la inserción
            $RegUsuario = "INSERT INTO usuario(idusuario, paterno, materno, nombre, cargo, user, password) 
                           VALUES ('$idusuario', '$txtpat', '$txtmat', '$txtnom', '$txtcargo', '$txtuser', '$txtpassword')";
            $Res = mysqli_query($link, $RegUsuario);

            if ($Res) {
                // Si la inserción es exitosa, redirige
                ?>
                <script type="text/javascript">
                    parent.self.location.href='../xframe/frameUsuario.php';
                    parent.$.modal().close();
                </script>
                <?php
            } else {
                // Si hay algún error con la consulta
                echo 'Error al registrar usuario: ' . mysqli_error($link);
            }
        }
    }
}
?>
<link rel="stylesheet" type="text/css" href="../../Resource/Css/stylePopup.css" />
<script type="text/javascript">
<!--
function Validar(f, op){
    if (op == '_REGISTRAR_') {
        document.getElementById("OPERATOR").value = op;
        f.submit();
    }
}
//-->
</script>
</head>
<body>
<div id="contenedorPopup">
    <h1 class="titulo1">Registro de Usuario</h1>
    <form name="form1" method="POST" action="">
        <fieldset>
            <legend>DATOS DE USUARIO</legend>
            <div class="filaDiv">
                <label for="idusuario">ID Usuario</label>
                <input type="text" name="txtidusuario" id="txtidusuario" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="paterno">Paterno</label>
                <input type="text" name="txtpat" id="txtpat" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="materno">Materno</label>
                <input type="text" name="txtmat" id="txtmat" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="nombre">Nombre</label>
                <input type="text" name="txtnom" id="txtnom" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="cargo">Cargo</label>
                <input type="text" name="txtcargo" id="txtcargo" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="user">Usuario</label>
                <input type="text" name="txtuser" id="txtuser" placeholder="" autocomplete="off" />
            </div>
            <div class="filaDiv">
                <label for="password">Password</label>
                <input type="text" name="txtpassword" id="txtpassword" placeholder="" autocomplete="off" />
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
