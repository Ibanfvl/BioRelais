<?php





/***********************************************************************
 * Vérification de la connexion (login + mdp)
 * indentification de l'utilisateur connecté (nom + prénom) statut conservés dans une variable de session.
 * par défaut le statut est visiteur.
 * Appel du controleur correspondant au statut.
*********************************************************************** */
if(isset($_POST['login'])){
    $unUtilisateur = new Utilisateur(null , $_POST['login'] , $_POST['mdp']);
    $_SESSION['identification'] = utilisateurDAO::verification($unUtilisateur);
    $_SESSION['controleurP2'] =   $_SESSION['identification']['statut'];
   /******************************************************************
    * Erreur de connexion
    * Affichage du message d'erreur
    ******************************************************************/
    if(!$_SESSION['identification']){
        $_SESSION['controleurP2']= "connexion";
        $messageErreurConnexion = 'Login ou mot de passe incorrect  !';
    }

}
else if(!isset( $_SESSION['identification'])){
    $_SESSION['identification']['statut']= "visiteurs";
    $_SESSION['controleurP2'] =   $_SESSION['identification']['statut'];
    $_SESSION['identification']['nom']= null;
    $_SESSION['identification']['prenom']= null;
    $_SESSION['identification']['login']= null;
}


/*****************************************************************
 * Appel des controleurs de connexion et d'insciption.
 *****************************************************************/
//Demande de connexion
else if(isset($_GET['demandeConnexion'])){
    $messageErreurConnexion = '';
    $_SESSION['controleurP2']= "connexion";
}

//Demande d'inscription
else if(isset($_GET['demandeInscription'])){
    $_SESSION['controleurP2']= "inscription";
}



/**************************************************************************
 * Gestion des demandes de déconnexion.
 * Retour au statut visiteur - controleur visiteurs
 **************************************************************************/
else if(isset($_GET['demandeDeconnexion'])  
|| (isset($_GET['menuProducteurs']) && $_GET['menuProducteurs']=='deconnexion')
|| (isset($_GET['menuAdherents']) && $_GET['menuAdherents']=='deconnexion')
|| (isset($_GET['menuBioRelai']) && $_GET['menuBioRelai']=='deconnexion')
){
    $_SESSION['identification']['statut']= "visiteurs";
    $_SESSION['identification']['nom']= null;
    $_SESSION['identification']['prenom']= null;
    $_SESSION['identification']['login']= null;
    $_SESSION['controleurP2'] =   $_SESSION['identification']['statut'];
}



/***********************************************************************
 * Appel du controleur sélectionné
 ***********************************************************************/

include_once dispatcher::dispatch($_SESSION['controleurP2']);




    