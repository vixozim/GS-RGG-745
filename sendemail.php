<?php

require_once('phpmailer/class.phpmailer.php');


$mail = new PHPMailer();

if( isset( $_POST['template-contactform-submit'] ) AND $_POST['template-contactform-submit'] == 'submit' ) {
    if( $_POST['template-contactform-name'] != '' AND $_POST['template-contactform-email'] != '' AND $_POST['template-contactform-message'] != '' ) {

        $name = $_POST['template-contactform-name'];
        $email = $_POST['template-contactform-email'];
        $message = $_POST['template-contactform-message'];

        $subject = isset($subject) ? $subject : 'Mensaje desde Sitio Web Salvador Ruggeri';

        $botcheck = $_POST['template-contactform-botcheck'];

        $toemail = 'dvisser@vixoz.com'; // Your Email Address
        $toname = 'Salvador Ruggeri'; // Your Name

        if( $botcheck == '' ) {

            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;

            $name = isset($name) ? "Nombre y Apellido: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $message = isset($message) ? "Comentario: $message<br><br>" : '';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Este Formulario fue Enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $message $referrer";

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