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
                <a href="lista_materias.php" class="opcion">Materias</a>
            </div>
            <div class="menu-item">
                <a href="../AMB instituto/lista_institutos.php" class="opcion">Institutos</a>
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


    
        $id_materia = $_GET["id_materia"];
        $cue = $_GET["cue"];
        $db = new Database();
        $materia = $db->buscar_materia($id_materia);
        
        

        if ($materia) {
            $_SESSION['materia'] = $materia; 
        } else {
            $_SESSION['mensaje'] = "Materia no encontrado";
            unset($_SESSION['materia']);
        }

    ?>

    <?php if (isset($_SESSION['materia'])) {
    $materia = $_SESSION['materia'];
    unset($_SESSION['materia']);  // Limpiar después de mostrar
    ?>

    <form action="procesar_modificacion_materia.php" method="POST" id="formModificacionMateria">
        <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<div class='dni'>" . $_SESSION['mensaje'] . "</div>";
                unset($_SESSION['mensaje']);
            }
        ?>
    <h1 class="textos">Modificar Datos de la materia</h1>
    <input type="hidden" name="id_materia" value="<?php echo $materia['id_materia']; ?>">
    <input type="hidden" name="nombre_instituto" value="<?php echo $nombreInstituto; ?>">
    <input type="text" name="materia" class="input" maxlength="30" placeholder="Materia" value="<?php echo $materia['materia']; ?>">
    <input type="hidden" name="cue" value="<?php echo $cue; ?>">
    

    <button id="boton_enviar" type="submit">GUARDAR CAMBIOS</button>
</form>

    <?php
} 
?>

</body>
</html>