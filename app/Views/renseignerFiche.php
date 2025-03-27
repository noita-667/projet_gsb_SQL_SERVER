<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Encodage des caractères en UTF-8 pour supporter les caractères spéciaux -->
    <meta charset="UTF-8">
    <!-- Propriété pour rendre la page responsive, adaptée à tous les écrans -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Renseigner fiche de frais</title>
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

    <!-- Conteneur principal pour le formulaire de saisie des fiches de frais -->
    <div class="frais-container">
        <!-- Titre principal de la section -->
        <h2>Renseigner fiche de frais</h2>

        <!-- Premier formulaire pour saisir les frais forfaitaires -->
        <form action="postdata" method="post">
            <!-- Section pour le choix du nombre de frais à saisir (actuellement sans effet pratique dans le code) -->
            <h3>Choisissez :</h3>
            <label for="choix">Nombre de frais à saisir :</label>
            
            <!-- Section pour saisir les frais forfaitaires -->
            <div id="frais">
                <h3>Frais forfaitaires :</h3>

                <!-- Champ pour saisir le forfait Etape -->
                <label for="etape">Forfait Etape :</label>
                <input type="text" id="etape" name="etape" value="0">
                
                <!-- Champ pour les frais kilométriques -->
                <label for="kilometres">Frais kilométriques :</label>
                <input type="text" id="kilometres" name="kilometres" value="0">
                
                <!-- Champ pour les nuitées d'hôtel -->
                <label for="nuitees">Nuitée hôtel :</label>
                <input type="text" id="nuitees" name="nuitees" value="0">
                
                <!-- Champ pour les repas au restaurant -->
                <label for="repas">Repas restaurant :</label>
                <input type="text" id="repas" name="repas" value="0">

                <!-- Bouton de validation pour soumettre les frais forfaitaires -->
                <input type="submit" value="Valider">
            </div>
        </form>

        <!-- Second formulaire pour saisir les frais hors forfait -->
        <form action="postdata" method="post">
            <!-- Section pour saisir les frais hors forfait -->
            <h3>Frais hors forfait :</h3>

            <!-- Champ pour la date du frais hors forfait -->
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>
            
            <!-- Champ pour saisir la description (libellé) du frais hors forfait -->
            <label for="libelle">Libellé :</label>
            <input type="text" id="libelle" name="libelle" required>
            
            <!-- Champ pour saisir le montant du frais hors forfait -->
            <label for="montant">Montant :</label>
            <input type="text" id="montant" name="montant" required>
        
            <!-- Bouton de validation pour soumettre les frais hors forfait -->
            <input type="submit" value="Valider">
        </form>
    </div>

</body>
</html>
