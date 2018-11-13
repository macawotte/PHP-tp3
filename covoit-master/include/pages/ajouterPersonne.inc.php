

<?php

$pdo=new Mypdo();
$Annee = new DivisionManager($pdo);
$Departement = new DepartementManager($pdo);
$VilleManager = new VilleManager($pdo);
$Fonction = new FonctionManager($pdo);
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);


$Selectannee = $Annee->getAllAnnee();
$SelectDepartement =$Departement->getAllDepartement();
$SelectFonction = $Fonction->getAllFonction();




// ajouter une personne
if(empty($_POST['per_nom']) && empty($_POST['per_prenom'] )&& empty($_POST['per_tel'])
   &&empty($_POST['per_mail']) && empty($_POST['per_login'] )&& empty($_POST['per_pwd']) && empty($_POST['categorie'])){


	echo "<h1>Ajouter une personne</h1>";
?>

  <form action="#" id="insert" method="post">
  <p> <b> Nom : </b> <input type="text" name="per_nom" size="30" maxlength="50">   </p>
				<p> <b> Prenom : </b> <input type="text" name="per_prenom" size="30" maxlength="50">   </p>
				<p> <b> Téléphone : </b> <input type="text" name="per_tel" size="30" maxlength="50">   </p>
				<p> <b> Mail : </b> <input type="text" name="per_mail" size="30" maxlength="50">   </p>
				<p> <b> Login : </b> <input type="text" name="per_login" size="30" maxlength="50">   </p>
				<p> <b> Mot de passe : </b> <input type="password" name="per_pwd" size="30" maxlength="50">   </p>
      	<br>

				<p> <b> Catégorie : </b> <input type="radio" name="categorie" value="etudiant" checked> Etudiant
																 <input type="radio" name="categorie" value="personnel" > Personnel
      	<input type="submit" value="Valider " />
  </form>




<?php
}else{

        $_SESSION['per_nom']=$_POST['per_nom'];
        $_SESSION['per_prenom']=$_POST['per_prenom'];
        $_SESSION['per_tel']=$_POST['per_tel'];
        $_SESSION['per_mail']=$_POST['per_mail'];
        $_SESSION['per_login']=$_POST['per_login'];
        $_SESSION['per_pwd']=$_POST['per_pwd'];


      	//ajouter un étudiant
      if($_POST['categorie']=="etudiant" && !empty($_POST['per_nom']) && !empty($_POST['per_prenom'])
        && !empty($_POST['per_tel']) && !empty($_POST['per_mail']) && !empty($_POST['per_login'])&& !empty($_POST['per_pwd'])){


                ?>
                <h1> Ajouter un étudiant</h1>
                <form action="#" id="insertetudiant" method="post">

                  <p> <b> Année : </b>
                  <select  size="1" name="div_num">

                  <?php  foreach ($Selectannee as $div){
                            echo "<option value = \"". $div->getDiv_num()."\">". $div->getDiv_nom()."</option> \n";
                          }?>

                  </select></p>


                  <p> <b> Département : </b>
                  <select  size=\"1\" name=\"dep_num\">

                  <?php foreach ($SelectDepartement as $dep){
                        if($dep->getDep_nom()=='GEA'){
                            $ville = $VilleManager->getVilleById($dep->getVil_num())['vil_nom'];
                            echo "<option value = \"". $dep->getDep_num()."\">". $dep->getDep_nom()." (".$ville.")</option> \n";
                        }else{
                            echo "<option value = \"". $dep->getDep_num()."\">". $dep->getDep_nom()."</option> \n";
                          }
                        }?>

                  </select></p>


                  <input type="submit" value="Valider" />
                </form>


      <?php
      	//ajouter un salarié
      }


      if($_POST['categorie']=="personnel" && !empty($_POST['per_nom']) && !empty($_POST['per_prenom'])
        && !empty($_POST['per_tel']) && !empty($_POST['per_mail']) && !empty($_POST['per_login'])&& !empty($_POST['per_pwd'])){
  ?>
          <form action="#" id="insertsalarie" method="post">
      		<h1>Ajouter un salarié</h1>

          <p> <b> Téléphone professionel : </b> <input type="text" name="sal_telprof" size="30" maxlength="50">   </p>

          <p> <b> Fonction : </b>
          <select  size="1" name="fon_num1">

          <?php
            foreach ($SelectFonction as $fonc){
                    echo "<option value = \"". $fonc->getFon_num()."\">".
                     $fonc->getFon_libelle()."</option> \n";
                  }?>

          </select></p>
          <input type="submit" value="Valider" />
          </form>












<?php
      	}
}


if(!empty($_POST['dep_num']) && !empty($_POST['div_num'])){

      $Personne = new Personne(
         array('per_nom'=>$_SESSION['per_nom'], 'per_prenom'=>$_SESSION['per_prenom'],
              'per_tel'=>$_SESSION['per_tel'], 'per_mail'=>$_SESSION['per_mail'],
              'per_login'=>$_SESSION['per_login'], 'per_pwd'=>$_SESSION['per_pwd'] )
          );


      $idPersonne= $personneManager->add($Personne);
      $PersonneEtudiant = new Etudiant(
        array('per_num'=>$idPersonne,
             'dep_num'=>$_POST['dep_num'],
             'div_num'=>$_POST['div_num'] )
         );

       $etudiantManager->add($PersonneEtudiant);
}
?>
