
<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    // include("conexion.php");

    // ob_start();
    // if (!isset($_SESSION['index'])) {
    //     $_SESSION['index'] = 0;
    // }
    
    // // Lógica para manejar la navegación
    // if (isset($_POST['>']) && $_SESSION['index'] < $result->num_rows - 1) {
    //     $_SESSION['index']++;
    // } elseif (isset($_POST['<']) && $_SESSION['index'] > 0) {
    //     $_SESSION['index']--;
    // }
    
    // // Resto del código...
    
    // // Modificar la consulta SQL para usar LIMIT y OFFSET
    // $sql = "SELECT * FROM heroes ORDER BY nombre LIMIT 1 OFFSET {$_SESSION['index']}";
    // $result = $conexion->query($sql);
    
    // if ($result === false) {
    //     echo "Error en la consulta SQL: " . $conexion->error;
    // } else {
    //     if ($result->num_rows === 0) {
    //         echo "No hay registros";
    //     } else {
    //         $row = $result->fetch_assoc();
    
    //         $_SESSION['nombre'] = $row['nombre'];
    //         $_SESSION['clase'] = $row['clase'];
    //         $_SESSION['aula'] = $row['aula'];
    //         $_SESSION['edad'] = $row['edad'];
    //         $_SESSION['imagen'] = $row['foto'];
    
    //         // Actualizar los campos del formulario
    //         echo '<script>
    //             document.getElementById("nombreData").value = "' . $_SESSION['nombre'] . '";
    //             document.getElementById("Clase").value = "' . $_SESSION['clase'] . '";
    //             document.getElementById("Aula").value = "' . $_SESSION['aula'] . '";
    //             document.getElementById("Edad").value = "' . $_SESSION['edad'] . '";
    //             document.getElementById("imagen").src = "' . $_SESSION['imagen'] . '";
    //         </script>';
    //     }
    // }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="principal.css">
    <title>Document</title>
</head>
<body>
<?php


if (isset($_SESSION['pepito'])) {
    $usuario = $_SESSION['pepito'];

    echo '<header>
            <span><strong>' . ucfirst($usuario) . '</strong></span>
        <a href="logout.php" class="logout-link">Logout</a>
        </header>';
}
    ?>

<?php if ($_SESSION['userrolw'] == '01' || $_SESSION['userrolw'] == '02' || $_SESSION['userrolw'] == '03'): ?>
    <form class="search-container" method="get" action="principal.php">
        <input type="text" name="name" id="name" class="search-input">
        <button type="submit" value="Buscar" name="Buscar" class="search-button">Buscar</button>
    </form>
    <?php endif; ?>


    

    <div class="horizontal-line"></div>

    <?php if ($_SESSION['userrolw'] == '01' || $_SESSION['userrolw'] == '02' || $_SESSION['userrolw'] == '03'): ?>

    <div class="nav-form">
        <!-- Formulario Navegación Anterior -->
        <form action="principal.php" method="post">
    <input type="submit" value="<<" name="<" class="prev-button">
</form>

<form action="principal.php" method="post">
    <input type="submit" value=">>" name=">" class="next-button">
</form>
    </div>

    <section class="data-section">
        <form action="" method="post" class="data-form" enctype="multipart/form-data">
            <div class="data-container">
                <img src="foto2.png" id="imagen" alt="" class="character-image">
                <div class="character-data-container">
                    <div class="character-name">
                        <input type="text" name="nombreData" id="nombreData" placeholder="Nombre:" class="readonly-input" readonly>
                    </div>
                    <div class="Clase">
                        <input type="text" name="Clase" id="Clase" placeholder="Clase:" class="readonly-input" readonly>
                    </div>
                    <div class="Aula">
                        <input type="text" name="Aula" id="Aula" placeholder="Aula:" class="readonly-input" readonly>
                    </div>
                    <div class="Edad">
                        <input type="text" name="Edad" id="Edad" placeholder="Edad:" class="readonly-input" readonly>
                    </div>
                    <button class="delete-button" name="Eliminar" id="Eliminar" <?php if ($_SESSION['userrolw'] == '01' || $_SESSION['userrolw'] == '02'): ?>disabled<?php endif; ?>>Eliminar</button>
                </div>
            </div>
        </form>
    </section>

    <?php endif; ?>

    <div class="horizontal-line"></div>


    <?php if ($_SESSION['userrolw'] == '02' || $_SESSION['userrolw'] == '03'): ?>
    <section class="data-section2">
    <form action="#" method="post" class="data-form" enctype="multipart/form-data">
        <div class="data-container">
            <input type="file" name="fotocrud" id="fotocrud">
            <div class="character-data-container">
                <div class="character-name">
                    <input type="text" name="nombreData2" id="nombreData2" placeholder="Nombre:">
                </div>
                <div class="Clase">
                    <input type="text" name="Clase2" id="Clase2" placeholder="Clase:">
                </div>
                <div class="Aula">
                    <input type="text" name="Aula2" id="Aula2" placeholder="Aula:">
                </div>
                <div class="Edad">
                    <input type="text" name="Edad2" id="Edad2" placeholder="Edad:">
                </div>

                <!-- Botones de acción dentro del formulario -->
                <div class="action-buttons">
                    <!-- Botón Actualizar -->
                    <button class="update-button" type="submit" name="Actualizar" id="Actualizar" <?php if ($_SESSION['userrolw'] == '02'): ?>disabled<?php endif; ?>>Actualizar</button>
                    
                    <!-- Botón Guardar -->
                    <button class="save-button" type="submit" name="Guardar" id="Guardar" <?php if ($_SESSION['userrolw'] == '02'): ?>disabled<?php endif; ?>>Guardar</button>
                </div>
            </div>
        </div>
    </form>
</section>

<?php endif; ?>
    <?php

        include("conexion.php");

        // ob_start();
        // if (!isset($_SESSION['index'])) {
        //     $_SESSION['index'] = 0;
        // }

        // if (isset($_POST['>'])) {
        //     $_SESSION['index']++;
        // } elseif (isset($_POST['<']) && $_SESSION['index'] > 0) {
        //     $_SESSION['index']--;
        // }
        
        // $sql = "SELECT * FROM heroes ORDER BY nombre";
        // $result = $conexion->query($sql);
        
        // if ($_SESSION['index'] >= $result->num_rows) {
        //     echo "Has llegado al último registro";
        //     $_SESSION['index'] = $result->num_rows - 1;
        // }


        


        if (isset($_POST["Guardar"])) {
            $nombre = $_POST["nombreData2"];
            $clase = $_POST["Clase2"];
            $aula = $_POST["Aula2"];
            $edad = $_POST["Edad2"];
        
            // Verificar si se subió un archivo
            if (isset($_FILES['fotocrud'])) {
                $errors = array();
                $file_name = $_FILES['fotocrud']['name'];
                $file_size = $_FILES['fotocrud']['size'];
                $file_tmp = $_FILES['fotocrud']['tmp_name'];
                $file_type = $_FILES['fotocrud']['type'];
                $file_parts = explode('.', $file_name);
                $file_ext = strtolower(end($file_parts));
        
                $extensions = array("jpeg", "jpg", "png");
        
                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
                }
        
                if (empty($errors)) {
                    $foto = "../imagenes/" . $file_name;
                    if (!file_exists('../imagenes/')) {
                        mkdir('../imagenes/', 0777, true);
                    }
        
                    if (move_uploaded_file($file_tmp, $foto)) {
                        echo "Success";
                    } else {
                        echo "Error moving uploaded file";
                    }
                } else {
                    print_r($errors);
                }
            } else {
                echo "No se ha subido ningún archivo.";
            }
        
            // Preparar la consulta
            $stmt = $conexion->prepare("INSERT INTO heroes (nombre, foto, clase, aula, edad) VALUES (?, ?, ?, ?, ?)");
        
            // Vincular los parámetros
            $stmt->bind_param("ssssi", $nombre, $foto, $clase, $aula, $edad);
        
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Creado con éxito";
            } else {
                echo "Error en la ejecución de la consulta: " . $stmt->error;
            }
        
            $stmt->close();
        }

        if (isset($_POST["Eliminar"])) {

            // Si se hace clic en el botón de eliminar
            // Obtener el nombre del registro a eliminar
            $nombreEliminar = $_POST["nombreData"];

            // Preparar la consulta de eliminación
            $stmt = $conexion->prepare("DELETE FROM heroes WHERE nombre = ?");

            // Vincular los parámetros
            $stmt->bind_param("s", $nombreEliminar);

            // Ejecutar la consulta de eliminación
            if ($stmt->execute()) {
                echo "Eliminado con éxito";
                // Puedes redirigir después de la eliminación
                // header("Location: tu_pagina_redireccion.php");
                // exit();
            } else {
                echo "Error en la ejecución de la consulta de eliminación: " . $stmt->error;
            }

            $stmt->close();
        }

        function updateFormFields() {
            echo '<script>
            document.getElementById("nombreData").value = "' . $_SESSION['nombre'] . '";
            document.getElementById("Clase").value = "' . $_SESSION['clase'] . '";
            document.getElementById("Aula").value = "' . $_SESSION['aula'] . '";
            document.getElementById("Edad").value = "' . $_SESSION['edad'] . '";
            document.getElementById("imagen").src = "' . $_SESSION['imagen'] . '";
            </script>';
        }


        if (isset($_GET["Buscar"])) {
            // Obtener el valor del campo de búsqueda
            $busqueda = $_GET["name"];
    
            // Preparar la consulta para buscar en varios campos
            $stmt = $conexion->prepare("SELECT * FROM heroes WHERE nombre LIKE ? OR clase LIKE ? OR aula LIKE ? OR edad LIKE ?");
            
            // Vincular los parámetros
            $busqueda_param = "%{$busqueda}%";
            $stmt->bind_param("ssss", $busqueda_param, $busqueda_param, $busqueda_param, $busqueda_param);
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Obtener resultados
            $resultados = $stmt->get_result();


            if ($resultados->num_rows > 0) {
                $row = $resultados->fetch_assoc();
        
        
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['clase'] = $row['clase'];
                $_SESSION['aula'] = $row['aula'];
                $_SESSION['edad'] = $row['edad'];
                $_SESSION['imagen'] = $row['foto'];
        
                updateFormFields();
            } else {
                echo "Ningun resultado encontrado.";
            }
    
            // Cerrar la consulta
            $stmt->close();


        }

        if (isset($_POST["Actualizar"])) {
            // Obtener los valores del formulario
            $nombre = $_POST["nombreData2"];
            $clase = $_POST["Clase2"];
            $aula = $_POST["Aula2"];
            $edad = $_POST["Edad2"];
        
            // Verificar si se subió un nuevo archivo
            if (isset($_FILES['fotocrud'])) {
                $errors = array();
                $file_name = $_FILES['fotocrud']['name'];
                $file_size = $_FILES['fotocrud']['size'];
                $file_tmp = $_FILES['fotocrud']['tmp_name'];
                $file_type = $_FILES['fotocrud']['type'];
                $file_parts = explode('.', $file_name);
                $file_ext = strtolower(end($file_parts));
        
                $extensions = array("jpeg", "jpg", "png");
        
                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
                }
        
                if (empty($errors)) {
                    $foto = "../imagenes/" . $file_name;
                    if (!file_exists('../imagenes/')) {
                        mkdir('../imagenes/', 0777, true);
                    }
        
                    if (move_uploaded_file($file_tmp, $foto)) {
                        echo "Success";
                    } else {
                        echo "Error moving uploaded file";
                    }
                } else {
                    print_r($errors);
                }
            } else {
                echo "No se ha subido ningún archivo.";
            }
        
            // Preparar la consulta de actualización
            $stmt = $conexion->prepare("UPDATE heroes SET clase = ?, aula = ?, edad = ?, foto = ? WHERE nombre = ?");
        
            // Vincular los parámetros
            $stmt->bind_param("ssiss", $clase, $aula, $edad, $foto, $nombre);
        
            // Ejecutar la consulta de actualización
            if ($stmt->execute()) {
                echo "Actualizado con éxito";
            } else {
                echo "Error en la ejecución de la consulta de actualización: " . $stmt->error;
            }
        
            $stmt->close();
        }

       


    ?>

</body>
</html>
