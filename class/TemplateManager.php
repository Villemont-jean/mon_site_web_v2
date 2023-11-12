<?php
class TemplateManager{
    private $cnx;

    //  Constructeur
    public function __construct($cnx){
        $this -> setcnx($cnx);
    }

    //  Setter
    private function setCnx(PDO $cnx){
        $this -> cnx = $cnx;
    }

    //  CRUD - Create
    /*public function CreateTemplate(Template $template){
        //  Création d'un Template
    }*/


    //  CRUD - Read
    public function ReadTemplate($imgSelect){
        //  Lecture d'un Template
        $sql = "SELECT * FROM template
                WHERE TempID = :imgSelect";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':imgSelect', $imgSelect, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $template = new Template();

        $template -> setTempId($data['TempID']);
        $template -> setTitle($data['Title']);
        $template -> setUrlImg($data['UrlImg']);
        $template -> setAltImg($data['AltImg']);
        $template -> setCaption($data['Caption']);
        $template -> setAjoutDay($data['AjoutDay']);
        $template -> setDescription($data['Description']);
        $template -> setCatTemp($data['CatTemp']);
        $template -> setUrlTemp($data['UrlTemp']);

        return $template;
    }

    public function ReadAllTemplateforCategorie($CatTemp, $debut, $nbrElements){
        //  Lecture de tous les Templates d'une Catégorie
        $sql ="SELECT * FROM template
        WHERE CatTemp = :CatTemp
        ORDER BY TempID DESC
        LIMIT :debut, :nbrElements";

        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':CatTemp', $CatTemp, PDO::PARAM_INT);
        $req -> bindValue(':debut', $debut, PDO::PARAM_INT);
        $req -> bindValue(':nbrElements', $nbrElements, PDO::PARAM_INT);
        $req -> execute();

        while ($data = $req -> fetch(PDO::FETCH_ASSOC)) {
            $template = new Template();

            $template -> setTempId($data['TempID']);
            $template -> setTitle($data['Title']);
            $template -> setUrlImg($data['UrlImg']);
            $template -> setAltImg($data['AltImg']);
            $template -> setCaption($data['Caption']);
            $template -> setAjoutDay($data['AjoutDay']);
            $template -> setDescription($data['Description']);
            $template -> setCatTemp($data['CatTemp']);
            $template -> setUrlTemp($data['UrlTemp']);

            $Templates[] = $template;
        }

        return $Templates;
    }

    public function ReadNbrTemplateforCategorie($CatTemp){
        //  Lecture du nombre d'éléments dans la table par catégorie
        $sql = "SELECT COUNT(TempId) as nbrImg
                FROM template
                WHERE CatTemp = :CatTemp";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':CatTemp', $CatTemp, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $template = new Template();

        $template -> setNbrImg($data['nbrImg']);

        return $template;
    }
    
    public function ReadNbrTemplates(){
        //  Lecture du nombre d'éléments dans la table par catégorie
        $sql = "SELECT COUNT(TempId) as nbrImg
                FROM template";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $template = new Template();

        $template -> setNbrImg($data['nbrImg']);

        return $template;
    }
    
    public function ReadLastTemplate(){
        //  Lecture du dernier templates de la table
        $sql = "SELECT * FROM template
                ORDER BY TempID DESC
                LIMIT 0,1";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $template = new Template();

        $template -> setTempId($data['TempID']);
        $template -> setTitle($data['Title']);
        $template -> setUrlImg($data['UrlImg']);
        $template -> setAltImg($data['AltImg']);
        $template -> setAjoutDay($data['AjoutDay']);
        $template -> setDescription($data['Description']);
        $template -> setCatTemp($data['CatTemp']);

        return $template;
    }

    public function ReadAleatoirTemplate(){
        //  Lecture d'un Nomre données de Tempate aléatoire Toute Catégorie
        $sql ="SELECT * FROM template
               ORDER BY rand()
               LIMIT 4";

        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        while ($data = $req -> fetch(PDO::FETCH_ASSOC)) {
            $template = new Template();

            $template -> setTempId($data['TempID']);
            $template -> setUrlImg($data['UrlImg']);
            $template -> setAltImg($data['AltImg']);
            $template -> setCaption($data['Caption']);
            $template -> setCatTemp($data['CatTemp']);

            $Templates[] = $template;
        }

        return $Templates;
    }


    //  CRUD - Update
    /*public function UpdateTemplate(){
        //  Modifier un élément Template
    }


    //  CRUD - Delete
    public function DeleteTemplate(){
        //  Supprime un élément du Template 
    }*/
}