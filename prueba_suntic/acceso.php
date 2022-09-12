<?php
include ("conexion.php");
 include ("enviar_email.php");



session_start();
if(isset($_SESSION['id_usuarios'])) {
	header("Location:admin.php");
}
//login

//if(!empty($_POST)){
	


//if(!empty($_POST)){
	 if(isset($_POST["ingresarr"])){
	$email=mysqli_real_escape_string($conexion,$_POST['emaill']);
	$num=mysqli_real_escape_string($conexion,$_POST['numm']);
	//$password_encriptada=sha1($password);
	$sql="SELECT id_usuario from usuarios where email='$email' and numero_identificacion='$num'";
	$resultado=$conexion->query($sql);
	$rows=$resultado->num_rows;
	if ($rows>0) {
		$row=$resultado->fetch_assoc();
		$_SESSION['id_usuarios']=$row["id_usuario"];
		header("Location: admin.php");

		# code...
	} else {
	echo "<script>
		alert('usuario o contraseña incorrecta');
		window.location='index.php';
		</script>";
		# code...
	}
}
if(isset($_POST["registrar"])){

	$nombre=mysqli_real_escape_string($conexion,$_POST['nom']);
	$apellido=mysqli_real_escape_string($conexion,$_POST['ape']);
	$ti=mysqli_real_escape_string($conexion,$_POST['ti']);
	$num=mysqli_real_escape_string($conexion,$_POST['num']);
    $numf=mysqli_real_escape_string($conexion,$_POST['numf']);
	$email=mysqli_real_escape_string($conexion,$_POST['email']);
	$coemail=mysqli_real_escape_string($conexion,$_POST['coemail']);
		$token=sha1(rand(0,1000));
	$sqluser="SELECT id_usuario from usuarios where email='$email'";
	$resultadouser=$conexion->query($sqluser);
	$filas=$resultadouser->num_rows;
	if ($filas>0){
		echo "<script>
		alert('el usuario  ya existe');
		window.location='index.php';
		</script>";
	}else{
		// insertar informacion 

		$sqlusuario= "INSERT INTO usuarios(nombre,apellido,tipo_identificacion,numero_identificacion,numero_fijo,email,confirmar_email,token)
		 VALUES('$nombre', '$apellido', '$ti', '$num','$numf','$email','$coemail','$token')";
		 $resultadousuario=$conexion->query($sqlusuario);
		 if ($resultadousuario>0){
			echo "<script>
			alert('registro exitoso $nombre, tu cuenta necesita confirmar,revisa tu correo');
			window.location='index.php';		
			</script>";
			 $para_usuario=$email;
			 $asunto= 'verificar tu cuenta';
			 $mensaje= 'Hola  '.$nombre.'  gracias por registrarte! por favor confirma tu cuenta dando click
			 en el siguiente link:
			 http://localhost/prueba_suntic/activar_correo.php?email='.$email.'&token='.$token;
			 sendemail($para_usuario,$asunto,$mensaje);

		 }else{
			echo "<script>
			alert('error');
			window.location='index.php';
			</script>";

		 }

	}
}
?>