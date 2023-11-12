<?php
class CategorieManager{
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
    /*public function CreateCategorie(){
        //  Création d'un Template
    }*/


    //  CRUD - Read
    public function ReadLastCategorie($CatTemp){
        //  Lecture de la Dernière Catégorie du Template
        $sql = "SELECT * FROM template_categorie
                WHERE CatTemp = :CatTemp";

        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':CatTemp', $CatTemp, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $Categorie = new categorie();

        $Categorie -> setCatNom($data['CatNom']);

        return $Categorie;
    }

    public function ReadTotalCategorie(){
        //  Lecture du nombre total de catégorie disponible
        $sql ="SELECT * FROM template_categorie
               WHERE isNbr = 1"; 
        
        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        while($data = $req -> fetch(PDO::FETCH_ASSOC)){
            $Categorie = new categorie();

            $Categorie -> setCatTemp($data['CatTemp']);
            $Categorie -> setCatNom($data['CatNom']);

            $Categories[] = $Categorie;
        }

        return $Categories;
    }

    public function readMaxCategorie(){
        $sql ="SELECT count(*) AS maxCat FROM template_categorie
               WHERE isNbr = 1"; 
        
        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $Categorie = new categorie();

        $Categorie -> setMaxCat($data['maxCat']);

        return $Categorie;
    }

    //  CRUD - Update
    /*public function UpdateCategorie(){
        //  Modifier un élément Template
    }


    //  CRUD - Delete
    public function DeleteCategorie(){
        //  Supprime un élément du Template 
    }*/
}