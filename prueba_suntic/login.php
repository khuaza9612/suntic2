<?php
include ("conexion.php");
session_start();
if(!isset($_SESSION['id_usuarios'])) {
	header("Location:index.php");
}

$iduser=$_SESSION['id_usuarios'];
$sql="SELECT id_usuario,nombre FROM usuarios WHERE id_usuario='$iduser'";
$resultado=$conexion-> query($sql);
$row=$resultado->fetch_assoc();
?>