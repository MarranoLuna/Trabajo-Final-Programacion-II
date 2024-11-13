<?php
session_start();
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);
?>


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
    

    
    <form id="institutoForm" action="procesar_alta_instituto.php" method="POST">
        <h1 class="textos">Datos Instituto</h1>
        <?php if ($mensaje): ?>
        <p class="dni"><?php echo $mensaje; ?></p>
        <?php endif; ?>
        <input type="number" name="cue" class="input" placeholder="C.U.E." required max="100000000">
        <input type="text" name="nombre" class="input" placeholder="Nombre" maxlength="30" required>
        <input type="text" name="direccion" class="input" placeholder="Direccion" maxlength="30" required>
        <button id="boton_enviar" type="submit">REGISTRAR</button>
    </form>

</body>
</html>


