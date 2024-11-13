<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style\estilos.css">
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


    <?php
    require "../database.php";

    $dni = $_GET['dni'];
    $id_materia = $_GET['id_materia'];
    $cue = $_GET['cue'];

    $db = new Database();

    $alumno = $db->traer_alumno($dni);

echo "<form method='POST' action='guardar_notas.php' id='formAgregarNota' onsubmit='return validarFormulario();'>";

if (isset($_SESSION['mensaje'])) {
    echo "<div class='dni'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']); 
}
echo "<h1 class='textos'>Seleccione exámen a evaluar</h1>";

echo "<select name='examen' id='examen'>";
echo "<option disabled selected>-Elige una opción-</option>";
echo "<option value='1'>Parcial 1</option>";
echo "<option value='2'>Parcial 2</option>";
echo "<option value='3'>Trabajo Final</option>";
echo "</select>";
echo "<br>";

echo "<input type='hidden' name='id_materia' value='{$id_materia}'>";
echo "<input type='hidden' name='dni' value='{$dni}'>";
echo "<input type='hidden' name='cue' value='{$cue}'>";

echo "<table border='1' class='tabla'>";
echo "<tr>";
echo "<th class='textosTabla'>Nombre</th>";
echo "<th class='textosTabla'>Apellido</th>";
echo "<th class='textosTabla'>Nota</th>";
echo "</tr>";


echo "<tr>
<td class='textosTabla'>{$alumno['nombre']}</td>
<td class='textosTabla'>{$alumno['apellido']}</td>
<td><input type='number' name='nota' value='' max='10' required></td>
</tr>";

echo "</table>";
echo "<button type='submit' id='boton_enviar'>Guardar Nota</button>";
echo "</form>";

?>

<script>
function validarFormulario() {
    const examenSelect = document.getElementById('examen');
    if (examenSelect.value === "-Elige una opción-") {
        alert("Por favor, selecciona un examen.");
        return false;
    }
    return true; 
}
</script>

       
</body>
</html>