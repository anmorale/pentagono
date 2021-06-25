<?php


	require("/var/www/matematicas/aplicaciones/PHPMailer2017/class.phpmailer.php");
	
	$From = "matematicas@uniandes.edu.co";
	$Departamento = "Departamento de Matematicas";
	$Subjet = "Departamento de Matematicas - Pentagono";
	
	$Encabezado = "
	<html>
	<head>
	<title>Sugerencia Pentagono</title>
	<style type='text/css'>
	<!--
	.Texto {font-family: Verdana, Arial, Helvetica, sans-serif}
	.style1 {font-family: Arial, Helvetica, sans-serif;	font-size: 12px; }
	-->
	</style>
	</head>
	<body> 
	<H3>Universidad de los Andes<br>Departamento de Matem&aacute;ticas</H3>
	<p>Sugerencia Pentagono, <br><br>";
	
	$informacion = "
	<ul>
		<li>Codigo:".$_POST['Codigo']."</li> 
		<li>Estudiante:".$_POST['Nombre']."</li>
		<li>Correo:".$_POST['Correo']."</li>
		<li>Comentario:".$_POST['Comentario']."</li>
	</ul>";
	
	$Firma = "<br/>Cordial Saludo, 
	<br/>
	<br/>
	<br/>Departamento de Matem&aacute;ticas 
	<br/>Universidad de los Andes 
	<br/>Bloque H 1er. Piso
	<br/>Tel.: [571] 339 4949/99 Ext.: 2716 
	<br/>Bogot&aacute;, Colombia 
	<br/>miquinte@uniandes.edu.co
	<br/>
	<br/>**************************************************************************** 
	<br/>
	<br/>Por favor no imprima este mail y/o los documentos adjuntos a menos que sea necesario. 
	<br/>Departamento de Matem&aacute;ticas - Universidad de los Andes: comprometida con el medio ambiente.
	<br/>$_POST[CorreoEst]
		  </p>
		</body>
	</html>";
	



/******************** ENVIO DE CORREO ELECTRONICO *****************************/
	$mail = new PHPMailer();
	$mail->SetLanguage("es", "/var/www/matematicas/aplicaciones/PHPMailer2017/language/");
	$mail->IsSMTP();                       
	$mail->SMTPSecure 	= "";                
	$mail->Port       	= 25;     
	$mail->Host			= "smtp.uniandes.edu.co";  
	$mail->SMTPAuth 	= false;     			
	$mail->From 		= "$From";
	$mail->FromName 	= "$Departamento";
	$mail->Sender	 	= "$From";
	$mail->AddReplyTo("$From", "$Departamento");
	$mail->WordWrap 	= 50;                  
	$mail->IsHTML(true);                    
	$mail->Subject 		= "$Subjet";
	$mail->AltBody 		= "This is the body in plain text for non-HTML mail clients";
	//$mail->AddAddress("$_POST[UidProfesor]@uniandes.edu.co");
	$mail->AddAddress("$_POST[Correo]");
	//$mail->AddAddress("anmorale@uniandes.edu.co");
	$mail->AddAddress("matematicas@uniandes.edu.co");
	$headers 			= "MIME-Version: 1.0\r\n"; 
	$headers 			.= "Content-type: text/html; charset=iso-8859-1\r\n";

	$mail->Body    = "$Encabezado";
	$mail->Body    .= "$informacion";
	$mail->Body    .= "$Firma";
	
	$valido = split('@',$_POST['Correo']);
	if ($valido[1] == 'uniandes.edu.co') {
		if(!$mail->Send()){
		   echo "<PRE>";	   print_r($mail);	   echo "</PRE>";	   //exit();
		}
	}
	//return true;
/*************************** FIN DEL ENVIO CORREO ELECTRONICO ***************************************************/

header("Location: https://pentagono.uniandes.edu.co/gracias.html");
?>