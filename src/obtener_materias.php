<?php
require "database.php";


if (isset($_POST['cue'])) {
    $cue = $_POST['cue'];

    $db = new Database();
    $materias = $db->traerMaterias($cue);

    if ($materias->rowCount() > 0) {
        $resultado = []; 
    
        while ($row = $materias->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = [
                'id_materia' => $row['id_materia'],
                'materia' => $row['materia']
            ];
        }
    
        echo json_encode($resultado); //convierte en cadena de texto para mostrarlo
    } else {
        echo []; 
    }
} 

?>