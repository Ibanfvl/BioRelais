<?php



// Placer dans une variable de session le nom du menu s�lectionné

if(isset($_GET['menuBioRelai']))
{
    $_SESSION['menuBioRelai'] =   $_GET['menuBioRelai'];
}

// si aucun �l�ment du menu s�lectionné choisir l'item par d�faut
if (!isset($_SESSION['menuBioRelai'])){
    $_SESSION['menuBioRelai'] =  'bioRelaiProducteurs';
}




//Créer le menu BioRelaiAdmin
$menuBioRelai = new Menu('menuBioRelai');
$menuBioRelai->ajouterComposant($menuBioRelai->creerItemLien('Producteurs', 'bioRelaiProducteurs'));
$menuBioRelai->ajouterComposant($menuBioRelai->creerItemLien('Ventes', 'bioRelaiVentes'));
$menuBioRelai->ajouterComposant($menuBioRelai->creerItemLien('Factures', 'bioRelaiFactures'));
$menuBioRelai->ajouterComposant($menuBioRelai->creerItemLien('Deconnexion', 'deconnexion'));
$menuBioRelai->creerMenu( $_SESSION['menuBioRelai'],'menuBioRelai');


/***********************************************************************
 * Appel du controleur s�lectionn�
 ***********************************************************************/
include_once dispatcher::dispatch($_SESSION['menuBioRelai']);
