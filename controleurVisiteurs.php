<?php



/*
 * Charger la liste des producteurs et de leurs produits 
 */
$_SESSION['listeProducteurs'] = new Producteurs(ProducteurDAO::lesProducteurs());



/*
 * Créer une liste des producteurs pour affichage
 */
$lesProducteurs = new Liste("producteurs");

foreach ($_SESSION['listeProducteurs']->getProducteurs() as $unProducteur){
    
    $lesProducteurs->ajouterComposant($lesProducteurs->unProducteur($unProducteur));
  
   //$lesProducteurs->ajouterComposant("<details>");
  // $lesProducteurs->ajouterComposant("<summary>Les produits de ce producteur</summary>");


    $lesProducteurs->ajouterComposant("<div class='produits hidden' id ='". $unProducteur->getIdProducteur() ."'>");
   foreach($unProducteur->getLesProduits()  as $unProduit){
        $lesProducteurs->ajouterComposant($lesProducteurs->unProduit($unProduit)); 
    }
   $lesProducteurs->ajouterComposant("</div>");
   //$lesProducteurs->ajouterComposant("</details>");
   
}
    $lesProducteurs->ajouterTitreListe("Les producteurs de nos régions.");
    $laListeProducteurs = $lesProducteurs->creerListe();

/*
 * Cr�er le bouton connexion
 */
$menuConnexion = new Menu('btnConnexion');
$menuConnexion->ajouterComposant($menuConnexion->creerItemLien('Connexion', 'connexion'));
$leMenuConnexion = $menuConnexion->creerMenu('0','demandeConnexion');

include_once 'vues/visiteurs/vueVisiteur.php';