<?php
class CompCategorieManager {
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
    public function CreateCompetanceCategorie($nomcat){
        //  Création d'un Template
        $sql = "INSERT INTO competences_categorie
                (GroupNom) VALUES (:GroupNom)";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':GroupNom', $nomcat, PDO::PARAM_STR);

        $req -> execute();
    }


    //  CRUD - Read
    public function ReadCompetanceCategorie(){
        //  Lecture de toute les catégorie de Compétance
        $sql = "SELECT * FROM competences_categorie";

        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        

        while ($data = $req -> fetch(PDO::FETCH_ASSOC)) {
            $Categorie = new CompCategorie();

            $Categorie -> setCatComp($data['CatComp']);
            $Categorie -> setGroupNom($data['GroupNom']);
           
            $Categories[] = $Categorie;
        }

        return $Categories;
    }
}