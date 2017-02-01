<?php 

	class Contactviewer {
		public $user_imput = null;
		public $telephone = 'unchecked';
		public $email = 'unchecked';
	
		public function contactview($imgs,$chg) {
			$show = $imgs;
			$change = $chg;
			$imputs = $this->user_imput;
			$methods = array($this->telephone,$this->email);
			include_once ('includes/header.php');
			include_once ('includes/contact_tmpl.php');
			}
		public function interact($contents,$imput,$mthod,$chaing) {
			$this->user_imput = $imput;
			if(!empty($mthod)) {
				$this->$mthod = 'checked';
				}
			$this->contactview($contents,$chaing);
			}
	}
?>
