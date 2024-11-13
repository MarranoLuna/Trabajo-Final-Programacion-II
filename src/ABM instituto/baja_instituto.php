<?php
        require "../database.php";
        $db = new Database;
        $cue = $_GET['cue'];
        $eliminar = $db->eliminar_instituto($cue);

        header("Location: lista_institutos.php?cue=$cue");

    ?>

    
<?php
