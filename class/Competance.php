<?php
class Competance {
    private $CompId;
    private $CatComp;
    private $nom;
    private $Comp;
    private $Abs;

    //  Getter
    public function getCompID(){
        return $this -> CompId;
    }

    public function getCatComp(){
        return $this -> CatComp;
    }

    public function getNom(){
        return $this -> nom;
    }

    public function getComp(){
        return $this -> Comp;
    }

    public function getAbs(){
        return $this -> Abs;
    }

    //  Setter
    public function setCompId($CompId){
        if ($CompId > 0){
            $this -> CompId = $CompId;
        } else {
            $msg = 'l\'identifiant de la compétance doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setCatComp($CatComp){
        if ($CatComp > 0){
            $this -> CatComp = $CatComp;
        } else {
            $msg = 'l\'identifiant de la catégorie de compétance doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setNom($nom){
        if (is_string($nom)){
            $this -> nom = $nom;
        } else{
            $msg = 'le nom de la compétance doit être une chaîne e caractère';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setComp($comp){
        if ($comp > 0){
            $this -> Comp = $comp;
        } else {
            $msg = 'le poucentage de compétance doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setAbs($Abs){
        if (is_string($Abs)){
            $this -> Abs = $Abs;
        } else {
            $msg = 'l\'abréget de la compétance doit être une chaîne de caractère';
            header('Location:error.php?Error='.$msg);
        }
        
    }
}