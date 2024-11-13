<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style\estilos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
session_start();
require "database.php";

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $fecha = $_POST["fecha"];
    $id_materia = $_POST["id_materia"];
} else {
    $fecha = $_GET["fecha"];
    $id_materia = $_GET["id_materia"];
}
  

$alumnos = $db->existeAsistencia($fecha, $id_materia);
$cumpleanios = $db->verificarCumple($fecha, $id_materia);

if (!empty($cumpleanios)) {
    $mensaje = "Hoy es el cumpleaños de: ";

    foreach ($cumpleanios as $alumno) {
        $mensaje .= $alumno . " - ";  // Agregamos el nombre del alumno
    }

    echo "<script>
        Swal.fire('$mensaje');
    </script>";
}

?>

<form action="guardar_asistencias.php" method="POST" id="formTomarAsistencia">
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="dni"><?php echo $_SESSION['mensaje']; ?></div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>
    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
    <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>">

    <table border='1' class="tablaAsistencia">
        <tr>
            <th class='textosTabla'>Nombre</th>
            <th class='textosTabla'>Apellido</th>
            <th class='textosTabla'>Presente</th>
            <th class='textosTabla'>Ausente</th>
        </tr>
        <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td class='textosTabla'><?php echo $alumno['nombre']; ?></td>
                <td class='textosTabla' ><?php echo $alumno['apellido']; ?></td>
                <td>
                    <label>
                        <input type="radio" name="asistencia_<?php echo $alumno['dni']; ?>" value="presente" 
                               <?php echo (isset($alumno['estado']) && $alumno['estado'] == 'presente') ? 'checked' : ''; ?>> <!-- Este es un comentario en HTML -->
                    </label>
                </td>
                <td>
                        <label>
                        <input type="radio" name="asistencia_<?php echo $alumno['dni']; ?>" value="ausente" 
                               <?php echo (isset($alumno['estado']) && $alumno['estado'] == 'ausente') ? 'checked' : ''; ?>>
                    </label>
                </td> 
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <div style="margin-top: 10px;">
        <button type="button" onclick="marcarTodos('presente')" class="marcarTodo">Marcar todo Presente</button>
        <button type="button" onclick="marcarTodos('ausente')" class="marcarTodo">Marcar todo Ausente</button>
    </div>
    <button type="submit" id='boton_enviar'>Guardar Asistencia</button>
</form>

<script>

function marcarTodos(estado) {
    // Obtener todos los inputs de tipo radio
    const radios = document.querySelectorAll(`input[type="radio"][value="${estado}"]`);
    radios.forEach(radio => {
        radio.checked = true; // Marcar cada radio con el valor especificado
    });
}

// Función para validar que se haya seleccionado "presente" o "ausente" para cada alumno
function validarAsistencia() {
    // Selecciona todos los inputs de tipo "radio" cuyo atributo name empieza con 'asistencia_'
    const alumnos = document.querySelectorAll("[name^='asistencia_']");
    let todoCompleto = true;

    // Recorre todos los inputs de radio, dos a la vez (uno para 'presente' y otro para 'ausente')
    for (let i = 0; i < alumnos.length; i += 2) {
        // Si ninguno de los dos radio buttons (presente o ausente) está seleccionado para un alumno
        if (!alumnos[i].checked && !alumnos[i + 1].checked) {
            todoCompleto = false;// Cambia todoCompleto a false si algún alumno no tiene seleccionado 'presente' o 'ausente'
            break; // Sale del bucle ya que no hace falta seguir verificando los demás alumnos
        }
    }

    if (!todoCompleto) {
        alert("Por favor, selecciona 'presente' o 'ausente' para cada alumno.");
    }

    return todoCompleto;
}

// Agrega un evento "submit" al formulario para ejecutar la validación antes de enviarlo
document.querySelector("form").addEventListener("submit", function(event) {
    // Si la validación falla (devuelve false), previene el envío del formulario
    if (!validarAsistencia()) {
        event.preventDefault(); // Evita el envío del formulario si la validación falla
    }
});

</script>
       
</body>
</html>