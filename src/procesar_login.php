<?php 
    session_start();
    require "database.php";


    $bd = new Database();

    $email = $_POST["email"];
    $pass = $_POST["contraseña"];
    
    if (!$email || empty($pass)) {
        $_SESSION['error'] = "Debes completar todos los campos.";
        header("Location: login.php"); 
        exit();
    }

    $usuario = $bd->obtener_usuario_por_email($email);

    if($usuario && password_verify($pass, $usuario['contraseña'])){  
        header("Location: asistencia.php");
        exit();
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos."; //si existe, te lleva al login, y muestra mensaje
        header("Location: login.php"); 
        exit();
    }
?>