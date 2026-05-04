<?php


if(isset($_POST['submitCreerCompte'])){
    
    $unNouvelAdherent = new Adherent();
    $unNouvelAdherent->setMail($_POST['mail']);
    $unNouvelAdherent->setMdp($_POST['mdp']);
    $unNouvelAdherent->setStatut('adherents');
    $unNouvelAdherent->setNomUtilisateur($_POST['nom']);
    $unNouvelAdherent->setPreomUtilisateur($_POST['prenom']);
    $reponse = AdherentDAO::inscriptionAdherent($unNouvelAdherent);
    $message = "";
    if($reponse == 'ok'){
        /*
         * Créer le bouton connexion
         */
        $message = 'Votre compte a été créé avec succés';
        $menuConnexion = new Menu('btnConnexion');
        $menuConnexion->ajouterComposant($menuConnexion->creerItemLien('Connexion', 'afficher'));
        $leMenuConnexion = $menuConnexion->creerMenu('0','demandeConnexion');
        
        $menuFermerConnexion = new Menu('fermerConnexion');
        $menuFermerConnexion->ajouterComposant($menuFermerConnexion->creerItemImage('annulerConnexion','fermer',''));
        $menuFermerConnexion->creerMenuImage('0', 'demandeDeconnexion');
        
        include_once 'vues/visiteurs/vueConfirmationInscription.php';
    }
}

if(isset($_GET['demandeInscription']) || (isset($_POST['submitCreerCompte'])&& $reponse == 'erreur')){
/*
 * Création du formulaire de connexion
 */
        $formulaireInscription = new Formulaire('post', 'index.php', 'fInscription', 'fInscription');
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerTitre('Je crée mon compte'));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Prénom'));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('prenom', 'prenom', '', 1, '', ''));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Nom :'));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('nom', 'nom', '', 1, '', ''));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('E-mail :'));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('mail', 'mail', '', 1, '', ''));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Confirmation de le-mail :'));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputTexte('confMail', 'confMail', '', 1, '', ''));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerLabel('Mot de Passe :'));
        $formulaireInscription->ajouterComposantTab();
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerInputMdp('mdp', 'mdp',  1, '', ''));
        $formulaireInscription->ajouterComposantTab();
        
        $formulaireInscription->ajouterComposantLigne($formulaireInscription-> creerInputSubmit('submitCreerCompte', 'submitCreerCompte', 'Créer un compte'));
        $formulaireInscription->ajouterComposantTab();
        
        $formulaireInscription->ajouterComposantLigne($formulaireInscription->creerMessage(''));
        $formulaireInscription->ajouterComposantTab();
        
        $formulaireInscription->creerFormulaire();
        
        $menuFermerConnexion = new Menu('fermerConnexion');
        $menuFermerConnexion->ajouterComposant($menuFermerConnexion->creerItemImage('deconnexion','fermer',''));
        $menuFermerConnexion->creerMenuImage('0', 'demandeDeconnexion');
        
        include_once 'vues/visiteurs/vueInscription.php';

}

    
 


