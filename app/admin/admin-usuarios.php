<?php
    include 'header-admin.php';
    
    session_start();
    $usuario = $_SESSION['usuario'];
    $pase = $_SESSION['pase'];
    if(!isset($usuario) or !isset($pase)){
        header('Location: login');
    }
?>
    <div class="contenedor contenedor-app clearfix">
        <h1>Administrador de usuarios</h1>
        
        <h2>Agregar usuario</h2>
        <hr>
    </div>

    <div class="contenedor contenedor-app bg-gris">
        <div class="contenedor-campos">
            <form id="frmAdminUsers"  method="post" onsubmit="javascript: return false;">
                <div class="campo w-100">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" name="txtNombre" id="txtNombre" placeholder="Abelardo Aqui Arroyo">
                </div>
                <div class="campo w-100">
                    <label for="txtTelefono">Teléfono:</label>
                    <input type="tel" name="txtTelefono" id="txtTelefono" placeholder="10 digitos">
                </div>
                <div class="campo">
                    <label for="txtCorreo">Correo:</label>
                    <input type="text" name="txtCorreo" id="txtCorreo" placeholder="correo">
                </div>
                <div class="campo">
                    <label for="txtCorreoC">Confirmar correo:</label>
                    <input type="text" name="txtCorreoC" id="txtCorreoC" placeholder="correo">
                </div>
                <div class="campo">
                    <label for="txtPase">Contraseña:</label>
                    <input type="password" name="txtPase" id="txtPase" placeholder="correo">
                </div>
                <div class="campo">
                    <label for="txtPaseC">Confirmar contraseña:</label>
                    <input type="password" name="txtPaseC" id="txtPaseC" placeholder="correo">
                </div>
                <div class="campo w-100">
                    <input class="btn primario" id="btnRegistro" type="submit" value="Crear cuenta">
                </div>
            </form>
        </div>
    </div>
    <h2>Cuentas registradas</h2>
    <hr>
    <div class="contenedor tablas">
        <table class="tabla-actividades">
            <thead>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Cambiar contraseña</th>
            </thead>
            <tbody>
                <?php
                    try {
                        require_once('../../php/config.php');
                        $sql = "SELECT num_usuario,correo, nombre_user FROM usuarios ORDER BY nombre_user asc";
                        $resultado = $conn->query($sql);
                    } catch (Exception $th) {
                        echo $th->getMessage();
                    }
                ?>

                <?php
                    while($cuenta = $resultado->fetch_assoc()){
                        require_once('../../php/SED.php');?>
                <tr>
                    <td><?php echo $cuenta['nombre_user']?></td>
                    <td><?php echo $cuenta['correo']?></td>
                    <td>
                        <a class="btn color-amarillo" href="actualizar-pase?<?php echo SED::encryption($cuenta['num_usuario'])?>"><i class="fas fa-edit"></i> Cambiar</a>
                    </td>
                </tr>
                <?php    }
                ?>
                
            </tbody>
        </table>
    </div>

<?php
    include 'footer-admin.php';
?>


