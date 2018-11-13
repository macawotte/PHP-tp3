<?php
class FonctionManager{
	public function __construct($db){
	 $this->db = $db;
 }



 public function getAllFonction(){
				 $listeDesFonctions = array();

				 $sql = 'SELECT * FROM fonction';

				 $requete = $this->db->query($sql);

				 while ($fonction = $requete->fetch(PDO::FETCH_OBJ)){
						 $listeDesFonctions[] = new Fonction($fonction);
					 }

				 return $listeDesFonctions;
					$requete->closeCursor();
			 }
}
