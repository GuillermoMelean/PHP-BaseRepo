<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once('Exception.php');
require_once('PHPMailer.php');
require_once('SMTP.php');

try {
	// Instantiation and passing `true` enables exceptions
	//Server settings
	function SendEmail($subject,$body){
		$mail = new PHPMailer(true);
		$mail->SMTPDebug = 0;                                       // Enable verbose debug output
		$mail->isSMTP();                
		$mail->Host       = '';  // Specify main and backup SMTP servers
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = '';                     // SMTP username
		$mail->Password   = '';                               // SMTP password
		$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587;       
		$mail->CharSet = 'UTF-8';
		//Recipients
		$mail->setFrom('geral@phpbaseproject.com', 'Geral PHP-BaseProject');
		$mail->addAddress('guillermo.melean@phpbaseproject.com', 'Geral PHP-BaseProject'); 
	  
	
		$mail->Subject = $subject;
		$mail->Body    = $body;
	
		$mail->send();
		//echo 'Message has been sent';
	}
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


/*header("Access-Control-Allow-Origin: *");

if(isset($_POST['email'])){
		$mailTo = "geral@phpbaseproject.pt";
		$subject = "Mail Enviado do Website";
		$body = "Nova Mensagem da Web<br><br>
		FROM: ".$_POST['email']."<br>
		NAME: ".$_POST['name']."<br>
		CATEGORY: ".$_POST['category']."<br>
		Conteudo: ".$_POST['message']."<br>";
		$headers = "To: Solido <".$mailTo.">\r\n";
		$headers .= "From: ".$_POST['author']." <".$_POST['email'].">\r\n";
		$headers .= "Content-Type: text/html";
		//envio destinatario
		$mail_success =  mail($mailTo, utf8_decode($subject), utf8_decode($body), $headers);		
}*/

?>  
