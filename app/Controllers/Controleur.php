<?php
//acces au controller parent pour l heritage
namespace App\Controllers;
use CodeIgniter\Controller;

//=========================================================================================
//définition d'une classe Controleur (meme nom que votre fichier Controleur.php) 
//héritée de Controller et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================

class Controleur extends BaseController {

    public function index() {
        log_message('info', 'Méthode index appelée.');
        //if (isset($_POST['idVisiteur']) && isset($_POST['statut']) && isset($_POST['dateDebut']) && isset($_POST['dateDebut'])) {}
        if (isset($_POST['etape']) && isset($_POST['kilometres']) && isset($_POST['nuitees']) && isset($_POST['repas'])) {
            log_message('info', 'Traitement des frais forfaitaires.');
            $this->renseignement();
        } else if (isset($_POST['date']) && isset($_POST['libelle']) && isset($_POST['montant'])) {
            log_message('info', 'Traitement des frais hors forfait.');
            $this->renseignementhorsforfait();
        } else if (isset($_GET['action']) && $_GET['action'] == 'renseigner_fiche_de_frais') {
            log_message('debug', 'Affichage du formulaire de saisie des frais.');
            $this->renseigner(); 
        } else if (isset($_GET['action']) && $_GET['action'] == 'consulter_fiches_de_frais') {
            log_message('debug', 'Affichage de la page de consultation des fiches de frais.');
            $this->consulter();
        } else if (isset($_GET['action']) && $_GET['action'] == 'absence_visiteur') {
            log_message('debug', 'Affichage de la page d\'absence d\'un visiteur.');
            $this->absence_visiteur();
        } else if (isset($_POST['Consulter'])) {
            log_message('debug', 'Action consulter activée.');
            $this->consulter();
        } else if (isset($_POST['mois'])) {
            log_message('info', 'Consultation des fiches de frais pour un mois spécifique.');
            $this->consulter();
        } else if (!empty($_POST['login']) && !empty($_POST['mdp'])) {
            log_message('info', 'Vérification des identifiants utilisateur.');
            $this->motdp();
        } else {
            log_message('notice', 'Aucune action spécifique, affichage de la page d\'accueil.');
            $this->accueil();
        }
    }

    public function motdp() {
        log_message('debug', 'Méthode motdp appelée.');
        $Modele = new \App\Models\Modele();
        $login = htmlspecialchars($_POST['login']);
        $motdp = htmlspecialchars($_POST['mdp']);

        $chaine_secure = str_replace(array("\n","\r",PHP_EOL),'',$login);
        $chaine_secure2 = str_replace(array("\n","\r",PHP_EOL),'',$motdp);

        $donnees = $Modele->getindex($login, $motdp);
        
        if (isset($donnees[0]->login)) {
            log_message('info', "Connexion réussie pour l'utilisateur : {$donnees[0]->login}");
            $id = $donnees[0]->id;
            session_start();
            $_SESSION['id'] = $id;

            $mois = date("F");
            $donnee2 = $Modele->gettestfiche($id, $mois);

            if (!isset($donnee2[0]->mois)) {
                log_message('info', 'Création d\'une nouvelle fiche de frais.');
                $Modele->creationfichefrais($id, $mois, date('Y-m-d'));
                $Modele->creationfrais($id, $mois, 'KM', 0);
                $Modele->creationfrais($id, $mois, 'NUI', 0);
                $Modele->creationfrais($id, $mois, 'REP', 0);
                $Modele->creationfrais($id, $mois, 'ETP', 0);
            }

            $data['login'] = $donnees[0]->login;
            echo view('accueil', $data);

        } else {
            log_message('error', 'Échec de la connexion : identifiants invalides.');
            echo view('connexion');
        }
    }

    public function accueil() {
        log_message('debug', 'Affichage de la page d\'accueil.');
        echo view('Connexion');
    }

    public function consulter() {
        log_message('debug', 'Méthode consulter appelée.');
        session_start();

        if (isset($_SESSION['id'])) {
            $idvisiteur = $_SESSION['id'];
            $mois = isset($_POST['mois']) ? $_POST['mois'] : '';
            $chaine_secure = str_replace(array("\n","\r",PHP_EOL),'',$mois);
        } else {
            log_message('alert', 'Session utilisateur non valide.');
            return;
        }

        $Modele = new \App\Models\Modele();
        $fiches = $Modele->consultation($mois, $idvisiteur);
        $donnees1 = $Modele->consultationhorsforfait($mois, $idvisiteur);

        if (!$fiches || !$donnees1) {
            log_message('warning', 'Aucune fiche de frais trouvée.');
        }

        $data['fiches'] = $fiches;
        $data['donnees1'] = $donnees1;
        $data['mois'] = $mois;

        echo view('consulterFiche', $data);
    }

    public function renseigner() {
        log_message('debug', 'Affichage du formulaire de saisie des frais.');
        echo view('renseignerFiche');        
    }

    public function renseigerhorsforfait() {
        log_message('debug', 'Méthode renseigerhorsforfait appelée.');
        $Modele = new \App\Models\Modele();
        $libelle = htmlspecialchars($_POST['libelle']);
        $date = htmlspecialchars($_POST['date']);
        $montant = htmlspecialchars($_POST['montant']);

        $chaine_secure = str_replace(array("\n","\r",PHP_EOL),'',$libelle);
        $chaine_secure2 = str_replace(array("\n","\r",PHP_EOL),'',$date);
        $chaine_secure3 = str_replace(array("\n","\r",PHP_EOL),'',$montant);

        $donnees = $Modele->creationfichehorsfrais($libelle, $date, $montant);
        
        if (isset($donnees[0]->id)) {
            log_message('info', 'Fiche hors forfait créée avec succès.');
            $data['id'] = $donnees[0]->id;
            echo view('renseigner', $data);
        } else {
            log_message('error', 'Échec de la création de la fiche hors forfait.');
            echo view('erreur');
        }
    }

    public function erreur($msgErreur) {
        log_message('critical', 'Une erreur s\'est produite : ' . $msgErreur);
        echo view('vueErreur.php', $data);
    }

    public function renseignement() {
        log_message('info', 'Mise à jour des frais forfaitaires.');
        $Modele = new \App\Models\Modele();
        $mois = date("F");
        session_start();
        $idvisiteur = $_SESSION['id'];

        $Modele->lignefraisforfaisupdate($_POST['etape'], 'ETP', $mois, $idvisiteur);
        $Modele->lignefraisforfaisupdate($_POST['kilometres'], 'KM', $mois, $idvisiteur);
        $Modele->lignefraisforfaisupdate($_POST['nuitees'], 'NUI', $mois, $idvisiteur);
        $Modele->lignefraisforfaisupdate($_POST['repas'], 'REP', $mois, $idvisiteur);

        $this->renseigner();
    }

    public function renseignementhorsforfait() {
        log_message('info', 'Mise à jour des frais hors forfait.');
        $Modele = new \App\Models\Modele();
        $libelle = htmlspecialchars($_POST['libelle']);
        $date = htmlspecialchars($_POST['date']);
        $montant = htmlspecialchars($_POST['montant']);
    
        $chaine_secure = str_replace(array("\n","\r",PHP_EOL),'',$libelle);
        $chaine_secure2 = str_replace(array("\n","\r",PHP_EOL),'',$date);
        $chaine_secure3 = str_replace(array("\n","\r",PHP_EOL),'',$montant);
    
        // Extraction du mois sous forme de nombre (01, 02, ..., 12)
        $mois = date("m", strtotime($chaine_secure2));
    
        session_start();
        $idvisiteur = $_SESSION['id'];
        
        $donnees = $Modele->getlignefraishorsforfaisupdate($idvisiteur, $mois, $libelle, $date, $montant);
    
        if (isset($donnees)) {
            log_message('info', 'Mise à jour réussie des frais hors forfait.');
            $data['login'] = $donnees;
            echo view('renseignerFiche', $data);
        } else {
            log_message('error', 'Échec de la mise à jour des frais hors forfait.');
            echo view('renseignerFiche');
        }
    }

    public function absence_visiteur() {
        log_message('debug', 'Affichage de la page d\'absence_visiteur.');
        echo view('absence_visiteur');
    }

    //public function signaler() {
    //    log_message('info', 'Mise à jour des frais hors forfait.');
    //    $Modele = new \App\Models\Modele();
    //    $idVisiteur = htmlspecialchars($_POST['idVisiteur']);
    //    $statut = htmlspecialchars($_POST['statut']);
    //    $dateDebut = htmlspecialchars($_POST['dateDebut']);
    //    $dateFin = htmlspecialchars(!empty($_POST['dateFin']) ? $_POST['dateFin'] : null);
//
    //    $chaine_secure = str_replace(array("\n","\r",PHP_EOL),'',$idVisiteur);
    //    $chaine_secure2 = str_replace(array("\n","\r",PHP_EOL),'',$statut);
    //    $chaine_secure3 = str_replace(array("\n","\r",PHP_EOL),'',$dateDebut);
    //    $chaine_secure4 = str_replace(array("\n","\r",PHP_EOL),'',$dateFin);
//
    //    $modele = new Modele($dsn, $user, $password);
    //    if ($modele->setVisiteurStatut($idVisiteur, $statut, $dateDebut, $dateFin)) {
    //        header("Location: absence_visiteur.php?success=1");
    //        exit();
    //    } else {
    //        header("Location: absence_visiteur.php?error=1");
    //        exit();
    //    }
    //}
}

?>
