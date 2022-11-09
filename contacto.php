<?php
/**
 * @version 1.0
 */

require("class.phpmailer.php");
require("class.smtp.php");

// Valores enviados desde el formulario
if ( !isset($_POST["nombre"]) || !isset($_POST["email"]) || !isset($_POST["mensaje"]) ) {
    die ("Es necesario completar todos los datos del formulario");
}
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$mensaje = $_POST["mensaje"];

// Datos de la cuenta de correo utilizada para enviar vía SMTP
$smtpHost = "c1900287.ferozo.com";  // Dominio alternativo brindado en el email de alta 
$smtpUsuario = "no-reply@c1900287.ferozo.com";  // Mi cuenta de correo
$smtpClave = "cl2ChfzX8n";  // Mi contraseña

// Email donde se enviaran los datos cargados en el formulario de contacto
$emailDestino = "dvisser@vixoz.com";

$mail = new PHPMailer();
$mail->SMTPDebug = 0;
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Port = 465; 
$mail->SMTPSecure = 'ssl';
$mail->IsHTML(true); 
$mail->CharSet = "utf-8";


// VALORES A MODIFICAR //
$mail->Host = $smtpHost; 
$mail->Username = $smtpUsuario; 
$mail->Password = $smtpClave;

$mail->From = $email; // Email desde donde envío el correo.
$mail->FromName = $nombre;
$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

$mail->Subject = "Salvador Ruggeri - Formulario de Contacto"; // Este es el titulo del email.
$mensajeHtml = nl2br($mensaje);
$mail->Body = "Nombre: $nombre <br /> Email: $email <br /> Comentarios: $mensaje <br /><br />Salvador Ruggeri - Formulario de Contacto<br />"; // Texto del email en formato HTML
$mail->AltBody = "{$mensaje} \n\n Salvador Ruggeri - Formulario de Contacto"; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

$estadoEnvio = $mail->Send(); 
if($estadoEnvio){
    //echo "El correo fue enviado correctamente.";
	header('Location: https://vixozim.github.io/GS-RGG-745/gracias.html');  
} else {
    echo "Ocurrió un error inesperado.";
}
