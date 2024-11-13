
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
                <a href="lista_alumnos.php" class="opcion">Alumnos</a>
            </div>
            <div class="menu-item">
                <a href="../ABM materia/lista_materias.php" class="opcion">Materias</a>
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
    <br><br><br><br>
    
        
    <?php
session_start();
require "../database.php";
$db = new Database();

$cue = $_GET['cue'];  /

$materias = $db->traer_materias_por_instituto($cue); 
?>

<form action="procesar_alta_alumno.php" method="POST" id="formAltaAlumno">
    <h1 class="textos">Datos Alumno</h1>
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<div class='dni'>" . $_SESSION['mensaje'] . "</div>";
        unset($_SESSION['mensaje']);
    }
    ?>
    <input type="text" name="nombre" class="input" placeholder="Nombre" maxlength="30" required>
    <input type="text" name="apellido" class="input" placeholder="Apellido" maxlength="30" required>
    <input type="number" name="dni" class="input" placeholder="DNI" max="100000000" required >
    <input type="email" name="email" class="input" placeholder="Email" maxlength="30" required>
    <input type="date" name="fecha_nacimiento" class="input" placeholder="Fecha de nacimiento" required>


    <input type="hidden" name="cue" value="<?php echo $cue; ?>">

    <h2 class="textos">Materias del Instituto:</h2>
    <div id="materias">
        <?php if (!empty($materias)): ?>
            <?php foreach ($materias as $materia): ?>
                <div>
                    <input type="checkbox" name="materias[]" value="<?php echo $materia['id_materia']; ?>">
                    <label><?php echo $materia['materia']; ?></label>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay materias disponibles para este instituto.</p>
        <?php endif; ?>
    </div>

    <button id="boton_enviar" type="submit">REGISTRAR</button>
</form>

</body>
</html>


</html>

