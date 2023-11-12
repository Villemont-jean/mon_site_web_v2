<?php 
class Favorite{
    private $FavoriteID;
    private $TempID;
    private $CatTemp;
    private $ContactID;
    private $FavoriteValue;

    //  Getter
    public function getFavoriteID(){
        return $this -> FavoriteID;
    }

    public function getTempID(){
        return $this -> TempID;
    }

    public function getCatTemp(){
        return $this -> CatTemp;
    }

    public function getContactID(){
        return $this -> ContactID;
    }

    public function getFavoriteValue(){
        return $this -> FavoriteValue;
    }

    //  Setter
    public function setFavoriteID($FavoriteID){
        if (!is_numeric($FavoriteID)){
            $msg = 'la valeur de Favorite doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        } else {
            $this -> FavoriteID = $FavoriteID;
        }
    }

    public function setTempID($TempID){
        if (!is_numeric($TempID)){
            $msg = 'la valeur de Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        } else {
            $this -> TempID = $TempID;
        }
    }

    public function setCatTemp($CatTemp){
        if (!is_numeric($CatTemp)){
            $msg = 'la valeur de Catégorie de Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        } else {
            $this -> CatTemp = $CatTemp;
        }
    }

    public function setContactID($ContactID){
        if (!is_numeric($ContactID)){
            $msg = 'la valeur de Favorite doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        } else {
            $this -> ContactID = $ContactID;
        }
    }

    public function setFavoriteValue($FavoriteValue){
        if (!is_numeric($FavoriteValue)){
            $msg = 'la valeur de Favorite doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        } else {
            $this -> FavoriteValue = $FavoriteValue;
        }
    }
}
