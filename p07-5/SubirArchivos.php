<?php
 echo "Iniciando proceso de transferencia de archivos </BR>";
 echo "INSERT INTO usuarios (id_usuarios, nombre_usuario, excel) VALUES (NULL, 'prueba ', 'unexcel');</br>";
 //conexion a bd
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "bds133_2";
 
 $conexion = mysqli_connect($servername,$username,$password,$database);
 //INICIAR CON LA TRANSFERENCIA DEL ARCHIVO
 //VALIDAR SI SE PRESIONO UN SUBMIT CON UN METODO PST EN EL FORMULARIO 
 if (ISSET($_POST["submit"])){
	 echo "se presiono un boton submit con metodo post </br>";
	 //$_FILES requiere el nombre del campo del formularo y
	 //tambien requiere de un nombre temporal mientras el archivo esta 
	 //en transito 
	  
	 $archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];
	 $archivoDestino =$_FILES["fileToUpload"]["name"];
	 
	 echo "el archivo a enviar es: ".$archivoDestino."</br>";
	 
	$imageFiletype = pathinfo ($archivoDestino, PATHINFO_EXTENSION);
	$check = gettype ($archivoOrigen ); 
	ECHO "Extension del archivo: ".$imageFiletype."</BR>";
	$excel = "xlsx";
	if ( $imageFiletype == $excel){
	if ($check!==false){
	echo "el archivo es un excel compita :v </br>";
		move_uploaded_file($archivoOrigen,$archivoDestino);
		$query = "INSERT INTO usuarios  VALUES (NULL, 'nombre_usuario','".$archivoDestino."')";
		echo "query a ejecutar: ".$query."</BR>";
		
		if($query_a_ejecutar = mysqli_query($conexion,$query)){
			echo "query ejecutado correctamente </br>";
			HEADER ("Refresh:5, url = formulario_Archivo.html");
		}else{
			echo "query no ejecutado :v <br>";
		}
	}else{
		echo "el archivo no es un excel";
	}
	}else{
		echo "el archivo no es un excel :v";
	}
	
 }
?>