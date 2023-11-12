<?php
class CompetanceManager {
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
    public function CreateCompetance(Competance $competance){
        //  Création d'un Template
        $sql = "INSERT INTO competences
                (CatComp, Nom, Comp, Abs) VALUES
                (:CatComp, :Nom, :Comp, :Abs)";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':CatComp', $competance -> getCatComp(), PDO::PARAM_STR);
        $req -> bindValue(':Nom', $competance -> getNom(), PDO::PARAM_STR);
        $req -> bindValue(':Comp', $competance -> getComp(), PDO::PARAM_STR);
        $req -> bindValue(':Abs', $competance -> getAbs(), PDO::PARAM_STR);

        $req -> execute();
    }


    //  CRUD - Read
    public function ReadCompetanceForCategorie($Cat){
        //  Lecture des Compétance d'une Catégorie
        $sql = "SELECT * FROM competences WHERE CatComp= :Categorie";

        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':Categorie', $Cat, PDO::PARAM_INT);
        $req -> execute();



        while ($data = $req -> fetch(PDO::FETCH_ASSOC)) {
            $Competance = new Competance();

            $Competance -> setCompId($data['CompID']);
            $Competance -> setCatComp($data['CatComp']);
            $Competance -> setNom($data['Nom']);
            $Competance -> setComp($data['Comp']);
            $Competance -> setAbs($data['Abs']);

            $Competances[] = $Competance;
        }

        return $Competances;
    }

    //  CRUD - Update
    public function UpdateCompetance(Competance $competance){
        //  Modifier une valeur de compétance
        $sql = "UPDATE competences SET
                CatComp = :CatComp, Comp = :Comp
                WHERE CompID  = :CompID";

        $req = $this -> cnx -> prepare($sql);

        $req -> bindValue(':CompID', $competance -> getCompID(), PDO::PARAM_INT);
        $req -> bindValue(':CatComp', $competance -> getCatComp(), PDO::PARAM_INT);
        $req -> bindValue(':Comp', $competance -> getComp(), PDO::PARAM_INT);

        $req -> execute();
    }


    //  Pourcentage des Compétances
    public function PouCentCompetance($PourCent){
        //  pourcentage inverser
        $PourCent = 100 - $PourCent;
        //  stroke-dashoffset / 100
        $PourCent = $PourCent * 2.14;
        return $PourCent;
    }
}