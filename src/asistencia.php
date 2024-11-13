

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/estilos.css">
</head>
<body>
    <header>
        <img src="imagenes/logo.png" alt="Logo" class="logo">

        <nav class="menu">
            
            <div class="menu-item">
                <a href="ABM alumno/lista_alumnos.php" class="opcion">Alumnos</a>
            </div>
            <div class="menu-item">
                <a href="ABM materia/lista_materias.php" class="opcion">Materias</a>
            </div>
            <div class="menu-item">
                <a href="ABM instituto/lista_institutos.php" class="opcion">Institutos</a>
            </div>
            <div class="menu-item">
                <a href="requisitos/requisitos.php" class="opcion">Requisitos</a>
            </div>
            <a href="asistencia.php" class="btn btn-inicio" >Inicio</a>
            <a href="login.php" class="btn btn-cerrar-sesion" >Cerrar Sesión</a>
        </nav>

    </header>


    <?php

    require "database.php";

    $db = new Database;

    $institutos = $db->traer_institutos();

    ?>


    <form action="tomar_asistencia.php" method="POST" id="formAsistencia">
        <div id="bienvenido">
            <h1 class="textos">Bienvenido Profesor</h1>
            <h1 class="textos">Para tomar asistencia, seleccione:</h1>
        </div>
        
        <div class="asistencia">
        <div>
            <p class="textos">Fecha</p>
            <input type="date" id="fecha" name="fecha" required>
        </div>

        <div>
            <p class="textos">Instituto</p>
            <select name="cue" id="instituto" required class="select">
                <option disabled selected>-Elige una opción-</option>
                <?php
            //PDO::FETCH_ASSOC: Es una constante que indica que el método fetch debe devolver 
            //la fila como un array asociativo, donde las claves del array serán los nombres de las columnas de la tabla.
            //fetch: Este método de PDO obtiene la siguiente fila de un conjunto de resultados que se ha generado a partir de una consulta SQL.
                while ($row = $institutos->fetch(PDO::FETCH_ASSOC)) { // Recorro los institutos obtenidos de la base de datos y crea una opción para cada uno
                    echo "<option value='" . $row['cue'] . "'>" . $row['nombre'] . "</option>"; 
                }
                ?>
            </select>
        </div>

        <div>
            <p class="textos">Materias</p>
                <select name="id_materia" id="materia" required class="select">
                    <option disabled selected>-Elige una opción-</option>
                </select>
        </div>
        <button type="submit" id="boton_enviar">Ingresar</button>
    </form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
$(document).ready(function() {
        $('#instituto').change(function() {    // Detecta el cambio en el campo de selección de instituto
            var cueInstituto = $(this).val(); // Obtengo el valor del instituto seleccionado

            // Realizo la llamada AJAX
            $.ajax({
                url: 'obtener_materias.php', // Archivo PHP que procesa la solicitud
                type: 'POST',  // Tipo de solicitud
                dataType: 'json', // Espera una respuesta en formato JSON
                data: { cue: cueInstituto }, // Enviamos el CUE del instituto
                success: function(data) { // Cuando la respuesta es exitosa
                    var materiasSelect = document.getElementById('materia');// Obtiene el elemento de materias
                    materiasSelect.innerHTML = '<option value="" disabled selected>Seleccionar Materia</option>';

                    // Agrega cada materia como una opción en el select
                    data.forEach(materia => {
                        var option = document.createElement('option'); // Crea un elemento option
                        option.value = materia.id_materia; // Asigna el valor de id_materia
                        option.textContent = materia.materia; // Asigna el nombre de la materia
                        materiasSelect.appendChild(option); // Agrega la opción al select
                    });
                }
            });
        });
    });

    // Añade un evento para validar el formulario al enviar
    document.getElementById('formAsistencia').addEventListener('submit', function(event) {
        var fecha = document.getElementById('fecha').value;
        var instituto = document.getElementById('instituto').value;
        var materia = document.getElementById('materia').value;

        if (!fecha || !instituto || !materia) {
            event.preventDefault(); // Evita que se envíe el formulario
            alert('Por favor, complete todos los campos antes de enviar.'); 
        }
    });
</script>
 

        
</body>
</html>
