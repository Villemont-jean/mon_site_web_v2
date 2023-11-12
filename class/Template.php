<?php
class Template{
    //  Attributs
    private $nbrImg;

    private $TempID;
    private $Title;
    private $UrlImg;
    private $AltImg;
    private $Caption;
    private $AjoutDay;
    private $Description;
    private $CatTemp;
    private $UrlTemp;

    /* ******** */
    /*  Getter  */
    /* ******** */
    public function getNbrImg(){
        return $this -> nbrImg;
    }


    public function getTempId(){
        return $this -> TempID;
    }

    public function getTitle(){
        return $this -> Title;
    }

    public function getUrlImg(){
        return $this -> UrlImg;
    }

    public function getAltImg(){
        return $this -> AltImg;
    }

    public function getCaption(){
        return $this -> Caption;
    }

    public function getAjoutDay(){
        return $this -> AjoutDay;
    }

    public function getDescription(){
        return $this -> Description;
    }

    public function getCatTemp(){
        return $this -> CatTemp;
    }

    public function getUrlTemp(){
        return $this -> UrlTemp;
    }

    /* ******** */
    /*  Setter  */
    /* ******** */
    public function setNbrImg($nbrImg){
        if ($nbrImg > 0){
            $this -> nbrImg = $nbrImg;
        } else {
            $msg = 'le nombre de Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }


    public function setTempId($TempID){
        if ($TempID > 0){
            $this -> TempID = $TempID;
        } else {
            $msg = 'l\'identifant du Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setTitle($Title){
        if (is_string($Title)){
            $this -> Title = $Title;
        } else {
            $msg = 'le Titre du Template doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setUrlImg($UrlImg){
        if (is_string($UrlImg)){
            $this -> UrlImg = $UrlImg;
        } else {
            $msg = 'l\'Url de l\'image du Template doit être une chaîne de Caratère';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setAltImg($AltImg){
        if (is_string($AltImg)){
            $this -> AltImg = $AltImg;
        } else {
            $msg = 'le Text Alternatif du Template doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setCaption($Caption){
        if (is_string($Caption)){
            $this -> Caption = $Caption;
        } else {
            $msg = 'le Caption de l\image du Template doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setAjoutDay($AjoutDay){
        if (!empty($AjoutDay)){
            $this -> AjoutDay = $AjoutDay;
        } else {
            $msg = 'la date d\'entrée du Template doit être une date valide';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setDescription($Description){
        if (is_string($Description)){
            $this -> Description = $Description;
        } else {
            $msg = 'la descrition du Template doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }

    public function setCatTemp($CatTemp){
        if ($CatTemp > 0){
            $this -> CatTemp = $CatTemp;
        } else {
            $msg = 'l\'identifiant de catégorie du Template doit être un entier Positif';
            header('Location:error.php?Error='.$msg);
        }
    }
    
    public function setUrlTemp($UrlTemp){
        if (is_string($UrlTemp)){
            $this -> UrlTemp = $UrlTemp;
        } else {
            $msg = 'l\'Url du Template doit être une chaîne de caractères';
            header('Location:error.php?Error='.$msg);
        }
    }
}