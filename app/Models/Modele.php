<?php
//acces au Modele parent pour l heritage
namespace App\Models;
use CodeIgniter\Model;

//=========================================================================================
//définition d'une classe Modele (meme nom que votre fichier Modele.php) 
//héritée de Modele et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================
class Modele extends Model {

//==========================
// Code du modele
//==========================

//=========================================================================
// Fonction 1
// récupère les données BDD dans une fonction getBillets
// Renvoie la liste de tous les billets, triés par identifiant décroissant
//=========================================================================
public function getIndex($login, $mdp) {
    $db = db_connect();

    // Appel de la procédure stockée
    $sql = "EXEC GetVisiteurIndex ?, ?";
    $query = $db->query($sql, [$login, $mdp]);

    // Récupérer le résultat
    return $query->getResult();
}   

//=========================================================================
    // Fonction 2 : gettestfiche
    // Vérifie l'existence d'une fiche de frais pour un visiteur donné et un mois donné.
    // Paramètres : $id (identifiant du visiteur), $mois
    // Renvoie les résultats sous forme d'objet.
    //=========================================================================
public function gettestfiche($id,$mois) { 
    $db = db_connect();
    $sql = "SELECT mois FROM FicheFrais WHERE idVisiteur = ? AND mois = ? ";
    $resultat = $db->query($sql, [$id,$mois]);
    $resultat = $resultat->getResult();
    return $resultat;
}

//public function verificationFrais($id,$mois) { 
//    $db = db_connect();
//    $sql = "SELECT * FROM lignefraisforfait WHERE idVisiteur = ? AND mois = ?";
//    $resultat = $db->query($sql, [$id,$mois]);
//    $resultat = $resultat->getResult();
//    return $resultat;
//    }


//public function verificationHorsFrais($id,$mois) { 
//    $db = db_connect();
//    $sql = "SELECT * FROM hors_frais WHERE idVisiteur = ? AND mois = ?", [$id, $mois];
//    $resultat = $db->query($sql, [$id,$mois]);
//    $resultat = $resultat->getResult();
//    return $resultat;
//    }


public function creationfrais($id,$mois,$idfraitforfait,$quantite) { 
    $db = db_connect();
    $sql = "INSERT INTO LigneFraisForfait (idVisiteur, mois, idFraisForfait, quantite) VALUES (?, ?, ?, ?)";
    $resultat = $db->query($sql, [$id,$mois,$idfraitforfait,$quantite]);
  //  $resultat = $resultat->getResult();
    return $resultat;
}
//=========================================================================
    // Fonction 4 : creationfichefrais
    // Crée une nouvelle fiche de frais pour un visiteur et un mois donnés.
    // Paramètres : $id (identifiant du visiteur), $mois, $etat, $montant
    //=========================================================================
public function creationfichefrais($id,$mois,$date) { 
    $db = db_connect();
    $sql = "INSERT INTO FicheFrais (idVisiteur, mois, nbJustificatifs, montantValide, dateModif, idEtat) VALUES (?, ?, 0, 0, ?, 'CR')";
    $resultat = $db->query($sql, [$id,$mois,$date]);
    //$resultat = $resultat->getResult();
    return $resultat;
}

public function creationfichehorsfrais($libelle, $date, $montant) { 
    $db = db_connect();
    $sql = "INSERT INTO LigneFraisHorsForfait (id, idVisiteur, mois , libelle, date, montant) VALUES (?, ?, ?, ?, ?, ?)";
    $resultat = $db->query($sql, [$libelle, $date, $montant]);
    //$resultat = $resultat->getResult();
    return $resultat;
}


public function getmois($mois_selectionne) { 
    $db = db_connect();
    $sql = "SELECT * FROM FicheFrais WHERE MONTH(date) = $mois_selectionne";
    $resultat = $db->query($sql, [$mois_selectionne]);
    $resultat = $resultat->getResult();
    return $resultat;
}
public function getall() { 
    $db = db_connect();
    $sql = "SELECT * FROM FicheFrais";
    $resultat = $db->query($sql);
    $resultat = $resultat->getResult();
    return $resultat;
}

public function getListeFdfAll() { 
    $db = db_connect();
    $sql = "SELECT * FROM fiches_de_frais";
    $resultat = $db->query($sql);
    $resultat = $resultat->getResult();
    return $resultat;
}

public function getListeFdfPartiel($mois) { 
    $db = db_connect();
    $sql = "SELECT * FROM fiches_de_frais WHERE MONTH(date) = $mois";
    $resultat = $db->query($sql);
    $resultat = $resultat->getResult();
    return $resultat;
}
public function lignefraisforfaisupdate($montant, $idfraisforfait, $mois, $idvisiteur) {
    $db = db_connect();
    $sql = "update lignefraisforfait set quantite=? where idFraisForfait=? and mois=? and idVisiteur=?";
    $resultat = $db->query($sql, [$montant, $idfraisforfait, $mois, $idvisiteur]);
    //$resultat = $resultat->getResult();
    return $resultat;

}
public function getlignefraishorsforfaisupdate($idvisiteur, $mois, $libelle, $date, $montant) {
    $db = db_connect();
    //$sql = "update lignefraishorsforfait set montant=? where id=? and mois=? and idVisiteur=?";
    $sql = "INSERT INTO LigneFraisHorsForfait(idVisiteur, mois, libelle, date, montant) VALUES (?, ?, ?, ?, ?)";
    $resultat = $db->query($sql,[$idvisiteur, $mois,$libelle, $date, $montant]);
    //$resultat = $resultat->getResult();
    return $resultat;
 //=========================================================================
    // Fonction 5 : consultation
    // Récupère les lignes de frais forfaitaires pour un visiteur et un mois donnés.
    // Paramètres : $mois, $idvisiteur
    // Renvoie les résultats sous forme d'objet.
    //=========================================================================
}
public function consultation($mois, $idvisiteur) {
    $db = db_connect();
    $sql = "SELECT * FROM LigneFraisForfait WHERE  mois=? and idVisiteur=?";
    $resultat = $db->query($sql,[$mois, $idvisiteur]);
    $resultat = $resultat->getResult();
    return $resultat;
}
//=========================================================================
    // Fonction 6 : consultationhorsforfait
    // Récupère les lignes de frais hors forfait pour un visiteur et un mois donnés.
    // Paramètres : $mois, $idvisiteur
    // Renvoie les résultats sous forme d'objet.
    //=========================================================================
public function consultationhorsforfait($mois, $idvisiteur) {
    $db = db_connect();
    $sql = "SELECT * FROM LigneFraisHorsForfait WHERE mois=? and idVisiteur=?";
    $resultat = $db->query($sql,[$mois, $idvisiteur]);
    $resultat = $resultat->getResult();
    return $resultat;
}
//=========================================================================
    // Fonction 7 : selectmois
    // Sélectionne les mois pour lesquels un visiteur a des fiches de frais.
    // Paramètre : $idvisiteur
    // Renvoie la liste des mois sous forme d'objet.
    //=========================================================================
public function selectmois($idvisiteur) {
    $db = db_connect();
    $sql = "SELECT mois FROM FicheFrais WHERE idVisiteur=?";
    $resultat = $db->query($sql,[$idvisiteur]);
    $resultat = $resultat->getResult();
    return $resultat;
}

//public function __construct($dsn, $user, $password) {
//    try {
//        $this->pdo = new PDO($dsn, $user, $password);
//        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    } catch (PDOException $e) {
//        die("Erreur de connexion : " . $e->getMessage());
//    }
//}

public function setVisiteurStatut($idVisiteur, $statut, $dateDebut, $dateFin = null) {
    try {
        $query = "EXEC SetVisiteurStatut ?, ?, ?, ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$idVisiteur, $statut, $dateDebut, $dateFin]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

}

?>
