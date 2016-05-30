<?php 

require_once 'class.phpmailer.php';

class EnviarEmail{
	
	// Configurações conta email DIO-ES
	private $host = 'ssl://smtp.gmail.com';
	private $port = 465;
	private $auth = true;
	private $from = 'sistema@ioe.pa.gov.br';
	private $fromName = 'Leitor IOEPA';
	private $username = 'sistema@ioe.pa.gov.br';
	private $password = 'sys@2014';
	private $isHTML = true;
	private $isSMTP = true;
	private $wordWrap = 50;
	
	function __construct(){
	}
	
	public function enviar($to, $subject, $message){
				
		$mail = new PHPMailer();

		if ( $this->isSMTP ){
			$mail->IsSMTP();
		}
	
		$mail->Host = $this->host;  // specify main and backup server
		$mail->Port = $this->port;
		$mail->SMTPAuth = $this->auth;  // turn on SMTP authentication
		//$mail->SMTPSecure = "ssl";
		$mail->Username = $this->username;  // SMTP username
		$mail->Password = $this->password;  // SMTP password
	
		$mail->From = $this->from;
		$mail->FromName = $this->fromName;
		$mail->AddAddress($to, $to);
		//$mail->AddReplyTo($mail->From, $mail->FromName);
	
		$mail->WordWrap = $this->wordWrap;                                                         // set word wrap to 50 characters
		$mail->IsHTML($this->isHTML);                                                              // set email format to HTML
	
		$mail->Subject = $subject;
		$mail->Body    = $message;
		$mail->AltBody = "";
		
		$mail->SMTPDebug = 1;
		
		if(!$mail->Send()){
			echo "A Mensagem não foi enviada <p>";
			exit;
		}
	}
	
}

?>