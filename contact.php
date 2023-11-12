<?php
session_start();

include('include/cnx.php');
include('include/autoloader.php');

//  appel des class utiliser
$formulaire = new Formulaire();
$contact = new Contact();
$contactManager = new ContactManager($cnx);

//  Variables Initial
$msgNom   =    '';  //  error ou access ou vide pour le nom
$msgMail  =    '';  //  error ou access ou vide pour l'adresse mail
$msgcom   =    '';  //  error ou access ou vide pour le commentaire

$nom      =    '';  //  Nom entrée dans le champ Name
$prenom   =    '';  //  Prénom entrée dans le champ Surname
$email    =    '';  //  email entrée dans le champ Email

$favorite = false;  //  True ou False pour afficher les favories
$choise   = false;  //  Choix du favories dans le formulaire

$com      =    '';  //  Commentaire qui se trouve dans le champ commentaire

$error    = true;   //  Variable de test d'erreru
$access   = false;  //  Variable de test d'access

//  Créer un nouveau contact
if (isset($_SESSION['username'])){
    //  Entrée les valeurs nom et prénom de l'user temporaire
    $contact -> setNom($_SESSION['username']);
    $contact -> setPrenom($_SESSION['usersurname']);
    
    //  Recheche si il existe
    if ($contactManager -> FindContact($contact)){
        $ContactID = $contactManager -> ReadContactForName($contact -> getNom(), $contact -> getPrenom());
        $contact = $contactManager -> ReadContact($ContactID);
        $contact -> setContactId($ContactID);
        //  recherche 
        if ($contactManager -> FindFavorite($ContactID) > 0){
            $favorite = true;
        }

        if ($contact -> getIsTemporaire()) {
            $userTemporaire = $contact;
        }
    }
}

//  Variable pour la page Contact
$ico = 'mail';
if (isset($_GET['ico'])){
    if (!is_string($_GET['ico'])){
        header('Location:error.php?Error=l\'appel de la page doit être une chaîne de caractère valide');
    }
    $ico = $_GET['ico'];
}

$Viewer = new Viewer();
?>

<!DOCTYPE html>

<html lang="fr">
    <?php $Viewer -> ViewHead('Contact'); ?>

    <body>
        <?php $Viewer -> ViewHeader('Contact'); ?>

        <div class="wallpaper wallPages">
            <div class="page page-active" id="page4">
                <section id="form">
                    <div id="contact">
                        <div id="icons">
                            <?php $formulaire -> ViewIco($ico); ?>
                        </div>

                        <form id="formu" action="" method="post">
                            <fieldset>
                                <legend>Votre Demande !</legend>

                                <?php
                                //  Test les champs 
                                if (isset($_POST['submit'])){
                                    //  Appel de la class contact et contactManager
                                    $contact = new Contact();
                                    $contactManager = new ContactManager($cnx);

                                    //  Donner des valeur par défaut si on a cliker sur Submit
                                    $msgNom   = 'error';
                                    $msgMail  = 'error';
                                    $msgcom   = 'error';

                                    //  Test si nom entrée
                                    if (!empty($_POST['name'])){
                                        $msgNom = 'access';
                                        $nom = htmlspecialchars($_POST['name']);
                                        $error = false;
                                    }

                                    //  Test si prénom entrée
                                    if (!empty($_POST['surname'])){
                                        $prenom = htmlspecialchars($_POST['surname']);
                                    }

                                    //  Test si adresse mail entrée
                                    if (!empty($_POST['email'])){
                                        $email = htmlspecialchars($_POST['email']);
                                        //  Test si email valide
                                        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                                            $msgMail = 'access';
                                            $error = false;
                                        }
                                    }

                                    // Choix de l'utilisateur sur les favorie
                                    if (!empty($_POST['favorite'])){
                                        if($_POST['favorite'] == 'oui'){
                                            $choise = true;
                                        }
                                    }

                                    if (!empty($_POST['com'])){
                                        $com = htmlspecialchars($_POST['com']);
                                        $msgcom = 'access';
                                    }

                                    //  Test si tous est bon?
                                    if ($msgNom == 'access' && $msgMail == 'access' && $msgcom   = 'access'){
                                        $error = false;
                                    }

                                    if (!$error){
                                        //  entrée du nom dans contact
                                        $contact -> setNom($nom);
                                        $contact -> setPrenom($prenom);
                                        $contact -> setMail($email);
                                        $contact -> setDateCreate(date('Y-m-d'));

                                        //  test si le user entrée est connu ?
                                        if (!$contactManager -> FindContact($contact)){
                                            $contactManager -> CreateContact($contact);
                                        }

                                        $ContactTemp = $userTemporaire -> getContactId();
                                        $ContactID = $contactManager -> ReadContactForName($nom, $prenom);
                                        $favoriteManager = new FavoriteManager($cnx);

                                        //  test si usertemporaire à des favorie
                                        if ($contactManager -> FindFavorite($ContactTemp) && $choise){
                                            $favorites = $contactManager -> ReadFavoriteContact($ContactTemp, $ContactID);
                                            foreach ($favorites as $favorite) {
                                                $favoriteManager -> CreateFavorite($favorite);
                                            }
                                        }

                                        //  Insert les commentaire ici
                                        $commentaire = new Commentaire();
                                        $commentaireManager = new CommentaireManager($cnx);

                                        $commentaire -> setContactID($ContactID);
                                        $commentaire -> setCommentaire($com);
                                        $commentaire -> setDateCreate($contact -> getDateCreate());

                                        $commentaireManager -> CreateCommentaire($commentaire);

                                        //  on détruit l'user temporaire
                                        if($favoriteManager -> FindFavoriteUser($ContactTemp)){
                                            $favoriteManager -> DeleteFavorite($ContactTemp);
                                        }

                                        $contactManager -> DeleteContact($ContactTemp);
                                        $_SESSION['username'] = $Nom;
                                        $_SESSION['usersurname'] = $Prenom;

                                        //  Donnée sauvegarder
                                        $access = true;
                                    }
                                }
                                
                                $msgError['name']     = $msgNom;
                                $msgError['mail']     = $msgMail;
                                $msgError['favorite'] = $favorite;
                                $msgError['com']      = $msgcom;
                                
                                // $msgMail, $favorite, $msgcom
                                $dataValues['nom']      = $nom;
                                $dataValues['prenom']   = $prenom;
                                $dataValues['mail']     = $email;
                                $dataValues['favorite'] = $choise;
                                $dataValues['com']      = $com;

                                $formulaire -> ViewWindow($ico, $msgError, $dataValues);
                                ?>
                            </fieldset>
                        </form>
                    </div>
                </section>
                <?php
                if ($access){
                    echo '
                    <div class="access-contact show-access">
                        <div class="content-access">
                            <h1>Bonjour '.$nom.' '.$prenom.'</h1>
                            <br>
                            <p>Votre demande vient d\'être envoyé avec succés !</p>
                            <p>merci de patienter une réponse à l\'adresse '.$email.' vous sera transmis dans les meilleur délais</p>
                            <p>dans l\'attente merci de votre confiance .</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>

        <?php $Viewer -> ViewFooter('Contact'); ?>
    </body>
</html>