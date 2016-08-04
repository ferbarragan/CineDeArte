<?php

?>
<script language="JavaScript">
     function borrado() {
       alert("Borrado correctamente");
  }
 </script>
<?php
	include("../Conection.php");

	//include("../JSON.php");

	class Pelicula {

		public $obj_cnx;
		public $descripcion;
		public $precio;
		public $url_imagen;
		public $exito=false;
		public $extra;

		public function __construct(){
			$this->obj_cnx = new Connection();
		}

		public function agregar($descripcion, $precio,$url_imagen){

		if($this->obj_cnx->getConnect()) {

				date_default_timezone_set("America/Mexico_City");
				$date = getDate();
				$numFid = $date["0"];

				$this->extra = $numFid;
				$this->exito = true;

				$query = sprintf("INSERT INTO peliculas(descripcion,precio,url_imagen)
				VALUES ('%s', '%s', '%s');",
				$descripcion, $precio,$url_imagen);

				$res = mysql_query($query);

				if(!$res) {
					$msg_error = mysql_error();
					echo $msg_error;
					$this->exito = false;
				}
			}

			//header("Location: listaCoordinadores.php");
		}

		public function modificar($descripcion, $precio, $url_imagen, $id){
			if($this->obj_cnx->getConnect()) {
				$this->exito = true;
				$query = sprintf("UPDATE peliculas SET descripcion = '%s', precio = '%s', url_imagen='%s'
				 WHERE id = '%s';", $descripcion, $precio,$url_imagen,$id);

				$res = mysql_query($query);

				if(!$res) {
					$msg_error = mysql_error();
					echo $msg_error;
					$this->exito = false;
				}
			}

			}

		public function borrar($id){
			if($this->obj_cnx->getConnect()) {
				$this->exito = true;

				$query = sprintf(" UPDATE peliculas SET `deleted_at`=CURTIME() WHERE id = '%s';", $id);
				$res = mysql_query($query);
				echo $query;
				if(!$res) {
					$msg_error = mysql_error();
					$this->exito = false;
				}

				else
				echo("<script> Function borrado()</script>");

			}

//			header("Location: prod_listaProductos.php");
		}

    /* Get the Movie Genres */
		public function getGenres($id) {
			if($this->obj_cnx->getConnect()) {

				$query = sprintf("SELECT g.genName as genre FROM movie_has_genre mg left join genre g on mg.genre_id=g.id where mg.movie_id = %s;", $id);
				$res = mysql_query($query);
				return $res;
			}
		}
    /* Get the Movie Countries */
    public function getCountries($id) {
      if($this->obj_cnx->getConnect()) {

        $query = sprintf("SELECT c.country as country FROM movie_has_country mc left join country c on mc.country_id=c.id where mc.movie_id = %s;", $id);
        $res = mysql_query($query);
        return $res;
      }
    }
    /* Get the Movie Directors */
    public function getDirectors($id) {
      if($this->obj_cnx->getConnect()) {

        $query = sprintf("SELECT d.dirName as director FROM movie_has_director md left join director d on md.director_id=d.id where md.movie_id = %s;", $id);
        $res = mysql_query($query);
        return $res;
      }
    }
    /* Get the Movie Actors */
    public function getActors($id) {
      if($this->obj_cnx->getConnect()) {

        $query = sprintf("SELECT a.actorName as actor FROM movie_has_actor ma left join actor a on ma.actor_id=a.id where ma.movie_id = %s;", $id);
        $res = mysql_query($query);
        return $res;
      }
    }
    /* Get the Movie Awards */
    public function getAwards($id) {
      if($this->obj_cnx->getConnect()) {

        $query = sprintf("SELECT aw.awardName as award FROM movie_has_award maw left join award aw on maw.award_id=aw.id where maw.movie_id = %s;", $id);
        $res = mysql_query($query);
        return $res;
      }
    }

		public function get_all(){

		// instrucciones_metodo;
			if($this->obj_cnx->getConnect())
			{
				$squery = "SELECT * FROM movie;";
				$res = mysql_query($squery);
				return $res;
			}

		}



	}

	?><?php

		$Pelicula = new Pelicula();

		if(!isset($_GET['accion']))
			$_GET['accion'] = "list2";

		switch($_GET['accion']) {
			case 'add':

				$target_dir = "../img/peliculas/";
				$target_file = $target_dir . basename($_FILES["element_10"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$Pelicula->agregar(utf8_decode($_POST['descripcion2']),utf8_decode($_POST['precio2']),utf8_decode($imageFileType));
				if($Pelicula->exito){

					echo '{"success":"true", "accion":"'.$_GET['accion'].'", "numFid":"'.$Pelicula->extra.'"}';

				}else{
					echo '{"success":"false", "accion":"'.$_GET['accion'].'", "name":"'.$_POST['file'].'"}';
				}
				break;

			case 'list':
				$rs = $Pelicula->get_all();
				break;
			case 'del':
				$Pelicula->borrar($_GET['id']);

				if($Pelicula->exito){
					echo '{"success":"true", "accion":"'.$_GET['accion'].'"}';
					$result = Extra::safeRedirect("pel_listaPeliculas.php?delete=1");
				}else{
					echo '{"success":"false", "accion":"'.$_GET['accion'].'}';
				}


				break;
			case 'edit':
				$row = $Peliculas->get_Pelicula($_GET['id']);
				break;
			case 'save_edit':
				$target_dir = "../img/peliculas/";
				$target_file = $target_dir . basename($_FILES["element_10"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

				$des='descripcion'.$_GET['id'];
				$pre='precio'.$_GET['id'];
				$Pelicula->modificar(utf8_decode($_POST[$des]),utf8_decode($_POST[$pre]),utf8_decode($imageFileType),$_GET['id']);
				if($Pelicula->exito){
					echo '{"success":"true", "accion":"'.$_GET['accion'].'", "name":"'.$_POST[$des].'"}';

					$result = Extra::safeRedirect("pel_listaPeliculas.php?update=1");
				}else{
					echo '{"success":"false", "accion":"'.$_GET['accion'].'", "name":"'.$_POST['descripcion'].'"}';
				}

				break;

		}
	?>
