
<h1>Ajouter un parcours </h1>

<?php

$pdo=new Mypdo();
$Ville1 = New VilleManager($pdo);
$Ville2 = New VilleManager($pdo);
$ParcoursManager = new ParcoursManager($pdo);


$SelectVille1 = $Ville1->getAllVille();
$SelectVille2 = $Ville2->getAllVille();


if(empty($_POST['vil_num1']) && empty($_POST['vil_num2'] )&& empty($_POST['par_km']) ){

//selection de la premiere ville
  ?>

  <form action="#" id="insert" method="post">

    <p> Ville 1 :
    <select  size="1" name="vil_num1">
    <option value = 0> Choisissez une ville 1 </option>

    <?php  foreach ($SelectVille1 as $ville){
              echo "<option value = \"". $ville->getVil_num()."\">". $ville->getVil_nom()."</option> \n";
            }?>

    </select>


    Ville 2 :
    <select  size=\"1\" name=\"vil_num2\">
    <option value = 0> Choisissez une ville 2 </option>

    <?php foreach ($SelectVille2 as $ville2){
              echo "<option value = \"". $ville2->getVil_num()."\">". $ville2->getVil_nom()."</option> \n";
            }?>

    </select>



    Nombre de kilomètre : <input type="text" name="par_km" size="30" maxlength="50">   </p>
    <br>
    <input type="submit" value="Valider" />
  </form>

 <?php }else{
  //on valide l'ajout dans la base de données
  //print_r ($_POST);
  $parcours = new Parcours($_POST);
  $ParcoursManager ->add($parcours);
?>
  <p>  <img src="image/valid.png" alt="Image validation" />Le parcours à été ajoutée ! </p>

<?php
}
?>
