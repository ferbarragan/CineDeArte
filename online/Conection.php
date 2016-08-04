<?php


	class Connection{
		public $User = "misiones_usr";
		public $Password = "misiones123";
		public $Server = "localhost";
		public $DB = "misiones";		
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