
    <?php
        require "../database.php";
        $db = new Database;
        $dni = $_GET['dni'];
        $cue = $_GET["cue"];
        $eliminar = $db->eliminar_alumno($dni);

        header("Location: ver_lista_alumnos.php?cue=$cue");

    ?>
