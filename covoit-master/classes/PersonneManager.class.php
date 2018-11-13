<?php
class PersonneManager{
	public function __construct($db){
		$this->db = $db;
	}

	public function add($valeurs){
		$req = $this->db->prepare('INSERT INTO personne (per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd)
		VALUES (:per_nom,:per_prenom,:per_tel,:per_mail,:per_login,:per_pwd)');
		$req->bindValue(':per_nom',$valeurs->getPer_nom(),PDO::PARAM_STR);
		$req->bindValue(':per_prenom',$valeurs->getPer_prenom(),PDO::PARAM_STR);
		$req->bindValue(':per_tel',$valeurs->getPer_tel(),PDO::PARAM_INT);
		$req->bindValue(':per_mail',$valeurs->getPer_mail(),PDO::PARAM_STR);
		$req->bindValue(':per_login',$valeurs->getPer_login(),PDO::PARAM_STR);
		$req->bindValue(':per_pwd',$valeurs->getPer_pwd(),PDO::PARAM_STR);

		$req->execute();

		return $this->db->lastInsertId();

	}


}
