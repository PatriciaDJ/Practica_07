<?php
	ECHO "Iniciando proceso de transferencia de archivo </br>";
	ECHO "INSERT INTO usuario (id_usuario, nombre_usuario, foto) VALUES (NULL, Roberto, Roberto_pack.jpg) </BR>";
	
	//CONEXION BD
	$servername="localhost";
	$username ="root";
	$password="";
	$database= "bd_s133";
	
	$conexion = mysqli_connect($servername,$username,$password,$database);
	//INICIAR TRANSFERENCIA DEL ARCHIVO
	//1.VALIDAR SI SE PRESIONÓ UN SUBMIT CON MÉTODO POST
	IF (ISSET($_POST["submit"])){
		ECHO "Se presionó un botón submit con método POST </br>";
		
	//$_FILES requiere nombre el campo del formulario y 
	//requiere de un nombre temporal mientras el archivo está 
	//en transito 
		
		$archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];
		$archivoDestino =$_FILES["fileToUpload"]["name"];
		ECHO "EL ARCHIVO A ENVÍAR ES: ".$archivoDestino."</br>";
		$check = getimagesize($archivoOrigen); 
		
	//IF ($check == false){
	//SI ENCONTRO ALGO, UN ARCHIVO DE TIPO IMAGEN 
	//echo "El archivo es una imaagen </br>";
	//move_uploaded_file($archivoOrigen,$archivoDestino);
	//}
	
	//PARTE2
//VARIBLE QUE EXTRAIGA LA EXTENSION	
	$imagefiletype = pathinfo($archivoDestino, PATHINFO_EXTENSION);

//VARIABLE QUE VALIDA QUE EL ARCHIVO EA DE TIPO IMAGEN 
$check = getimagesize($archivoOrigen);

ECHO "EXTENSIÓN DEL ARCHIVO: ".$imagefiletype."</br>";

	if ($check!==false){
	echo "el archivo es una imagen </br>";
		move_uploaded_file($archivoOrigen,$archivoDestino);
		$query = "INSERT INTO usuarios  VALUES (NULL, 'nombre','".$archivoDestino."')";
		echo "query a ejecutar: ".$query."</BR>";
		
		if($query_a_ejecutar = mysqli_query($conexion,$query)){
			echo "query ejecutado correctamente </br>";
			HEADER ("Refresh:20, url = formulario_Archivo.html");
		}else{
			echo "query no ejecutado :v <br>";
		}
	}else{
		echo "el archivo no es una imagen";
	}


}
?>