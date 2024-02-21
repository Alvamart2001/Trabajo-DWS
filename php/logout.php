<?php
session_start();
session_destroy();

setcookie('session_id', '', time() - 3600, "/"); // Establece la cookie en el pasado para borrarla
setcookie('username', '', time() - 3600, "/"); // Establece la cookie en el pasado para borrarla

header('Location: inicio.php');
exit;
?>