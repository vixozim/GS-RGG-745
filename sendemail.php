<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();

if( isset( $_POST['template-contactform-submit'] ) AND $_POST['template-contactform-submit'] == 'submit' ) {
    if( $_POST['template-contactform-name'] != '' AND $_POST['template-contactform-email'] != '' AND $_POST['template-contactform-message'] != '' ) {

        $name = $_POST['template-contactform-name'];
        $email = $_POST['template-contactform-email'];
       // $phone = $_POST['template-contactform-phone'];
        $subject = $_POST['template-contactform-subject'];
        $message = $_POST['template-contactform-message'];

        $subject = isset($subject) ? $subject : 'Nuevo Mensaje desde el sitio web';

        $botcheck = $_POST['template-contactform-botcheck'];

        //$toemail = 'daiterina@gmail.com'; // Your Email Address
        $toname = 'RUGGERI'; // Your Name

        if( $botcheck == '' ) {

            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;

            $name = isset($name) ? "Nombre: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
           // $phone = isset($phone) ? "Teléfono: $phone<br><br>" : '';
            $subject = isset($subject) ? "Asunto: $subject<br><br>" : '';
			$message = isset($message) ? "Mensaje: $message<br><br>" : '';

            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Esta formulario fue enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $phone $subject $message";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ):
               // echo '';
				header('Location: #');   
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
