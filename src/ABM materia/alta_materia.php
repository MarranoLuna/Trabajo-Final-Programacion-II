<?php
require '../database.php'; 
session_start();
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);

$bd = new Database();
$institutos = $bd->traer_institutos(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Materia</title>
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
                <a href="lista_materias.php" class="opcion">Materias</a>
            </div>
            <div class="menu-item">
                <a href="../ABM instituto/lista_institutos.php" class="opcion">Institutos</a>
            </div>
            <div class="menu-item">
                <a href="../requisitos/requisitos.php" class="opcion">Requisitos</a>
            </div>
            <a href="../asistencia.php" class="btn btn-inicio" >Inicio</a>
            <a href="../login.php" class="btn btn-cerrar-sesion" >Cerrar Sesión</a>
        </nav>
    </header>




    <form action="procesar_alta_materia.php" method="POST" id="formAltaMateria">
        <h1 class="textos">Datos Materia</h1>

        <?php if ($mensaje): ?>
        <p class="dni"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <input type="text" name="materia" class="input" placeholder="Materia" maxlength="30" required>
        <select id="institutos" name="cue" required>
            <option value="" disabled selected>Seleccionar Instituto</option>
            <?php 
            while ($row = $institutos->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['cue']; ?>">
                    <?php echo $row['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit" id="boton_enviar">Registrar</button>
    </form>
</body>
</html>
