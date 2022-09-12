<?php 
include("conexion.php");
session_start();
if (isset($_GET["email"]) && !empty($_GET["email"]) AND isset($_GET["token"]) && !empty($_GET["token"])	) {
	$correo = mysqli_real_escape_string($conexion,$_GET['email']);
	$token  = mysqli_real_escape_string($conexion,$_GET['token']);
	
	$sql = "SELECT * FROM usuarios WHERE email = '$correo' AND token = '$token' AND estado = '0' ";
	$resultado = $conexion->query($sql);
	$rows = $resultado->num_rows;
	if ($rows === 0) {
		echo "<script>
				alert('Tu cuenta ya fue activada o la URL es incorrecta!');
				window.location = 'index.php';
		</script>";
		
	}else{
		$sqlA = "UPDATE usuarios SET estado = '1' WHERE email='$correo'";
		$resultadoA = $conexion->query($sqlA);
		echo "<script>
				alert('Tu cuenta ha sido activada !');
				window.location = 'index.php';
		</script>";
	}
}else{
	echo "<script>
				alert('La URL contiene información incorrecta!');
				window.location = 'index.php';
		</script>";
}

?>