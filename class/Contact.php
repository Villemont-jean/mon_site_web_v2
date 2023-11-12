<?php
class Contact{
    private $ContactID;
    private $nom;
    private $prenom;
    private $mail;
    private $commentaireID;
    private $DateCreate;
    private $IsTemporaire;

    //  Getter
    public function getContactId(){
        return $this -> ContactID;
    }

    public function getNom(){
        return $this -> nom;
    }

    public function getPrenom(){
        return $this -> prenom;
    }

    public function getMail(){
        return $this -> mail;
    }

    public function getCommentaireID(){
        return $this -> commentaireID;
    }

    public function getDateCreate(){
        return $this -> DateCreate;
    }

    public function getIsTemporaire(){
        return $this -> IsTemporaire;
    }

    //  Setter
    public function setContactId($ContactID){
        if(!is_numeric($ContactID)){
            header('Location:error.php?Error=la valeur de l\'id du contact doit être un entier Positif');
        } else {
            $this -> ContactID = $ContactID;
        }
    }

    public function setNom($nom){
        if(!is_string($nom)){
            header('Location:error.php?Error=le nom doit être une chaîne de caractère');
        } else {
            $this -> nom = $nom;
        }
    }

    public function setPrenom($prenom){
        if(!is_string($prenom)){
            header('Location:error.php?Error=le prénom doit être une chaîne de caractère');
        } else {
            $this -> prenom = $prenom;
        }
    }

    public function setMail($mail){
        if(!is_string($mail)){
            header('Location:error.php?Error=l\'email doit être une chaîne de caractère Valide');
        } else {
            $this -> mail = $mail;
        }
    }

    public function setCommentaireID($commentaireID){
        if(!is_numeric($commentaireID)){
            header('Location:error.php?Error=l\'indice du commmentaire doit être une vleur numérique positif');
        } else {
            $this -> commentaireID = $commentaireID;
        }
    }

    public function setDateCreate($DateCreate){
        if(!is_string($DateCreate)){
            header('Location:error.php?Error=la date de création doit être une chaîne de caractère');
        } else {
            $this -> DateCreate = $DateCreate;
        }
    }

    public function setIsTemporaire($IsTemporaire){
        if(!is_numeric($IsTemporaire)){
            $msg = '';
            header('Location:error.php?Error=le test de temporaire doit être une valeur numérique positif');
        } else {
            $this -> IsTemporaire = $IsTemporaire;
        }
    }
}