<?php
session_start();

$NomUser    = $_SESSION['username'];
$PrenomUser = $_SESSION['usersurname'];

include('include/cnx.php');
include('include/autoloader.php');

//  Variable pour l'affichage des Images
$categorie  = 1;    //  la Catégorie
$CatMax     = 1;    //  Categorie Maximum
$debut      = 1;    //  l'image de début
$nbrImg     = 12;   //  Nombre d'images à afficher
$nbrAllImg  = 1;    //  Nombre total d'image dans la table
$nbrTemp    = 1;    //  Nombre de template dans la table
$nbrPages   = 1;    //  Nombre total de pages
$curentPage = 1;    //  Page courante
$isSelect   = 0;    //  Test si une image est selectionner
$isFavorite = 0;    //  Test si il y a des Images Favorites

//  Appel des classes 
$TemplateManager = new TemplateManager($cnx);
$CategorieManager = new CategorieManager($cnx);
$contactManager = new ContactManager($cnx);
$FavoriteManager = new FavoriteManager($cnx);

$contact = new Contact();
$contact -> setNom($NomUser);
$contact -> setPrenom($PrenomUser);


if (!$contactManager -> FindContact($contact)){
    // si il ne trouve pas le même nom et prénom il insert ce nom
    $contact -> setDateCreate(date('Y-m-d'));
    $contact -> setIsTemporaire(1);
    $contactManager -> CreateContact($contact);
}

//  Appel du numero de categorie
if(isset($_GET['categorie'])){
    $categorie = $_GET['categorie'];
    if (!is_numeric($categorie)){
        header('Location:error.php?Error=la catégorie de la page doit être un entier Positif');
    }
} else {
    $categorie = 1;
}

$dataCategorie = $CategorieManager -> readMaxCategorie();
if ($categorie > $dataCategorie -> getMaxCat()){
    header('Location:error.php?Error=la catégorie de la page doit être inférieur au nombre de catégorie demandée');
}

$template = $TemplateManager -> ReadNbrTemplateforCategorie($categorie);
$nbrPages = ceil($template -> getNbrImg() / $nbrImg);

//  Appel du numéro de la page actuel
if(isset($_GET['page'])){
    $curentPage = $_GET['page'];
    if (!is_numeric($curentPage)){
        header('Location:error.php?Error=le numéro de la page doit être un entier Positif');
    }
}

if ($curentPage > $nbrPages){
    header('Location:error.php?Error=le numéro de la page doit être inférieur au nombre de page demandée');
}

//  Recherche d'une image selectionner
if (isset($_GET['imgselect'])){
    $templateData = $TemplateManager -> ReadNbrTemplates();
    $nbrAllImg = $templateData -> getNbrImg();
    $imgGet = $_GET['imgselect'];

    if (!is_numeric($imgGet)){
        header('Location:error.php?Error=le numéro de l\'image doit être un entier Positif');
    }

    if ($imgGet > $nbrAllImg){
        header('Location:error.php?Error=le numéro de l\'image doit être inférieur au nombre d\'élément présent dans la table');
    }
    
    $isSelect = 1;
    $imgSelect = $TemplateManager -> ReadTemplate($_GET['imgselect']);
    $curentPage = 1;
    $categorie = $imgSelect -> getCatTemp();
}


//  Recherche d'une Image en Favorite
if (isset($_GET['favorite'])){
    $isFavorite = $_GET['favorite'];
    if (!is_numeric($isFavorite)){
        header('Location:error.php?Error=le Favorie de l\'image doit être 1 (TRUE) ou 0 (FALSE)');
    }

    if ($isFavorite < 0 || $isFavorite > 1){
        $isFavorite = 0;
        $_GET['favorite'] = 0;
    }

    //  Entrée les valeurs d'insertion Favorite
    $contactID = $contactManager -> ReadContactForName($NomUser, $PrenomUser);
    $Favorite = new Favorite();

    $Favorite -> setTempID($imgSelect -> getTempId());
    $Favorite -> setCatTemp($categorie);
    $Favorite -> setContactID($contactID);
    $Favorite -> setFavoriteValue($isFavorite);

    if($FavoriteManager -> FindFavorite($imgSelect -> getTempId(), $contactID)){
        $FavoriteManager -> UpdateFavorite($Favorite);
    } else {
        $FavoriteManager -> CreateFavorite($Favorite);
    }
}

//  debut de la première image selon la page
$debut = ($curentPage - 1) * $nbrImg;

$templates = $TemplateManager -> ReadAllTemplateforCategorie($categorie, $debut, $nbrImg);

$Viewer = new Viewer();
?>

<html lang="fr">
    <?php $Viewer -> ViewHead('Galery'); /* Ajout - Titre de Limage */ ?>

    <body>
        <?php $Viewer -> ViewHeader('Galery'); ?>

        <div class="wallpaper wallPages">

            <?php
            /*  *******************************************  */
            /*  ********** Système de Pagination **********  */
            /*  *******************************************  */

            echo '
            <div class="btn-page">';
                /*  *********************************************************  */
                /*  ********** Afichage des Bouttons de navigation **********  */
                /*  *********************************************************  */
                //  Boutton Preview
                if ($curentPage > 1 && $nbrPages > 1){
                    echo '<a href="?page='.($curentPage - 1).'&categorie='.$categorie.'" class="btnHeight btnWidth btnhover prev"></a>';
                } else {
                    echo '<div class="btnHeight btnWidth btnInnactif"></div>';
                }

                //  Page Courent
                echo '
                <div class="btnHeight view-page">
                    Page : '.$curentPage.'
                </div>';

                //  Boutton Next
                if ($curentPage != $nbrPages && $nbrPages > 1){
                    echo '<a href="?page='.($curentPage + 1).'&categorie='.$categorie.'" class="btnHeight btnWidth btnhover next"></a>';
                } else {
                    echo '<div class="btnHeight btnWidth btnInnactif"></div>';
                }
            echo '
            </div>';

            //  Find Catégorie
            $dataCategories = $CategorieManager -> ReadTotalCategorie();
            echo '
            <form action="" method="get" class="sel">
                <select name="categorie">';
                    $i = 1;
                    foreach($dataCategories as $dataCategorie){
                        if ($i == $categorie){
                            $Selected ='selected="selected"';
                        } else {
                            $Selected ='';
                        }

                        echo '
                        <option '.$Selected.' value="'.$dataCategorie -> getCatTemp().'">
                            '.$dataCategorie -> getCatNom().'
                        </option>';

                        $i++;
                    }

                echo'
                </select>

                <input type="submit" >
            </form>';
            ?>

            <div class="page page-active" id="page3">
                <section id="page-galery">

                    <?php
                    /*  ********************************************  */
                    /*  ********** Affichage de la Galery **********  */
                    /*  ********************************************  */
                    $contactID = $contactManager -> ReadContactForName($NomUser, $PrenomUser);
                    
                    foreach($templates as $template){
                        
                        echo'
                        <div class="img-galery">';
                            /*  ****************************************************  */
                            /*  ********** Test si une image est Favorite **********  */
                            /*  ****************************************************  */
                            /* Test si une image est Favorite ou non */
                            
                            if ( $FavoriteManager -> FindFavoriteUser($contactID) ) {  
                                if ($FavoriteManager -> ReadFavoriteValue($template -> getTempId(), $contactID)) {
                                    echo '<div class="MiniFavorite"></div>';
                                }
                            }

                            /*  ******************************************  */
                            /*  ********** Affichage des Images **********  */
                            /*  ******************************************  */
                        echo '
                            <a href="galery.php?categorie='.$template -> getCatTemp().'&imgselect='.$template -> getTempId().'" title=">  '.$template -> getTitle().'  <">
                                <img src="img/galery/'.$template -> getUrlImg().'.jpg" alt="'.$template -> getAltImg().'">
                            </a>
                        </div>';
                    }
                    ?>

                    <?php
                    //  Test si la fenêtre Modal s'affiche ou non
                    if ($isSelect){
                        $ViewModal = 'viewModal';
                        //  Test la Valeur isFavorite
                        $isFavorite = $FavoriteManager -> ReadFavoriteValue($imgSelect -> getTempId(), $contactID);

                    } else {
                        $ViewModal = 'hiddenModal';
                    }

                    if ($isFavorite > 0){
                        //  Test si l'image est un favorie on met un coeur plein
                        $Coeur = 'coeur2';
                    } else {
                        $Coeur = 'coeur1';
                    }
                    ?>

                    <!-- Fenêtre Modal -->
                    <div class="<?= $ViewModal; ?> modal">
                        <div class="modal-content">
                        <h2><?= $imgSelect -> getTitle();?></h2>
                            <!-- Affiche La Favorie ou non -->
                            <a href="<?= "galery.php?categorie=".$imgSelect -> getCatTemp()."&imgselect=".$imgSelect -> getTempId()."&favorite=".($isFavorite + 1); ?>">
                                <div class="coeur <?= $Coeur; ?>"></div>
                            </a>

                            <!-- Affiche l'Image de dans la fenêtre Modal -->
                            <div id="insert-img">
                                <a href="<?= $imgSelect -> getUrlTemp(); ?>" target="_blank" title="<?= $imgSelect -> getCaption(); ?>">
                                    <img src="img/galery/<?= $imgSelect -> getUrlImg(); ?>.jpg" alt="<?= $imgSelect -> getAltImg(); ?>">
                                </a>
                            </div>

                            <!-- Description de l'image dans la Fenêtre Modal -->
                            <div class="model-des-content">
                                <div class="Modal-description">
                                    <strong>Descrition :</strong>
                                    <div class="sep"></div>
                                    <p><?= $imgSelect -> getDescription(); ?></p>
                                    <div class="sep"></div><hr><div class="sep"></div><div class="sep"></div>

                                    <?php $DateAjout = new DateAjout($imgSelect -> getAjoutDay()); ?>
                                    <strong>Date d'insertion :</strong>
                                    <div class="sep"></div>

                                    <?=
                                    '&nbsp; &nbsp; '.$DateAjout -> getLastDay(true).' '.$DateAjout -> getLastMonth(true).' '
                                    .$DateAjout -> getLastYear().'<br>&nbsp; &nbsp; &nbsp; &nbsp; à: '.$DateAjout -> getLastHour().' H '.
                                    $DateAjout -> getLastMinute().':'.$DateAjout -> getLastSec();
                                    $catNom = $CategorieManager -> ReadLastCategorie($categorie);
                                    ?>
                                </div>
                            </div>

                            <!-- Affichage du Thème de l'image -->
                            <div class="theme"><b>Thème : </b><?= $catNom -> getCatNom(); ?></div>

                            <?php
                            //  Boutton Image Précédente
                            if ($imgSelect -> getTempId() > 1){
                                echo '
                                <div class="imgPrev imgBtn">
                                    <div class="imgPrevNext" title="Image Précédente">';
                                    ?>
                                        <a href=<?= "galery.php?imgselect=".($imgSelect -> getTempId() - 1); ?>></a>
                                    <?= '
                                    </div>
                                </div>';
                            }
                            ?>

                            
                            <?php
                            //  Boutton Image Suivante
                            if ($imgSelect -> getTempId() < $nbrAllImg){
                                echo '
                                <div class="imgNext imgBtn">
                                    <div class="imgPrevNext" title="Image Suivante">';
                                    ?>
                                        <a href=<?= "galery.php?imgselect=".($imgSelect -> getTempId() + 1); ?>></a>
                                    <?= '
                                    </div>
                                </div>';
                            }
                            ?>

                            <a id="modal-close" href=<?= "galery.php?categorie=".$imgSelect -> getCatTemp(); ?>>&times;</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php $Viewer -> ViewFooter('Galery'); ?>
    </body>
</html>