<?php
    session_start();
    require "../database.php";

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $legajo = $_POST["legajo"];
    $email = $_POST["email"];
    $pass = $_POST["contraseña"]; 
    $pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);

    $bd = new Database();

    $existeLegajo = $bd->exists_profesor_legajo($legajo);
    $existeDNI = $bd->exists_profesor_dni($dni);

    if($existeLegajo){
        $_SESSION['mensaje'] = "Legajo existente";
        header("Location: alta_profesor.php");
        exit(); 
    }elseif($existeDNI){
        $_SESSION['mensaje'] = "DNI existente";
        header("Location: alta_profesor.php"); 
        exit();
    }
    else{
        $insertar = $bd->alta_profesor($legajo,$nombre,$apellido,$email,$pass_cifrada,$dni);
        $insertarProfesorInstituto = $bd->insertar_profesor_instituto($legajo,$cue)
        $_SESSION['mensaje'] = "Registrado con éxito";
        header("Location: alta_profesor.php"); 
        exit();
    }
   
?>



