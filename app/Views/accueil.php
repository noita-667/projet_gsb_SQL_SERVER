<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition de l'encodage des caractères en UTF-8 pour supporter les caractères spéciaux -->
    <meta charset="UTF-8">
    <!-- Balise pour assurer une bonne adaptation de la page sur tous les appareils, notamment les mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Page de navigation - Accueil</title>
    <!-- Inclusion d'une feuille de style CSS pour la mise en page et le style de la page d'accueil -->
    <link rel="stylesheet" href="<?php echo base_url('../public/css/stAcceuil.css'); ?>" />
</head>

<body>
  <!-- Titre principal de la page d'accueil -->
  <h1>Accueil</h1>

  <!-- Barre de navigation avec trois liens vers différentes sections de l'application -->
  <div class="navbar">
    <!-- Lien vers la page d'accueil -->
    <a href="getdata?action=index">Accueil</a>
    <!-- Lien vers la page de consultation des fiches de frais -->
    <a href="getdata?action=consulter_fiches_de_frais">Consulter</a>
    <!-- Lien vers la page de saisie des fiches de frais -->
    <a href="getdata?action=renseigner_fiche_de_frais">Renseigner</a>
    <!-- Lien vers la page de renseignement d'un responsable -->
    <a href="getdata?action=absence_visiteur">Absence Visiteur</a>
  </div>
</body>
</html>
