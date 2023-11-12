<?php
class Formulaire {
    private $classmail = '<a href ="?ico=mail">    <img src="img/ui-menu/email.png"    id="ico-btn-email"    alt="Contactez moi">     </a>';
    private $location  = '<a href ="?ico=location"><img src="img/ui-menu/location.png" id="ico-btn-location" alt="Nôtre localisation"></a>';
    private $follow    = '<a href ="?ico=follow">  <img src="img/ui-menu/follow.png"   id="ico-btn-follow"   alt="suivez moi !">      </a>';

    //  Affichage des icons
    public function ViewIco($ico){
        switch ($ico){
            case 'mail':
                $this -> classmail = '<img src="img/ui-menu/email.png"   id="ico-btn-email"    alt="Contactez moi"     class="ico-active">';
                break;
            
            case 'location':
                $this -> location = '<img src="img/ui-menu/location.png" id="ico-btn-location" alt="Nôtre localisation" class="ico-active">';
                break;

            case 'follow':
                $this -> follow   = '<img src="img/ui-menu/follow.png"   id="ico-btn-follow"   alt="suivez moi !" class="ico-active">';
                break;
            
            default:
                header('Location:error.php?Error=l\'appel de la page doit être une chaîne de caractère valide');
                break;
        }

        echo $this -> classmail . $this -> location. $this -> follow;
        
    }

    //  Afficher les Vues
    public function ViewWindow($ico, array $msgError, array $msgValues){
        //  Variable d'erreurs
        $msgName  = $msgError['name'];
        $msgMail  = $msgError['mail'];
        $favorite = $msgError['favorite'];
        $msgCom   = $msgError['com'];
        
        $error = false;

        //  Variable Value
        $nom      = $msgValues['nom'];
        $prenom   = $msgValues['prenom'];
        $mail     = $msgValues['mail'];
        $choise   = $msgValues['favorite'];
        $com      = $msgValues['com'];

        switch($ico){
            //  Afficher le formulaire de contact
            case 'mail':
                echo '
                <article id="email-content" class="window window-active">
                    <p>
                        <label for="name">Votre nom : </label>';
                        $Txt = '';
                        if ($msgName == 'error'){
                            $Txt = 'style="border: 2px solid red;"';
                            $error = true;
                        } elseif($msgName == 'access') {
                            $Txt = 'style="border: 2px solid green"';
                        }

                        echo '<input '.$Txt.' id="name" type="text" name="name" value="'.$nom.'" placeholder="Entrez votre Nom ou Speudo ( Obligatoire )">
                    </p>

                    <p>
                        <label for="surname">Votre prénom : </label>
                        <input id="surname" type="text" name="surname" value="'.$prenom.'" placeholder="Entrez votre Prénom ( Facultatif )">
                    </p>

                    <p>
                        <label for="email">Votre adresse email : </label>';
                        $Txt = '';
                        if ($msgMail == 'error'){
                            $Txt = 'style="border: 2px solid red;"';
                            $error = true;
                        } elseif($msgMail == 'access'){
                            $Txt = 'style="border: 2px solid green;"';
                        }
                            
                        echo '<input '.$Txt.' id="email" type="text" name="email" value="'.$mail.'" placeholder="Entrez votre email ( Obligatoire )">
                    </p>';

                    if ($favorite){
                        echo '
                        <p>
                            <label for="favorite">Ajouter les favorie ?</label>';
                            $Txtoui = '';
                            $Txtnom = 'checked="checked"';
                            if ($choise){
                                $Txtoui = 'checked="checked"';
                                $Txtnom = '';
                            }
                            echo '
                            <input type="radio" name="favorite" '.$Txtoui.' value="oui"> Oui
                            <input type="radio" name="favorite" '.$Txtnom.' value="non"> Non
                        </p>';
                    } else {
                        echo '<p class="SpaceFavorite"></p>';
                    }
                    
                    echo '
                    <p>
                        <label for="commentaire" id="label-commentaire">Votre demande: </label>';
                        $Txt = '';
                        if ($msgCom == 'error'){
                            $Txt = 'style="border: 2px solid red;"';
                            $error = true;
                        } elseif( $msgCom == 'access'){
                            $Txt = 'style="border: 2px solid green;"';
                        }
                        
                        $placeholder = 'Entrez votre demande ( Obligatoire )';
                        if (!empty($com)){
                            $placeholder = $com;
                        }
                        echo '<textarea '.$Txt.' id="commentaire" cols="30" rows="10" name="com" placeholder="'.$placeholder.'"></textarea>
                    </p>';

                    $showError = 'hide-error';
                    if($error){
                        $showError = 'show-error';
                    }
                    //  Affihage des érreurs
                    echo '
                    <div class="error-contact '.$showError.'">
                        <div class="content-error">
                            <h2>Erreur !</h2>';
                            if ($msgName == 'error') {
                                echo '<p><span class="error" id="errorname"><i>Veuillez écrire votre nom ou speudo</i></span></p>';
                            }

                            if ($msgMail == 'error'){
                                echo '<p><span class="error" id="erroremail"><i>Veuillez écrire une adresse eMail valide</i></span></p>';
                            }
                            
                            if ($msgCom == 'error'){
                                echo '<p><span class="error" id="errorcommentaire"><i>Veuiller formulez votre demande</i></span></p>';
                            }
                            echo '
                            <a id="closeerror" href="">&times;</a>
                        </div>
                    </div>';
                    
                    if (!$error) {
                        echo '<input type="submit" value="Validez vos données" id="submit" name="submit">';
                    }
                    echo '
                </article>';
                break;

            //  Afficher la localisation
            case 'location':
                echo '
                <article id="location-content" class="window window-active">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46577.58465938477!2d1.2642028928194307!3d43.14444948557503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12af2994484b0dd5%3A0x406f69c2f435d30!2s09350%20Daumazan-sur-Arize!5e0!3m2!1sfr!2sfr!4v1685478411625!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </article>';
                break;

            //  Afficher les Follows
            case 'follow':
                echo '
                <article id="followUs-content" class="window window-active">
                    <div id="folloCenter">
                        <p><a href="" target="_blank"><img src="img/ui-menu/Gmail.png" alt="Adress eMail Google"></a></p>

                        <p><a href="" target="_blank"><img src="img/ui-menu/pinterest.png" alt="Pinterest"></a></p>

                        <p><a href="" target="_blank"><img src="img/ui-menu/Skype.png" alt="Skype"></a></p>

                        <p><a href="https://youtube.com/@jeanvillemont2211" target="_blank"><img src="img/ui-menu/youtube.png" alt="You Tube"></a></p>
                    </div>
                </article>';
                break;
        }
    }
}                  