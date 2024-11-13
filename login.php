<?php 
session_start();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style\estilos.css">
</head>
<body>
    <header>
        <img src="imagenes/logo.png" alt="Logo" class="logo">
    </header>
    <div class="contenedorLogin">
    <form action="procesar_login.php" method="POST" id="formLogin">

    <?php if (isset($_SESSION['error'])): ?> 
        <div class="dni">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>
    
        <h1 class="textos">Bienvenidos</h1>
        <input type="email" name="email" class="input" placeholder="Email">
        <input type="password" name="contraseña" class="input" placeholder="Contraseña">
        <button type="submit" id="boton_enviar">INGRESAR</button>
    </form>
        <div class="contenedorBoton">
        <button onclick="location.href='ABMprofesor/alta_profesor.php'" id="boton_enviar">REGISTRARSE</button>  
    </div>
    </div>

              
</body>
</html>