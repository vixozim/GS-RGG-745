<?php

//require_once('phpmailer/class.phpmailer.php');
require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");

$mail = new PHPMailer();

if( isset( $_POST['template-contactform-submit'] ) AND $_POST['template-contactform-submit'] == 'submit' ) {
    if( $_POST['template-contactform-name'] != '' AND $_POST['template-contactform-email'] != '' AND $_POST['template-contactform-message'] != '' ) {

        $name = $_POST['template-contactform-name'];
        $email = $_POST['template-contactform-email'];
        $phone = $_POST['template-contactform-phone'];
       
        $message = $_POST['template-contactform-message'];

        $subject = isset($subject) ? $subject : 'Mensaje desde Sitio Web La Santa Teresita';

        $botcheck = $_POST['template-contactform-botcheck'];

        $toemail = 'contacto@lasanta-teresita.com'; // Your Email Address
        $toname = 'La Santa Teresita'; // Your Name

        if( $botcheck == '' ) {

            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;

            $name = isset($name) ? "Nombre y Apellido: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $phone = isset($phone) ? "Teléfono: $phone<br><br>" : '';
            
			$message = isset($message) ? "Comentario: $message<br><br>" : '';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $phone $message $referrer";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ):
               // echo '';
				header('Location: https://www.lasanta-teresita.com/gracias.html');   
            else:
                echo 'El Email no puso ser enviado por un error inesperado. Por favor intente nuevamente' . $mail->ErrorInfo . '';
            endif;
        } else {
            echo 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
        }
    } else {
        echo 'Por favor complete todos los campos y vuelva a enviar';
    }
} else {
    echo 'El Email no puso ser enviado por un error inesperado. Por favor intente nuevamente';
}

?>