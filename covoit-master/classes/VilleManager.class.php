<?php
class VilleManager{
	public function __construct($db){
		$this->db = $db;
	}

	public function add($ville){
		$req = $this->db->prepare('INSERT INTO ville (vil_nom) VALUES (:vil_nom)');
		$req->bindValue(':vil_nom',$ville->getVil_nom(),PDO::PARAM_STR);
		$req->execute();
	}

	public function getAllVille(){
					$listeDesVilles = array();

					$sql = 'SELECT * FROM ville';

					$requete = $this->db->prepare($sql);
					$requete->execute();

					while ($villes = $requete->fetch(PDO::FETCH_OBJ))
							$listeDesVilles[] = new Ville($villes);

					$requete->closeCursor();
					return $listeDesVilles;
				}


		public function getVilleById($id){


						$sql = 'SELECT vil_nom FROM ville WHERE vil_num ='.$id;

						$requete = $this->db->prepare($sql);
						$requete->execute();

						$ville = $requete->fetch(PDO::FETCH_ASSOC);
						return $ville;

					}

        public function getlaVilleById($id){


            $sql = 'SELECT vil_nom FROM ville WHERE vil_num ='.$id;

            $requete = $this->db->query($sql);
            $ville = $requete->fetch(PDO::FETCH_ASSOC);
            $laville = new Ville($ville);

            return $laville;

        }





}
