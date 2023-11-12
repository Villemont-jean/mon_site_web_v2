<?php
include('include/cnx.php');
include('include/autoloader.php');

$Viewer = new Viewer();
?>

<!DOCTYPE html>

<html lang="fr">
    <?php $Viewer -> ViewHead('About'); ?>

    <body>
        <?php $Viewer -> ViewHeader('About'); ?>

        <div class="wallpaper wallPages">
            <div class="page page-active" id="page2">
                <section id="page-about">
                    <h2>À PROPOS DE MOI</h2>

                    <p>
                        Je m'appelle Jean, je suis le créateurs de l’agence WLKJ GEEK:<br>

                        <div id="prof">
                            <div id="prof-content">
                                <strong>créateur de site internet</strong>,<br>
                                <strong>créateur de jeu vidéo 2D & 3D</strong>,<br>
                                <strong>animateur 3D</strong>,<br>
                                <strong>Créateur d'objets 3D</strong>.<br>
                                <strong>créateur de site internet</strong>,<br>
                            </div>
                        </div>
                    </p>

                    <p>
                        <span></span>Dans les année 80, j'ai développé une passion pour la progammation avec <em>Amstrad CPC 464, puis 6128</em>
                        , au cours de mes expériences professionnelles divers.  j'ai pu apprendre davantage de langage informatique divers en autodidacte
                    </p>

                    <p><span></span>j'ai alors décidé il ya peu de m'investir pour devenir web designer, mon but est simple: mettre en avant mon savoir et mes connaissances à votre services</p>

                    <p><span></span>En réalité, ce n’est pas seulement un site internet que je vous propose. C’est votre meilleur outil pour vous démarquer des autres</p>

                    <p><span></span>Et je compte bien vous <a href="contact.php" id="link-contact">le montrer !</a></p>
                </section>

                <section id="competences">
                    <hr>
                    <h3>Mes compétences acquises</h3>

                    <?php
                    /* ******************************** */
                    /*                                  */
                    /*     Couleur des Compétances      */
                    /*                                  */
                    /* ******************************** */
                    //  --ClrGreen: #04FC43;
                    //  --clrOrange: #FC4304;
                    //  --clrRed:  #FC0443;

                    $compCat = new CompCategorieManager($cnx);
                    $competance = new CompetanceManager($cnx);

                    $categories = $compCat -> ReadCompetanceCategorie();

                    foreach($categories As $categorie){
                        echo
                        '<h3>'.$categorie -> getGroupNom().'</h3>
                        
                        <div class="cmp">';

                        foreach($competance -> ReadCompetanceForCategorie($categorie -> getCatComp()) as $comp){
                            echo 
                            '<p>
                                <strong>'.$comp -> getNom().' :</strong>
                                <em>';

                                $color = '#FC4304';
                                if($comp -> getComp() < 33){ $color = '#FC0443'; }
                                if($comp -> getComp() > 67){ $color = '#04FC43'; }

                                echo
                                    '<span style="color: '.$color.'">'.$comp -> getComp().'%</span>
                                    <svg id="'.$comp -> getAbs().'" style="--pour-cent: '.$competance -> PouCentCompetance($comp -> getComp()).'; --clr-web: '.$color.';">
                                        <circle cx="34" cy="34" r="34"></circle>
                                        <circle cx="34" cy="34" r="34"></circle>
                                    </svg>
                                </em>
                            </p>';
                        }

                        echo
                        '</div>';
                    }
                    ?>
                </section>
            </div>
        </div>

        <?php $Viewer -> ViewFooter('About'); ?>
    </body>
</html>