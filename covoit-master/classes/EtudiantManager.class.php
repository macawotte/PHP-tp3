<?php
class EtudiantManager{
	public function __construct($db){
		$this->db = $db;
	}

	public function add($valeurs){

		$req = $this->db->prepare('INSERT INTO etudiant (per_num,dep_num,div_num)
		VALUES (:per_num,:dep_num,:div_num)');

		$req->bindValue(':per_num',$valeurs->getPer_num(),PDO::PARAM_INT);
		$req->bindValue(':dep_num',$valeurs->getDep_num(),PDO::PARAM_INT);
		$req->bindValue(':div_num',$valeurs->getDiv_num(),PDO::PARAM_INT);
		$req->execute();
	}
}
