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

$db = new Database;
$institutos = $db->traer_institutos();

?>

<div class='contenedor'>"
<form action="ver_lista_materias.php" method="POST" id="formAsistencia"  onsubmit="return validarSeleccionInstituto()">
    <h1 class="textos">Seleccione instituto</h1>
    <div class="asistencia">
        <div>
            <p class="textos">Instituto</p>
            <select name="cue" id="instituto" required class="select">
                <option disabled selected>-Elige una opción-</option>
                <?php
                while ($row = $institutos->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['cue'] . "'>" . $row['nombre'] . "</option>";
                }
               
                ?>
                 <input id="nombreInstituto" type="hidden" name='nombre_instituto' value='' >
            </select>
        </div>
        <button type="submit" id="boton_enviar">Ingresar</button>
    </div>
</form>
</div>


<script>
function validarSeleccionInstituto() {
    const institutoSelect = document.getElementById("instituto");
    if (institutoSelect.value === "-Elige una opción-" || institutoSelect.value === "") {
        alert("Por favor, seleccione un instituto antes de continuar.");
        return false; 
    }
    return true; 
}
</script>

</body>
</html>