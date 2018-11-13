<?php
class DepartementManager{

		public function __construct($db){
		 $this->db = $db;
	 }



	 public function getAllDepartement(){
					 $listeDesDepartement = array();

					 $sql = 'SELECT * FROM departement';

					 $requete = $this->db->query($sql);

					 while ($departement = $requete->fetch(PDO::FETCH_OBJ)){
							 $listeDesDepartement[] = new Departement($departement);
						 }

					 return $listeDesDepartement;
					  $requete->closeCursor();
				 }

}
