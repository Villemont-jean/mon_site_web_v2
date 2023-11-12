<?php
session_start();

include('include/cnx.php');
include('include/autoloader.php');

if (!isset($_SESSION['username'])){
    $NomUser = 'Favorite_'.sha1(time() * mt_rand());
    $PrenomUser = $NomUser;

    $_SESSION['username'] = $NomUser;
    $_SESSION['usersurname'] = $PrenomUser;

    $contactTemp = new ContactManager($cnx);
    $user = new Contact();
    
    $user -> setNom($NomUser);
    $user -> setPrenom($PrenomUser);
    $user -> setDateCreate(date('Y-m-d'));
    $user -> setIsTemporaire(1);
    
    $contactTemp -> CreateContact($user);
}

$TemplateManager = new TemplateManager($cnx);
$CategorieManager = new CategorieManager($cnx);

//  Déclarer les tableaux
$slID  = array();
$slUrl = array();
$slAlt = array();
$slCap = array();
$slTem = array();

$Viewer = new Viewer();
?>

<!DOCTYPE html>

<html lang="fr">
    <?php $Viewer -> ViewHead('Home'); ?>
    
    <body>
        <?php $Viewer -> ViewHeader('Home'); ?>

        <div class="wallpaper wallPages">
            <div class="page page-active" id="page1">
                <section id="welcome">
                    <h2>Bienvenue sur notre site</h2>
                    <div class="p">
                        <div class="rotate">F</div>

                        <p>
                            aites le choix d’une <strong>entreprise à taille humaine</strong>.<br>
                            Au-delà de la <strong></strong>création de sites</strong>, je souhaite accompagner
                            les petites entreprises à <strong>développer</strong> leur activité sur le Web.
                        </p>
                    </div>
                    
                    <div class="p">
                        <div class="rotate">J</div>

                        <p>
                            e ne propose pas simplement un design ou encore de la technique. Je veux
                            avant tout épauler les entrepreneurs et être le témoin de leur réussite.
                        </p>
                    </div>
                    
                    <div class="p">
                        <div class="rotate">A</div>

                        <p>
                            fin de faciliter l’accès à des <strong>sites internet professionnels
                            </strong> pour les entreprises locales, je vous propose de vous acompagnez
                            pour que votre <strong>site web</strong> vous corresponds.
                        </p>
                    </div>
                    
                    <a href="about.php" class="btn-plus" id="welcom-plus">En Savoir Plus !</a>
                </section>

                <section id="slide">
                    <div class="slide-content">
                        <div class="slider">
                            <?php
                            //  Afficher 4 Images Aléatoire
                            $lesTemplates = $TemplateManager -> ReadAleatoirTemplate();

                            $i = 0;
                            foreach($lesTemplates as $leTemplate){
                                $slID[$i]  = $leTemplate -> getTempId();
                                $slUrl[$i] = $leTemplate -> getUrlImg();
                                $slAlt[$i] = $leTemplate -> getAltImg();
                                $slCap[$i] = $leTemplate -> getCaption();
                                $slTem[$i] = $leTemplate -> getCatTemp();
                                $i++;
                            }

                            for ($i=0; $i<4; $i++){
                                echo
                                '<a href="galery.php?categorie='.$slTem[$i].'&imgselect='.$slID[$i].'">
                                    <figure id="img-'.$slID[$i].'">
                                        <img src="img/galery/'.$slUrl[$i].'.jpg" alt="'.$slAlt[$i].'">
            
                                        <figcaption>'.$slCap[$i].'</figcaption>
            
                                        <!--script>var slideImg="Slide'.$slID[$i].'"</script-->
                                    </figure>
                                </a>';
                            }
                            
                            echo
                            '<a href="galery.php?imgselect='.$slID[0].'">
                                <figure id="img-'.$slID[0].'">
                                    <img src="img/galery/'.$slUrl[0].'.jpg" alt="'.$slAlt[0].'">

                                    <figcaption>'.$slCap[0].'</figcaption>

                                    <!--script>var slideImg="Slide'.$slID[0].'"</script-->
                                </figure>
                            </a>';
                            ?>
                        </div>
                    </div>
                </section>

                <section id="last-content">
                    <article id="last-content-img">
                        <h2>Dernier ajout ...</h2>
                        <?php
                        //  Afficher le dernier élément de la table
                        $lastTemplate = $TemplateManager -> ReadLastTemplate();
                        $DateAjout = new DateAjout($lastTemplate -> getAjoutDay());
                        $lastCategorie = $CategorieManager -> ReadLastCategorie($lastTemplate -> getCatTemp());
                        ?>

                        <a href="galery.php?categorie=<?= $lastTemplate -> getCatTemp(); ?>&imgselect=<?= $lastTemplate -> getTempId(); ?>">
                            <figure id="img-last">
                                <img src="img/galery/<?= $lastTemplate -> getUrlImg(); ?>.jpg" alt="<?= $lastTemplate -> getAltImg() ?>">
                            
                                <figcaption>Dernier Ajout le <?= $DateAjout -> getLastDay(false); ?>/<?= $DateAjout -> getLastMonth(false); ?>/<?= $DateAjout -> getLastYear(); ?></figcaption>
                            </figure>
                        </a>
                    </article>
                    
                    <article id="last-description-content">
                        <h2>Catégorie : <em><?= $lastCategorie -> getCatNom(); ?></em></h2>
                        <h3>*** > <?= $lastTemplate -> getTitle(); ?> < ***</h3>

                        <p class="date">
                            <?=
                            'Date : <em>'.$DateAjout -> getLastDay(true).' '.$DateAjout -> getLastMonth(true).' '.$DateAjout -> getLastYear().'</em>
                            <br>Time : <em>'.$DateAjout -> getLastHour().'H '.$DateAjout -> getLastMinute().'</em>';
                            ?>
                        </p>
                        <p class="last-description"><strong>Descrition : </strong> <?= $lastTemplate -> getDescription(); ?></p>
                        
                        <div id="last-content-link">
                        <a href="galery.php?categorie=<?= $lastTemplate -> getCatTemp(); ?>&imgselect=<?= $lastTemplate -> getTempId(); ?>" id="last">En savoir Plus !</a>
                        </div>
                    </article>
                </section>
            </div>
        </div>

        <?php $Viewer -> ViewFooter('Home'); ?>
    </body>
</html>




