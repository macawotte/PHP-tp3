<?php
class Ville{


 	private $vil_nom;
	private $vil_num;

	public function __construct($valeurs = array()){
  	if (!empty($valeurs))
  			//print_r ($valeurs);
  			 $this->affecte($valeurs);
  }

  public function affecte($donnees){
  			foreach ($donnees as $attribut => $valeur){
  					switch ($attribut){

  							case 'vil_nom': $this->setVil_nom($valeur); break;
								case 'vil_num': $this->setVil_num($valeur); break;

  					}
  			}
  	}
  public function getVil_nom() {
          return $this->vil_nom;
      }
  public function setVil_nom($vil_nom){
          $this->vil_nom=$vil_nom;
      }
	public function getVil_num() {
		      return $this->vil_num;
		  }
  public function setVil_num($vil_num){
		      $this->vil_num=$vil_num;
		  }

}
?>
