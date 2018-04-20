<?php
require 'vendor/phpmailer/PHPMailerAutoload.php';

class phpMail{

	function send_mail($sub,$msg,$from,$from_email,$recipient, $recipient_email,$file_name,$file_path){
		$mail = new PHPMailer;

		// $mail->SMTPDebug = 4;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'testing@bigspire.com';                 // SMTP username
		$mail->Password = 'bigspire1230';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		

		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		
		// $recipient_email = 'jravi.j@gmail.com';
		// echo $recipient_email;
		$mail->setFrom($from_email, $from);
		$mail->addAddress($recipient_email, $recipient);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->addAttachment($file_path, $file_name);    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $sub;
		$mail->Body    = $msg;
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		
		if(!$mail->send()){
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';die;
		}
	}
}
$mailer = new phpMail();