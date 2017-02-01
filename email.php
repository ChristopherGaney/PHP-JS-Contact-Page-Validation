<?php

	class Process {
		public $name;
		public $phone;
		public $email;
		public $text;
		public $method;
	
		public function __construct($imput,$methods) {
			$this->name = $imput[0];
			$this->phone = $imput[1];
			$this->email = $imput[2];
			$this->text = $imput[3];
			$this->method = $methods;
			}
		public function send_email() {
			$to = "christophganey@gmail.com";
			$subject = 'Message about website building!';
			$message = "From: " . $this->name . " " . $this->phone . " " . $this->email . "\n" . $this->text . "\nPreferred method of contact is: "
			 	. $this->method;
			$header = 'From: user@chrisganeymedia.com' . " " . 'Reply-To: user@chrisganeymedia.com' . " " . 'X-Mailer: PHP/' . phpversion();
			
			mail($to,$subject,$message,$header);
		
			return "sent";
		}
			
	}
?>
