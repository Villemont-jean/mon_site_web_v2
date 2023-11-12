<?php
class CompCategorie {
    private $CatComp;
    private $GroupNom;

    //  Getter
    public function getCatComp(){
        return $this -> CatComp;
    }

    public function getGroupNom(){
        return $this -> GroupNom;
    }

    //  Setter
    public function setCatComp($CatComp){
        if ($CatComp > 0){
            $this -> CatComp = $CatComp;
        } else {
            $msg = 'le Nombre de la Catégorie de Compétance doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setGroupNom($GroupNom){
        if (is_string($GroupNom)){
            $this -> GroupNom = $GroupNom;
        } else {
            $msg = 'le Nom de la catégorie doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }
}