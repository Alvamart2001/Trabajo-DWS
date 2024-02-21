<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 100px; /* Margen bot de 30px */
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
        }

        button {
            background: linear-gradient(to right, #e3a618, #954ca1);
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        /* Estilos adicionales para el último input en cada formulario */
        form input {
            margin-bottom: 30px; /* Margen bot de 10px */
        }

        form p{
            text-align: center;
            margin-top: 60px;
            margin-bottom: 100px;
        }

        .containerRegistro{
            display: none;            
        }

        body{
            background-image: url("foto.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        em{
            color: blue;
            font-style: normal;
        }

        #error-message{
            display:inline-block;
            color: red;
            text-align: left;
        }

        #error-message2{
            display:inline-block;
            color: red;
            text-align: left;
        }

       

    </style>
</head>
<body>

    <?php

session_start();


        if (isset($_SESSION["pepito"])) {
            header("Location: principal.php");
            exit;
        }
    ?>

    
    <div class="contaierInicio" id="contaierInicio">

    <form method="POST" action="inicio.php">
        <h2>Login</h2>
        <input type="text" id="username" name="username" placeholder="Username" required>

        <input type="password" id="contrasegna" name="contrasegna" placeholder="Password" required>

        <span  id="error-message"></span>

        <button type="submit" value="Login" name="Login">Login</button>

        <p id="link">Don´t have account? <em>Sign up</em></p>
    </form>


    </div>

    <div class="containerRegistro" id="containerRegistro">

        <form method="POST" action="inicio.php">
            <h2>Create</h2>
            <input type="text" id="username1" name="username1" placeholder="Username" required>
    
            <input type="password" id="contrasegna1" name="contrasegna1" placeholder="Password" required>

            <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password" required>

            <span  id="error-message2"></span>
    
            <button type="submit" value="Create" name="Create">Create</button>

        </form>

    </div>


    <script>

        let contaierInicio=document.getElementById("contaierInicio");
        let containerRegistro=document.getElementById("containerRegistro");
        let button=document.getElementById("link");

        link.addEventListener("click",(e)=>{
            contaierInicio.style.display="none"
            containerRegistro.style.display="inline-block"
        })


    </script>


<?php
        include("conexion.php");

        if (isset($_POST["Login"])) {
            $usuario = $_POST["username"];
            $contrasegna = $_POST["contrasegna"];
        
            $stmt = $conexion->prepare("SELECT userpassw, userrolw FROM usuario_web WHERE userw = ?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
        
                    $storedPassword = trim($row['userpassw']);
                    $providedPassword = trim($contrasegna);
        
                    if (password_verify($providedPassword, $storedPassword))  {
                        $_SESSION['pepito'] = $usuario;
                        $_SESSION['userrolw'] = $row['userrolw'];
                        $session_id = md5(uniqid(rand(), true));
                        setcookie('session_id', $session_id, time() + (86400 * 30), "/");
                        header("Location: principal.php");
                        exit();
                    } else {
                        echo '<script>document.getElementById("error-message").innerHTML = "Incorrect password";</script>';
                    }
                } else {
                    echo '<script>document.getElementById("error-message").innerHTML = "User not found";</script>';
                }
            } else {
                echo "Error en la ejecución de la consulta: " . $stmt->error;
            }
        
            $stmt->close();
        }

        if (isset($_POST["Create"])) {
    $usuario = $_POST["username1"];
    $contrasegna = $_POST["contrasegna1"];
    $contrasegna2 = $_POST["repeatPassword"];

    // Verificar que las contraseñas coinciden y cumplen con los requisitos
    if ($contrasegna == $contrasegna2 && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $contrasegna)) {
        // Hash de la contraseña
        $hashedPassword = password_hash($contrasegna, PASSWORD_DEFAULT);

        // Preparar la consulta
        $stmt = $conexion->prepare("INSERT INTO usuario_web (userw, userpassw, userrolw) VALUES (?, ?, '01')");
        
        // Vincular los parámetros
        $stmt->bind_param("ss", $usuario, $hashedPassword);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            header("Location: inicio.php");
            exit;
        } else {
            echo "Error en la ejecución de la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>document.getElementById('error-message2').innerHTML = 'Passwords do not match or do not meet requirements';</script>";
    }
}


?>
</body>
</html>
