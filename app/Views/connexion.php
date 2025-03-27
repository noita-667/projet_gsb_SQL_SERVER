<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition de l'encodage en UTF-8 pour supporter les caractères spéciaux (accents, etc.) -->
    <meta charset="UTF-8">
    <!-- Balise pour rendre la page responsive et adaptable à tous les appareils (ordinateurs, téléphones, etc.) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page affiché dans l'onglet du navigateur -->
    <title>Page de connexion</title>
    <!-- Inclusion d'une feuille de style externe pour styliser la page -->
    <link rel="stylesheet" href="<?php echo base_url('../public/css/styles.css'); ?>" /> 
</head>

<body>
  <!-- Barre de navigation contenant un lien vers la page d'accueil -->
  <div class="navbar">
    <a href="getdata?index">Accueil</a>
  </div>

  <!-- Conteneur pour le formulaire de connexion -->
  <div class="login-container">
      <!-- Titre du formulaire de connexion -->
      <h2>Connexion</h2>

      <!-- Formulaire de connexion utilisant la méthode POST pour envoyer les données -->
      <form action="postdata" method="post">
        <!-- Champ pour entrer le nom d'utilisateur -->
        <label for="login">Nom d'utilisateur :</label>
        <input type="text" id="login" name="login" required>
        
        <!-- Champ pour entrer le mot de passe -->
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>
        
        <!-- Bouton pour soumettre les informations et se connecter -->
        <input type="submit" name="kaka" value="Se connecter">
      </form>

      <!-- Formulaire pour envoyer un email de demande d'aide -->
      <form action="mailto:aidegsb@gsb.com" method="post" enctype="text/plain">
        <!-- Bouton pour demander de l'aide en envoyant un email -->
        <input type="submit" value="Demander de l'aide">
      </form>
  </div>

  <!-- Ajout de styles CSS en ligne pour définir l'arrière-plan de la page -->
  <style>
      body {
          /* Image de fond qui couvre toute la page */
          background-image: url('../public/css/logo.jfif');
          /* L'image occupe toute la zone disponible */
          background-size: cover;
          /* L'image de fond ne se répète pas */
          background-repeat: no-repeat;
          /* L'image reste fixée à l'écran même en faisant défiler la page */
          background-attachment: fixed;
      }
  </style>
  
</body>
</html>
