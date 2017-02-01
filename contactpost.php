<?php

	$adj = new Contactpost;
	$result = $adj->have_post();
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($result);
	
	class Contactpost {
		public $user_input = array(null,null,null,null);
		public $pref_method = "";
		
		public function have_post() {
		
			$errors = array('have_errors');
			if ($_POST['name'] != "") {
				$this->user_input[0] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
				if ($this->user_input[0] == "") {
					array_push($errors,'#error_name','*Please enter a valid name.');
					}
				} 
			else {
				array_push($errors,'#error_name','*Please enter your name.');
				}
			if ($_POST['phone'] != "") {
				$this->user_input[1] = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
					$phone = preg_replace('/[^0-9]/', '', $this->user_input[1]);
					if ($this->user_input[1] == "" || strlen($phone) !== 10) {
					array_push($errors,'#error_phone','*Please enter a valid phone number.');
					}
				} 
			if ($_POST['email'] != "") {
				$this->user_input[2] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
				if (!filter_var($this->user_input[2], FILTER_VALIDATE_EMAIL)) {
					array_push($errors,'#error_email','*You have NOT entered a valid email address.');
					}
				}
			if(empty($_POST['phone']) && empty($_POST['email'])) {
				array_push($errors,'#error_info','*Please enter a phone number or email address so that we may contact you.');
			}
			if ($_POST['text'] != "") {
				$this->user_input[3] = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
				if ($this->user_input[3] == "") {
					array_push($errors,'#error_text','*Please enter a valid message.');
					}
				} 
			else {
				array_push($errors,'#error_text','*Please enter your message.');
				}
			$arr_length = count($errors);
			if($arr_length > 1) {
				return $errors;
				}
			else { 
				$mail_status = $this->initiate(); 
				return $mail_status;
				}
			}
		public function initiate() {
			if(isset($_POST['method'])) {
				$this->pref_method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
				}
			else { $this->pref_method = ""; }
			include_once('config/process.php');
			$adj = new Process($this->user_input,$this->pref_method);
			$result = $adj->send_email();
			if($result === 'sent') {
				return array('good','Your message has been sent. Thank you for contacting us. We will get back to you soon.');
				}
			else {
				return array('notgood','We\'re sorry. We were unable to send your message. Please try re-submitting.');
				}
			}
	}
?>
