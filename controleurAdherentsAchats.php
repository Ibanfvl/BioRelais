<?php

/***************************************************************************************************************
 *
 * Charger la vente active
 *
 * **************************************************************************************************************/
$vente = new Vente(1);


/***************************************************************************************************************
 * 
 * Charger la liste des catégories de produits avec les produits correspondants
 * 
 * **************************************************************************************************************/
$_SESSION['lesCategoriesAvecProduits'] = new Categories(CategorieDAO::lesCategoriesAvecProduitsVente($vente));
  



/***************************************************************************************************************
 *
 * Définir la catégorie active
 *
 * **************************************************************************************************************/

if(isset($_GET['categorie'])){
    $_SESSION['idCategorieActive']=$_GET['categorie'];
}
else if (!isset($_SESSION['idCategorieActive'])){
    $_SESSION['idCategorieActive'] = '1';
}




/***************************************************************************************************************
 *
 * Créer le menu liste des catégories 
 *
 * **************************************************************************************************************/

$menuCategories = new menu('menuCategories');

foreach($_SESSION['lesCategoriesAvecProduits']->geCategories()  as $categorie){   
    $menuCategories->ajouterComposant($menuCategories->creerItemLien($categorie->getNomCategorie(),$categorie->getIdCategorie()));  
}

$menuCategories->creerMenu($_SESSION['idCategorieActive'],'categorie');



/***************************************************************************************************************
 *
 * Créer le menu liste des produits
 *
 * **************************************************************************************************************/

if( $_SESSION['idCategorieActive'] != '1'){
    
    $categorieActive = $_SESSION['lesCategoriesAvecProduits']->chercheCategorie($_SESSION['idCategorieActive']);
    
   
    $listeProduits = new Liste('listeProduits');
    
    foreach($categorieActive->getLesProduits() as $produit){
        $listeProduits->ajouterComposant($listeProduits->unProduitAchat($produit));
    }
    
    $listeProduits->creerListe();
}



include_once 'vues/adherents/vueAdherentsAchats.php';