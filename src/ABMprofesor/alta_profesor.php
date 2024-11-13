<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/estilos.css">
</head>
<body>
    <header>
        <img src="../imagenes/logo.png" alt="Logo" class="logo">
        <nav class="menu2">
            <a href="../login.php" class="btn btn-inicio" >Iniciar Sesión</a>
        </nav>
    </header>
<body>
    <form action="procesar_alta_profesor.php" method="POST" id="formProfesor" onsubmit="return validarFormulario()">
        <?php if (isset($_SESSION['mensaje'])): ?> 
        <div class="dni">
            <?php
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);  //borra el mensaje
            ?>
        </div>
        <?php endif; ?>
        <h1 class="textos">Datos Profesor</h1>
        <input type="text" name="nombre" class="input" placeholder="Nombre" maxlength="30" required>
        <input type="text" name="apellido" class="input" placeholder="Apellido"  maxlength="30" required>
        <input type="number" name="dni" class="input" placeholder="DNI" min="1000000" max="99999999">
        <input type="number" name="legajo" class="input" placeholder="Numero de legajo" max="10000000">
        <input type="email" name="email" class="input" placeholder="Email" maxlength="30">
        <input type="password" name="contraseña" class="input" placeholder="Contraseña" maxlength="30">
        <button id="boton_enviar" type="submit">REGISTRARSE</button>
        <p id="errorMensaje" style="color:red;"></p>
    </form>


    <script>
        function validarFormulario() {
            const nombre = document.forms["formProfesor"]["nombre"].value;
            const apellido = document.forms["formProfesor"]["apellido"].value;
            const dni = document.forms["formProfesor"]["dni"].value;
            const legajo = document.forms["formProfesor"]["legajo"].value;
            const email = document.forms["formProfesor"]["email"].value;
            const contraseña = document.forms["formProfesor"]["contraseña"].value;
            
            if (nombre === "" || apellido === "" || dni === "" || legajo === "" || email === "" || contraseña === "") {
                alert("Por favor, complete todos los campos."); 
                return false; // Evita el envío del formulario
            }
            
            return true; // Permite el envío si todos los campos están completos
        }
    </script>
</body>
</html>

