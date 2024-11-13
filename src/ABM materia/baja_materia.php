<?php
        require "../database.php";
        $db = new Database;
        $id_materia = $_GET['id_materia'];
        $cue = $_GET['cue'];
        $eliminar = $db->eliminar_materia($id_materia);

        header("Location: ver_lista_materias.php?cue=$cue");

    ?>

<?php


