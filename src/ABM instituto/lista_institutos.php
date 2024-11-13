<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/estilos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    require "../database.php";
        $bd=new Database;
        $institutos = $bd->traer_institutos();

        echo "<div class='contenedor'>";
        echo "<h1 class='textos'>Listado de Institutos</h1>";
        echo "<table border='1' id='tablaInfoInstitutos'>";
        echo "<tr>";
        echo "<th class='textosTabla'>Nombre</th>";
        echo "<th class='textosTabla'>Direccion</th>";
        echo "<th class='textosTabla'>Cue</th>";
        echo "<th class='textosTabla'>Acciones</th>";
        echo "</tr>";



        foreach ($institutos as $instituto) {
            $cue = $instituto['cue'];
            echo "<tr>
                    <td class='textosTabla'>{$instituto['nombre']}</td>
                    <td class='textosTabla'>{$instituto['direccion']}</td>
                    <td class='textosTabla'>{$instituto['cue']}</td>

                    <td class='textosTabla'>
                    <div class='iconos'>
                        <a href='modificacion_instituto.php?cue={$cue}' title='Editar'
                        onclick='return confirmarEliminacion();'>
                            <i class='fas fa-pencil-alt'></i> 
                        </a>
                    </div>
                </td>
                </tr>";
        }
    echo "</table>";
    ?>

<div class="contenedorBoton">
<button id="boton_enviar" onclick="location.href='alta_instituto.php'">Nuevo</button>
</div>
</div>


    
</body>
</html>