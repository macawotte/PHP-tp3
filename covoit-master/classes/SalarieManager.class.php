<?php
class SalarieManager{

			public function __construct($db){
			 $this->db = $db;
		 }



		 public function getAllFonction(){
						 $listeDesFonction = array();
	
						 $sql = 'SELECT * FROM salarie';

						 $requete = $this->db->query($sql);

						 while ($fonction = $requete->fetch(PDO::FETCH_OBJ)){
								 $listeDesFonction[] = new Salarie($fonction);
							 }

						 return $listeDesFonction;
						  $requete->closeCursor();
					 }
}
