<?php
class Commentaire{
    private $commentaireID;
    private $contactID;
    private $commentaire;
    private $datecreate;

    //  Getter
    public function getCommentaireID(){
        return $this -> commentaireID;
    }

    public function getContactID(){
        return $this -> contactID;
    }

    public function getCommentaire(){
        return $this -> commentaire;
    }

    public function getDateCreate(){
        return $this ->  datecreate;
    }

    //  Setter
    public function setCommentaireID($commentaireID){
        if(!is_numeric($commentaireID)){
            header('Location:error.php?Error=la valeur de l\'id du commentaire doit être un entier Positif');
        } else {
            $this -> commentaireID = $commentaireID;
        }
    }

    public function setContactID($contactID){
        if(!is_numeric($contactID)){
            header('Location:error.php?Error=la valeur de l\'id du contact doit être un entier Positif');
        } else {
            $this -> contactID = $contactID;
        }
    }

    public function setCommentaire($commentaire){
        if(!is_string($commentaire)){
            header('Location:error.php?Error=le getCommentaire doit être une chaîne de caractère');
        } else {
            $this -> commentaire = $commentaire;
        }
    }

    public function setDateCreate($datecreate){
        if(!is_string($datecreate)){
            header('Location:error.php?Error=la date doit être une chaîne de caractère valide');
        } else {
            $this -> datecreate = $datecreate;
        }
    }
}