<?php

	class Contact {
		public $content;
		public $user_input = array(null,null,null,null);
		public $pref_method;
		public $err_chg = null;
		
		public function pageload() {
			if (isset($_POST['submit'])) {
				$this->have_post();
				}
			else {
				$this->content = 'If you have any questions or you would like to see the house,
				please submit the form below, and we will get back to you, soon.';
				$this->send_content();
				}
			}
		public function send_content() {
			include_once('views/contactviewer.php');
			$adj = new Contactviewer;
			$adj->contactview($this->content,$this->err_chg);
			}
		public function have_post() {
			$errors = null;
			if ($_POST['name'] != "") {
				$this->user_input[0] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
				if ($this->user_input[0] == "") {
					$errors .= 'Please enter a valid name.<br/>';
					}
				} 
			else {
				$errors .= 'Please enter your name.<br/>';
				}
			if ($_POST['phone'] != "") {
				$this->user_input[1] = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
					$phone = preg_replace('/[^0-9]/', '', $this->user_input[1]);
					if ($this->user_input[1] == "" || strlen($phone) !== 10) {
					$errors .= 'Please enter a valid phone number.<br/>';
					}
				} 
			if ($_POST['email'] != "") {
				$this->user_input[2] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
				if (!filter_var($this->user_input[2], FILTER_VALIDATE_EMAIL)) {
					$errors .= 'You have <strong>NOT</strong> entered a valid email address.<br/>';
					}
				} 
			if(empty($_POST['phone']) && empty($_POST['email'])) {
				$errors .= 'Please enter a phone number or email address so that we may contact you.<br />';
				}
			if ($_POST['text'] != "") {
				$this->user_input[3] = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
				if ($this->user_input[3] == "") {
					$errors .= 'Please enter a valid message.';
					}
				} 
			else {
				$errors .= 'Please enter your message.';
				}
			if(isset($_POST['method'])) {
				$this->pref_method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
				}
			else { $this->pref_method = ''; }
			if(!empty($errors)) {
				$this->err_chg = "add_border";
				$this->content = $errors;
				$this->respond();
				}
			else { 
				$this->initiate(); 
				}
			}
		public function respond() {
			include_once('views/contactviewer.php');
			$adj = new Contactviewer;
			$adj->interact($this->content,$this->user_input,$this->pref_method,$this->err_chg);
			}
		public function initiate() {
			include_once('config/process.php');
			$adj = new Process($this->user_input,$this->pref_method);
			$result = $adj->send_email();
			if($result === 'sent') {
				$this->err_chg = null;
				$this->content = 'Your message has been sent. Thank you for contacting us. We will get back to you soon.';
				}
			else {
				$this->err_chg = "add_border";
				$this->content = 'We\'re sorry. We were unable to send your message. Please try re-submitting.';
				}
			$this->respond();
			}
	}
?>
