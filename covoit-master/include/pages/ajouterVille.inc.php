<h1>Ajouter une ville</h1>

<?php

$db = new Mypdo();
$VilleManager = new VilleManager($db);

if(empty($_POST['vil_nom']) ){
  echo "<form action=\"#\" id=\"insert\" method=\"post\"> \n
      Nom : <input type=\"text\" name=\"vil_nom\" size=\"30\" maxlength=\"50\"> \n
      <input type=\"submit\" value=\"Valider \" /> \n
  </form> \n ";

}else{
  $ville = new Ville($_POST);

  $VilleManager->add($ville);
  echo"<p>  <img src=\"image/valid.png\" alt=\"Image validation\" /> \n
         La ville \"<b>".$_POST['vil_nom']."</b>\"</b> à été ajoutée ! </p> \n";
}


 ?>
