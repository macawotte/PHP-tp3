<?php
class DivisionManager{

	public function __construct($db){
	 $this->db = $db;
 }



 public function getAllAnnee(){
				 $listeDesAnnee = array();

				 $sql = 'SELECT div_num,div_nom FROM division';

				 $requete = $this->db->query($sql);

				 while ($annee = $requete->fetch(PDO::FETCH_OBJ)){
						 $listeDesAnnee[] = new Division($annee);
					 }

				 return $listeDesAnnee;
				  $requete->closeCursor();
			 }
}
	?>
