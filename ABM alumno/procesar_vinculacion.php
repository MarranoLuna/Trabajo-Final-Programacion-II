<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Materias</title>
</head>
<body>
    <?php
        session_start();
        require "../database.php";
            $db = new Database();

            $dni = $_POST['dni'];
            $materias_seleccionadas = $_POST['materias'] ?? [];
            $materias_vinculadas = array_column($db->obtener_vinculos($dni), 'id_materia');
            $cue = $_POST['cue'];
            $id_materia = $_POST['id_materias'];

            
            foreach ($materias_seleccionadas as $id_materia => $estado) {
                if ($estado == '1') {
                    if (!in_array($id_materia, $materias_vinculadas)) {
                        $db->vincular_alumno_materia($dni, $id_materia);
                    }
                } else {
                    if (in_array($id_materia, $materias_vinculadas)) {
                        $db->eliminar_vinculo($dni, $id_materia);
                    }
                }
            }

        header("Location: ver_lista_alumnos.php?cue=$cue");
        exit();
    ?>
</body>
</html>
