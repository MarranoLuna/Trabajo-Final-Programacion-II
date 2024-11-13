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


    <div class="form-container">

    <?php
session_start();
require "../database.php";


    $dni = $_GET['dni'];
    $db = new Database();
    $alumno = $db->buscar_alumno_por_dni($dni);

    if ($alumno) {
        $_SESSION['mensaje'] = $alumno['nombre'] . " " . $alumno['apellido'];
        $cue_instituto = $alumno['cue'];
        $materias = $db->obtener_materias_por_instituto($cue_instituto);
        $materias_vinculadas = array_column($db->obtener_vinculos($dni), 'id_materia');// array column obtiene los valores de una columna especifica. Llama a la función 'obtener_vinculos' para obtener las materias ya vinculadas al alumno y crea un arreglo con los 'id_materia' de las materias vinculadas al alumno

        if ($materias) {
            echo "<form method='POST' action='procesar_vinculacion.php' id='formVincular'>";
            echo "<div class='dni'>" . $_SESSION['mensaje'] . "</div>";
            unset($_SESSION['mensaje']); // Elimina el mensaje después de mostrarlo
            echo "<h2 class='textos'>Materias del Instituto:</h2>";
            echo "<input type='hidden' name='dni' value='{$dni}'>";
            echo "<input type='hidden' name='cue' value='{$cue_instituto}'>";

            foreach ($materias as $materia) {
                // Verifica si la materia está vinculada al alumno y marca el checkbox como 'checked' si es así
                $checked = in_array($materia['id_materia'], $materias_vinculadas) ? 'checked' : '';
                echo "<div>";
                // Crea un campo oculto para cada materia, para garantizar que si el checkbox no está marcado, se envíe el valor '0'
                echo "<input type='hidden' name='materias[{$materia['id_materia']}]' value='0'>";
                // Muestra un checkbox para cada materia, con el valor '1' si está seleccionado
                echo "<input type='checkbox' name='materias[{$materia['id_materia']}]' value='1' $checked>";
                echo "<label class='materias'>{$materia['materia']}</label>";
                echo "</div>";
            }
            
            echo "<button type='submit' id='boton_enviar'>Guardar</button>";
            echo "</form>";
        } else {
            echo "<p>No se encontraron materias para el instituto del alumno.</p>";
        }
    } else {
        $_SESSION['mensaje'] = "Alumno no encontrado";
    }
?>

</div>

    
           
</body>
</html>