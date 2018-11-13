<h1>Liste des parcours proposés</h1>

<?php


$pdo=new Mypdo();
$ParcoursManager = new ParcoursManager($pdo);
$VilleManager = new VilleManager($pdo);

$parcours=$ParcoursManager->getAllParcours();
$nbarcours = sizeof($parcours);



?>

<p> Actuellement <?php echo $nbarcours; ?> villes sont enregistrées </p>
<table>
  <tr><th><b>Numéro</b></th> <th><b>Nom Ville </b></th> <th><b>Nom Ville </b></th> <th><b> Nombre de Km </b></th> </tr>
  <?php
  foreach ($parcours as $Leparcours){ ?>

    <tr><td class="TableauAff"><?php echo $Leparcours->getPar_num();?></td>
    <td class="TableauAff"><?php echo $VilleManager->getVilleById($Leparcours->getVil_num1())['vil_nom'];?></td>
    <td class="TableauAff"><?php echo  $VilleManager->getVilleById($Leparcours->getVil_num1())['vil_nom'];?></td>
    <td class="TableauAff"><?php echo $Leparcours->getPar_km();?></td>
  </tr>
  <?php } ?>
  </table>
  <br />
