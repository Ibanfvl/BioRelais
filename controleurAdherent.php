<?php


// Placer dans une variable de session le nom du menu sélectionné

if(isset($_GET['menuAdherents']))
{
    $_SESSION['menuAdherents'] =   $_GET['menuAdherents'];
}

// si aucun item du menu selectionné choisir l'item par défaut
if (!isset($_SESSION['menuAdherents'])){
    $_SESSION['menuAdherents'] =  'adherentsAchats';
}
 
 
//CrÃ©er le menu des adhÃ©rents

$menuAdherents = new Menu('menuBioRelai');
$menuAdherents->ajouterComposant($menuAdherents->creerItemLien('Achats', 'adherentsAchats'));
$menuAdherents->ajouterComposant($menuAdherents->creerItemLien('Panier', 'adherentsPanier'));
$menuAdherents->ajouterComposant($menuAdherents->creerItemLien('Factures', 'adherentsFactures'));
$menuAdherents->ajouterComposant($menuAdherents->creerItemLien('Mon compte', 'adherentsMonCompte'));
$menuAdherents->ajouterComposant($menuAdherents->creerItemLien('Deconnexion', 'deconnexion'));
$menuAdherents->creerMenu( $_SESSION['menuAdherents'],'menuAdherents');


/***********************************************************************
 * Appel du controleur sélectionné
 ***********************************************************************/
include_once dispatcher::dispatch($_SESSION['menuAdherents']);


