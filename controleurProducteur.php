<?php




// Placer dans une variable de session le nom du menu sélectionné

if(isset($_GET['menuProducteurs']))
{
    $_SESSION['menuProducteurs'] =   $_GET['menuProducteurs'];
}

// si aucun élément du menu sélectionné choisir l'item par défaut
if (!isset($_SESSION['menuProducteurs'])){
    $_SESSION['menuProducteurs'] =  'producteursProduits';
}

//Créer le menu BioRelai
$menuProducteurs = new Menu('menuBioRelai');
$menuProducteurs->ajouterComposant($menuProducteurs->creerItemLien('Produits', 'producteursProduits'));
$menuProducteurs->ajouterComposant($menuProducteurs->creerItemLien('Ventes', 'producteursVentes'));
$menuProducteurs->ajouterComposant($menuProducteurs->creerItemLien('Factures', 'producteursFactures'));
$menuProducteurs->ajouterComposant($menuProducteurs->creerItemLien('Deconnexion', 'deconnexion'));
$menuProducteurs->creerMenu(  $_SESSION['menuProducteurs'] ,'menuProducteurs');



/***********************************************************************
 * Appel du controleur sélectionné
 ***********************************************************************/
include_once dispatcher::dispatch($_SESSION['menuProducteurs']);


