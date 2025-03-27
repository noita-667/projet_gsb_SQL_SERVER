<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Encodage des caractères en UTF-8 pour supporter les caractères spéciaux -->
    <meta charset="UTF-8">
    <!-- Propriété pour rendre la page responsive, adaptée à tous les écrans -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>absence visiteur</title>
    <!-- Lien vers une feuille de style externe pour la mise en forme de la page -->
    <link rel="stylesheet" href="<?php echo base_url('../public/css/styles.css'); ?>" /> 
</head>

<body>
    <!-- Barre de navigation avec plusieurs liens vers différentes pages du site -->
    <div class="navbar">
        <!-- Lien vers la page d'accueil -->
        <a href="getdata?action=Page de navigation - Accueil">Accueil</a>
        <!-- Lien pour consulter les fiches de frais -->
        <a href="getdata?action=consulter_fiches_de_frais">Consulter</a>
        <!-- Lien pour renseigner une fiche de frais -->
        <a href="getdata?action=renseigner_fiche_de_frais">Renseigner</a>
        <!-- Lien vers la page de renseignement d'un responsable -->
        <a href="getdata?action=absence_visiteur">Absence Visiteur</a>
        <!-- Lien pour se déconnecter -->
        <a href="getdata?action=deconnexion">Deconnexion</a>
        <!-- Élément flottant à droite (actuellement vide, utilisé pour éventuellement afficher des informations) -->
        <span style="float:right; padding: 14px 20px; color: white;"></span>
    </div>

    <!-- Image du logo flottant à droite -->
    <img src="../public/css/logo.jfif" alt="Logo" style="float: right; height: 90px;">

    <h2>Signaler une absence de visiteur</h2>

    <form method="POST" action="postdata">
        <label for="visiteur">Matricule du visiteur : </label>
        <input type="text" id="visiteur" name="visiteur" required>

        <label for="motif_absence">Motif d'absence : </label>
        <select name="motif" id="motif" required>
            <option value="maladie">Arrêt maladie</option>
            <option value="pro">Déplacement professionnel</option>
            <option value="conges">Congés</option>
            <option value="autres">Autres</option>
        </select>

        <label for="dateD">Du : </label>
        <input type="date" id="dateD" name="dateD" required>
        <label for="dateF">Au : </label>
        <input type="date" id="dateF" name="dateF" required>

        <input type="submit" value="Signaler">
    </form>
</body>
</html>