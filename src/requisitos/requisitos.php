
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/estilos.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                <a href="../ABM instituto/lista_institutos.php" class="opcion">Institutos</a>
            </div>
            <div class="menu-item">
                <a href="requisitos.php" class="opcion">Requisitos</a>
            </div>
            <a href="../asistencia.php" class="btn btn-inicio" >Inicio</a>
            <a href="../login.php" class="btn btn-cerrar-sesion" >Cerrar Sesión</a>
        </nav>
    </header>

    <?php

    require "../database.php";

    $db = new Database;

    $requisitos = $db->requisitos();

    echo "<div id='contenedorRequisitos'>";
    echo "<h1 class='textos'>Requisitos</h1>";
    echo "<table border='1' id='tablaRequisitos'>";
    echo "<tr>";
    echo "<th class='textosTabla'></th>";
    echo "<th class='textosTabla'>Parciales</th>";
    echo "<th class='textosTabla'>Trabajo Final</th>";
    echo "<th class='textosTabla'>Asistencia</th>";
    echo "<th class='textosTabla'>Acciones</th>";
    echo "</tr>";
    
            echo "<tr>
                    <td class='textosTabla'>Promocion</td>
                    <td class='textosTabla'>{$requisitos['promocion_nota']}</td>
                    <td class='textosTabla'>{$requisitos['promocion_tp']}</td>
                    <td class='textosTabla'>{$requisitos['promocion_asistencia']}</td>

                    <td class='textosTabla'>
                    <div class='iconos'>
                        <a href='modificacion_requisito.php?tipo=promocion' title='Editar'>  
                            <i class='fas fa-pencil-alt'></i> 
                        </a>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td class='textosTabla'>Regular</td>
                    <td class='textosTabla'>{$requisitos['regularizar_nota']}</td>
                    <td class='textosTabla'>{$requisitos['regularizar_tp']}</td>
                    <td class='textosTabla'>{$requisitos['regularizar_asistencia']}</td>
                    <td class='textosTabla'>
                    <div class='iconos'>
                        <a href='modificacion_requisito.php?tipo=regular' title='Editar'>  
                            <i class='fas fa-pencil-alt'></i> 
                        </a>
                    </div>
                    </td>
                </tr>";   //?id_materia={$id_materia}&cue={$cue}

    echo "</table>";




?>




</body>
</html>