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


        public function add($valeurs){

            $req = $this->db->prepare('INSERT INTO salarie (per_num,sal_telprof,fon_num)
            VALUES (:per_num,:sal_telprof,:fon_num)');

            $req->bindValue(':per_num',$valeurs->getPer_num(),PDO::PARAM_INT);
            $req->bindValue(':sal_telprof',$valeurs->getSal_telprof(),PDO::PARAM_STR);
            $req->bindValue(':fon_num',$valeurs->getFon_num(),PDO::PARAM_INT);
            $req->execute();
        }
}
