<?php
class ParcoursManager{

	public function __construct($db){
		$this->db = $db;
	}

	public function add($parcours){
		$req = $this->db->prepare('INSERT INTO parcours (par_km,vil_num1,vil_num2) VALUES (:par_km,:vil_num1,:vil_num2)');
		$req->bindValue(':par_km',$parcours->getPar_km(),PDO::PARAM_STR);
		$req->bindValue(':vil_num1',$parcours->getVil_num1(),PDO::PARAM_INT);
		$req->bindValue(':vil_num2',$parcours->getVil_num2(),PDO::PARAM_INT);
		$req->execute();
	}


		public function getAllParcours(){
						$listeDesParcours = array();

						$sql = 'SELECT * FROM parcours';

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($parcours = $requete->fetch(PDO::FETCH_OBJ))
								$listeDesParcours[] = new Parcours($parcours);

						$requete->closeCursor();
						return $listeDesParcours;
					}



}
