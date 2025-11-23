<?php
include("conexion.php");
include("menu.php");
$usuarioingresado = $_SESSION['usuarioingresando'];
$pagina = $_GET['pag'];
$correo = $_GET['correo'];

//proceso de eliminar usuarios
if ($correo == $usuarioingresado) {
    echo "<script> alert('No puedes eliminar a tu propio usuario.'); window.location='listado_usuarios.php' </script>";
} else {
    mysqli_query($conn, "DELETE FROM usuarios WHERE correo='$correo'");
    header("Location:listado_usuarios.php?pag=$pagina");
}
?>