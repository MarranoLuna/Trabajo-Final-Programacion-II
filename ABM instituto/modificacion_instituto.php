<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/estilos.css">
</head>
<body>

    <header>
        <img src="../imagenes/logo.png" alt="Logo" class="logo">

        <nav class="menu">
            <div class="menu-item">
                <a href="../ABM alumno/lista_alumnos.php" class="opcion">Alumnos</a>
            </div>
            <div class="menu-item">
                <a href="../ABM materia/lista_materias.php" class="opcion">Materias</a>
            </div>
            <div class="menu-item">
                <a href="lista_institutos.php" class="opcion">Institutos</a>
            </div>
            <div class="menu-item">
                <a href="../requisitos/requisitos.php" class="opcion">Requisitos</a>
            </div>
            <a href="../asistencia.php" class="btn btn-inicio" >Inicio</a>
            <a href="../login.php" class="btn btn-cerrar-sesion" >Cerrar Sesión</a>
        </nav>
    </header>
    


    <?php
session_start();
require "../database.php";

$cue = $_GET['cue'];
$db = new Database();
$instituto = $db->buscar_instituto($cue);

if ($instituto) {
    $_SESSION['instituto'] = $instituto;
} else {
    $_SESSION['mensaje'] = "Instituto no encontrado";
    unset($_SESSION['instituto']);
}
?>

<?php if (isset($_SESSION['instituto'])): 
    $instituto = $_SESSION['instituto'];
    unset($_SESSION['instituto']); 
?>
<form action="procesar_modificacion_instituto.php" method="POST" id="formModificacionInstituto">
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="dni"><?php echo $_SESSION['mensaje']; ?></div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <h1 class="textos">Modificar Datos del Instituto</h1>
    <input type="hidden" name="cue" max="10000000" value="<?php echo $instituto['cue']; ?>">
    <input type="text" name="nombre" class="input" maxlength="30" placeholder="Nombre" value="<?php echo $instituto['nombre']; ?>" required>
    <input type="text" name="direccion" class="input" maxlength="30" placeholder="Direccion" value="<?php echo $instituto['direccion']; ?>" required>
    <button id="boton_enviar" type="submit">GUARDAR CAMBIOS</button>
</form>
<?php endif; ?>


</body>
</html>