<?php
namespace Lib;
require_once 'PHPMailer-master/PHPMailerAutoload.php';
class Email {
	
	private $email;
	
	public function __construct(){
		
		$this->mail = new \PHPMailer();
		$this->mail->isSMTP();                                     
		$this->mail->Host = 'smtp.gmail.com';  
		$this->mail->SMTPAuth = true;                               
		$this->mail->Username = EMAIL_USERNAME;                 
		$this->mail->Password = EMAIL_PASSWORD;                           
		$this->mail->SMTPSecure = 'tls';                            
		$this->mail->Port = 587;     
		$this->mail->setFrom(EMAIL_USERNAME, 'Mailer');
		$this->mail->CharSet = "UTF-8";
		
	}

	public function send($adress, $subject, $body, $altbody ) {

		$this->mail->addAddress($adress);     
		$this->mail->isHTML(true);                                  
		
		$this->mail->Subject = $subject;
		$this->mail->Body    = $body;
		$this->mail->AltBody = $altbody;
		
		if(!$this->mail->send()) {
			
			return false;
			
		} else {
			
			return true;
			
		}
		
		
		
	}
	

}