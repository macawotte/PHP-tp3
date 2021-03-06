<!-- Mettre l'objet personne dans la SESSION -->

<?php

$pdo=new Mypdo();
$managerDivision = new DivisionManager($pdo);
$managerDepartement = new DepartementManager($pdo);
$managerVille = new VilleManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$managerEtudiant= new EtudiantManager($pdo);
$managerFonction = new FonctionManager($pdo);
$managerSalarie = new SalarieManager($pdo);


if((empty($_POST['per_nom']) || empty($_POST['per_prenom']) || empty($_POST['per_tel'])
        || empty($_POST['per_mail']) || empty($_POST['per_login'])  || empty($_POST['per_pwd'])
        || empty($_POST['typePersonne'])) && (!isset($_POST['departementEtudiant'])
        && !isset($_POST['fonctionSalarie']))) {

    if(isset($_SESSION['typePersonne'])) {
        unset($_SESSION['typePersonne']);
    }

    ?>

    <h1>Ajouter une personne</h1>

    <form action="#" method="post">
        <table>
            <tr>
                <td class="labelAlign"> <label>Nom:</label> </td>
                <td> <input title="saisieper_nom" type="text" name="per_nom"> </td>
                <td class="labelAlign"> <label>Prenom:</label> </td>
                <td> <input title="saisieper_prenom type="text" name="per_prenom"> </td>
            </tr>

            <tr>
                <td class="labelAlign"> <label>Téléphone:</label> </td>
                <td> <input title="saisieper_tel" type="text" name="per_tel"> </td>
                <td class="labelAlign"> <label>Mail:</label> </td>
                <td> <input title="saisieper_mail" type="text" name="per_mail"> </td>
            </tr>

            <tr>
                <td class="labelAlign"> <label>Login:</label> </td>
                <td> <input title="saisieper_login" type="text" name="per_login"> </td>
                <td class="labelAlign"> <label>Mot de passe:</label> </td>
                <td> <input title="saisieper_pwd" type="password" name="per_pwd"> </td>
            </tr>
            <tr>
                <td colspan=4>
                    <label>Catégorie:</label>
                    <input title="choixcategorieEtudiant" type="radio" name="typePersonne" value="etudiant" checked />
                    <label>Etudiant</label>
                    <input title="choixCategoriePersonnel" type="radio" name="typePersonne" value="personnel" />
                    <label>Personnel</label>
                </td>
            <tr>

                <td colspan=4>
                    <input type="submit" value="Valider" />
                </td>
            </tr>
        </table>
    </form>

    <?php

}

else if((!empty($_SESSION['typePersonne']) && $_SESSION['typePersonne'] == 'etudiant')
    || (!empty($_POST['typePersonne']) && $_POST['typePersonne'] == 'etudiant')) {
    if(!isset($_POST['valider'])) {

        $_SESSION['per_nom'] = $_POST['per_nom'];
        $_SESSION['per_prenom'] = $_POST['per_prenom'];
        $_SESSION['per_tel'] = $_POST['per_tel'];
        $_SESSION['per_mail'] = $_POST['per_mail'];
        $_SESSION['per_login'] = $_POST['per_login'];
        $_SESSION['per_pwd'] = $_POST['per_pwd'];
        $_SESSION['typePersonne'] = $_POST['typePersonne'];

        ?>

        <h1>Ajouter un étudiant</h1>
        <form action="#" method="post">
            <label>Année:</label>
            <select title="choixannee" class="select" name="anneeEtudiant">

                <?php
                $listeDivisions = $managerDivision->getAllAnnee();
                foreach($listeDivisions as $division) {

                    ?>
                    <option value='<?php echo $division->getDiv_num(); ?>'>
                        <?php echo $division->getDiv_nom(); ?>
                    </option>
                    <?php

                }

                ?>

            </select>
            <br>
            <label>Département:</label>
            <select title="choisDepartement" class="select" name="departementEtudiant">

                <?php
                $listeDepartement = $managerDepartement->getAllDepartement();
                foreach($listeDepartement as $departement) {
                    ?>

                    <option value='<?php echo $departement->getDep_num(); ?>'>

                        <?php

                        $estDouble = false;
                        $cpt = 0;

                        foreach($listeDepartement as $departementVerif) {
                            if($departement->getDep_nom() == $departementVerif->getDep_nom()) {
                                $cpt++;
                            }
                            if($cpt == 2) {
                                $estDouble = true;
                            }
                        }

                        if($estDouble) {
                            $ville = $managerVille->getlaVilleById($departement->getVil_num());
                            echo $departement->getDep_nom().' ('.$ville->getVil_nom().')';
                        }
                        else {
                            echo $departement->getDep_nom();
                        }
                        ?>

                    </option>

                    <?php
                }
                ?>

            </select>
            </br>
            <input type="submit" name="valider" value="Valider" />
        </form>

        <?php

    }

    else {
        echo  $pdo->lastInsertId();
        $personne = new Personne(
            array('per_nom' => $_SESSION['per_nom'],
                'per_prenom' => $_SESSION['per_prenom'],
                'per_tel' => $_SESSION['per_tel'],
                'per_mail' => $_SESSION['per_mail'],
                'per_login' => $_SESSION['per_login'],
                'per_pwd' => $_SESSION['per_pwd'].SALT
            )

        );
        echo $pdo->lastInsertId();

        $managerPersonne->add($personne);

        $etudiant = new Etudiant(
            array(
                'per_num' => $pdo->lastInsertId(),
                'dep_num' => $_POST['anneeEtudiant'],
                'div_num' => $_POST['departementEtudiant']
            )

        );

        $managerEtudiant->add($etudiant);
        ?>

        <h1>Ajouter un etudiant</h1>
        <p>
            <img src="image/valid.png" />
            L'etudiant a été ajouté
        </p>

        <?php

    }

}

else {

    if(empty($_POST['telSalarie'])) {

        $_SESSION['per_nom'] = $_POST['per_nom'];
        $_SESSION['per_prenom'] = $_POST['per_prenom'];
        $_SESSION['per_tel'] = $_POST['per_tel'];
        $_SESSION['per_mail'] = $_POST['per_mail'];
        $_SESSION['per_login'] = $_POST['per_login'];
        $_SESSION['per_pwd'] = $_POST['per_pwd'];

        ?>

        <h1>Ajouter un salarié</h1>
        <form action="#" method="post">
            <label>Téléphone professionel:</label>
            <input title="saisieTelSalarie" type="text" name="telSalarie">
            <br>
            <label>Fonction:</label>
            <select  title="choixfonction" class="select" name="fonctionSalarie">

                <?php
                $listeFonction = $managerFonction->getAllFonction();
                foreach($listeFonction as $fonction) {
                    ?>
                    <option value='<?php echo $fonction->getFon_num(); ?>'>
                        <?php echo $fonction->getFon_libelle(); ?>
                    </option>
                    <?php
                }
                ?>

            </select>
            <br>
            <input type="submit" value="Valider" />
        </form>
        <?php
    }

    else {

        $personne = new Personne(
            array('per_nom' => $_SESSION['per_nom'],
                'per_prenom' => $_SESSION['per_prenom'],
                'per_tel' => $_SESSION['per_tel'],
                'per_mail' => $_SESSION['per_mail'],
                'per_login' => $_SESSION['per_login'],
                'per_pwd' => $_SESSION['per_pwd'].SALT
            )
        );

        $managerPersonne->add($personne);
        $salarie = new Salarie(
            array(

                'per_num' => $pdo->lastInsertId(),
                'sal_telprof' => $_POST['telSalarie'],
                'fon_num' => $_POST['fonctionSalarie']
            )
        );

        $managerSalarie->add($salarie);
        ?>

        <h1>Ajouter un salarié</h1>
        <p>
            <img src="image/valid.png" />
            Le salarié a été ajouté
        </p>

        <?php

    }

}

?>