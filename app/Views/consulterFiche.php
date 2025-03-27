<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition de l'encodage en UTF-8 pour permettre les caractères spéciaux (accents, etc.) -->
    <meta charset="utf-8" />
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>ConsultationFichesdeFrais</title>
    <!-- Lien vers une feuille de style externe pour la mise en page -->
    <link rel="stylesheet" href="<?php echo base_url('../public/css/styles.css'); ?>" />
</head>
<body>
    <!-- Barre de navigation avec différents liens vers les pages principales de l'application -->
    <div class="navbar">
        <!-- Lien vers la page d'accueil -->
        <a href="getdata?action=Page de navigation - Accueil">Accueil</a>
        <!-- Lien pour consulter les fiches de frais -->
        <a href="getdata?action=consulter_fiches_de_frais">Consulter</a>
        <!-- Lien pour renseigner les fiches de frais -->
        <a href="getdata?action=renseigner_fiche_de_frais">Renseigner</a>
        <!-- Lien vers la page de renseignement d'un responsable -->
        <a href="getdata?action=absence_visiteur">Absence Visiteur</a>
        <!-- Lien pour se déconnecter -->
        <a href="getdata?action=deconnexion">Deconnexion</a>
        <!-- Élément flottant à droite, éventuellement utilisé pour afficher des informations supplémentaires comme l'utilisateur connecté -->
        <span style="float:right; padding: 14px 20px; color: white;"></span>
    </div>

    <!-- Image du logo flottant à droite -->
    <img src="../public/css/logo.jfif" alt="Logo" style="float: right; height: 90px;">

    <!-- Titre principal de la page -->
    <h1>Consultation fiche de frais</h1>

    <!-- Formulaire permettant de sélectionner un mois pour consulter les frais -->
    <form method="POST" action="postdata">
        <!-- Liste déroulante pour sélectionner un mois -->
        <select id="mois" name="mois">
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
        <!-- Bouton pour soumettre le formulaire et consulter les frais -->
        <input type="submit" name="Consulter" value="Consulter">
    </form>

    <div class="principale">
        <!-- Section pour afficher les frais forfaitaires du mois -->
        <h4>Les frais forfait du mois</h4>
        <!-- Tableau pour lister les frais forfaitaires -->
        <table border='1'>
            <tr>
                <!-- En-têtes du tableau indiquant les colonnes -->
                <th>ID du visiteur</th>
                <th>Mois</th>
                <th>ID Frais</th>
                <th>Quantité</th>
            </tr>
            <!-- Vérification si des données existent pour les frais forfaitaires -->
            <?php if (!empty($fiches)): ?>
                <!-- Boucle pour afficher chaque ligne de frais forfaitaire -->
                <?php foreach ($fiches as $fraisForfait): ?>
                    <tr>
                        <td><?php echo $fraisForfait->idVisiteur; ?></td>
                        <td><?php echo $fraisForfait->mois; ?></td>
                        <td><?php echo $fraisForfait->idFraisForfait; ?></td>
                        <td><?php echo $fraisForfait->quantite; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message affiché s'il n'y a pas de frais forfaitaires pour le mois sélectionné -->
                <tr>
                    <td colspan="4">Aucun frais forfait trouvé pour ce mois.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Section pour afficher les frais hors forfait du mois -->
        <h4>Les frais hors forfait du mois</h4>
        <!-- Tableau pour lister les frais hors forfait -->
        <table border='1'>
            <tr>
                <!-- En-têtes du tableau indiquant les colonnes pour les frais hors forfait -->
                <th>ID Fiche</th>
                <th>ID Visiteur</th>
                <th>Mois</th>
                <th>Description</th>
                <th>Date</th>
                <th>Montant</th>
            </tr>
            <!-- Vérification si des données existent pour les frais hors forfait -->
            <?php if (!empty($donnees1)): ?>
                <!-- Boucle pour afficher chaque ligne de frais hors forfait -->
                <?php foreach ($donnees1 as $fraisHorsForfait): ?>
                    <tr>
                        <td><?php echo $fraisHorsForfait->id; ?></td>
                        <td><?php echo $fraisHorsForfait->idVisiteur; ?></td>
                        <td><?php echo $fraisHorsForfait->mois; ?></td>
                        <td><?php echo $fraisHorsForfait->libelle ?></td>
                        <td><?php echo $fraisHorsForfait->date; ?></td>
                        <td><?php echo $fraisHorsForfait->montant; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message affiché s'il n'y a pas de frais hors forfait pour le mois sélectionné -->
                <tr>
                    <td colspan="6">Aucun frais hors forfait trouvé pour ce mois.</td>
                </tr>
            <?php endif; ?>
        </table>

        <!-- Section de style commentée (désactivée) pour définir un arrière-plan avec une image -->
        <!--    
        <style>
            body {
                background-image: url('../public/css/logo.jfif');
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed; /* Cette propriété permet de fixer l'image en arrière-plan */
            }
        </style>
        -->
    </div>
</body>
</html>
