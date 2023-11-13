<?php
include('include/autoloader.php');

//  Variable de comparaison
$Msg_Error = '';


/*  On test si il y a une entrée illégal dans la page Erreur */
if (!isset($_GET['Error'])){
    //  Si il n'y a pas érreur dans l'Url c'est qui y a appel illégal
    $Msg_Error = 'l\'ouverture de cette page en directement est illégal';
} else {
    $Msg_Error = $_GET['Error'];
}

$Viewer = new Viewer();
?>

<!DOCTYPE html>

<html lang="fr">
    <?php $Viewer -> ViewHead('Error'); ?>
    
    <body>
        <?php $Viewer -> ViewHeader('Error'); ?>

        <div class="wallpaper wallPages">
            <div class="page page-active" id="page5">
                <section id="page-Error">
                    <h1>Erreur !</h1>
                    <?php
                    /*  Affichage de l'erreur   */
                    echo $Msg_Error.' !';
                    unset($_GET['Error']);
                    ?>
                </section>
            </div>
        </div>

        <?php $Viewer -> ViewFooter('Error'); ?>
    </body>
</html>