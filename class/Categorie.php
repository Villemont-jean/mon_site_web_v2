<?php
class categorie{
    //  Attributs
    private $maxCat;

    private $CatTemp;
    private $CatNom;
    
    /* ******** */
    /*  Getter  */
    /* ******** */
    public function getMaxCat(){
        return $this -> maxCat;
    }


    public function getCatTemp(){
        return $this -> CatTemp;
    }

    public function getCatNom(){
        return $this -> CatNom;
    }

    /* ******** */
    /*  Setter  */
    /* ******** */
    public function setMaxCat($maxCat){
        if ($maxCat > 0){
            $this -> maxCat = $maxCat;
        } else {
            $msg = 'le Maximum de Catégorie des Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }
    
    public function setCatTemp($CatTemp){
        if ($CatTemp > 0){
            $this -> CatTemp = $CatTemp;
        } else {
            $msg = 'l\'identifiant du Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setCatNom($CatNom){
        if (is_string($CatNom)){
            $this -> CatNom = $CatNom;
        } else {
            $msg = 'le nom de la catégorie du Template doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }
}