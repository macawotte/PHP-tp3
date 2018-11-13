<?php
class Fonction{

	private $fon_num;
	private $fon_libelle;

	public function __construct($valeurs = array()){
		if (!empty($valeurs))
				 $this->affecte($valeurs);
	}

	public function affecte($donnees){
				foreach ($donnees as $attribut => $valeur){
						switch ($attribut){

								case 'fon_num': $this->setFon_num($valeur); break;
								case 'fon_libelle': $this->setFon_libelle($valeur); break;

						}
				}
		}
	public function getFon_num() {
					return $this->fon_num;
			}
	public function setFon_num($fon_num){
					$this->fon_num=$fon_num;
			}
	public function getFon_libelle() {
					return $this->fon_libelle;
			}
	public function setFon_libelle ($fon_libelle){
					$this->fon_libelle=$fon_libelle;
			}

}
