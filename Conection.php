<?php


	class Connection{
		public $User = "root";
		public $Password = "";
		public $Server = "localhost";
		public $DB = "proyecto_final";
		public $Success = false;

		function __construct(){
			$con = $this->doConnect();

		}

		public function doConnect(){
			$con = @mysql_connect($this->Server,$this->User,$this->Password);

			if (!$con){
				$this->Success = false;
				return mysql_error();
			}

			$db_selected = mysql_select_db($this->DB , $con);

			if (!$db_selected){
				$this->Success = false;
				mysql_close($con);
				return $con;

			}
			$this->Success = true;
			return $con;
		}

		public function getConnect(){
			return $this->Success;
		}
	}


?>
