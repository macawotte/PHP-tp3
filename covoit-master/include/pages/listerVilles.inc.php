<h1>Liste des villes</h1>

<?php

$pdo=new Mypdo();
$VilleManager = new VilleManager($pdo);

$Villes=$VilleManager->getAllVille();
$nbVilles = sizeof($Villes);
?>

<p> Actuellement <?php echo $nbVilles; ?> villes sont enregistrées </p>
<table>
  <tr><th><b>Numéro</b></th><th><b>Nom</th></b></tr>
  <?php
  foreach ($Villes as $ville){ ?>

    <tr><td class="TableauAff"><?php echo $ville->getVil_num();?></td>
    <td class="TableauAff"><?php echo $ville->getVil_nom();?></td>
  </tr>
  <?php } ?>
  </table>
  <br />
