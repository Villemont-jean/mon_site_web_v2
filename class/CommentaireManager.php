<?php
class CommentaireManager {
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
    public function CreateCommentaire(Commentaire $Commentaire){
        //  Création d'un Commentaire
        $sql = "INSERT INTO commentaire
                (CommentaireID, ContactID, Commentaire, DateCreate)
                VALUES
                (:CommentaireID, :ContactID, :Commentaire, :DateCreate)";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':CommentaireID', $Commentaire -> getCommentaireID(), PDO::PARAM_INT);
        $req -> bindValue(':ContactID', $Commentaire -> getContactID(), PDO::PARAM_INT);
        $req -> bindValue(':Commentaire', $Commentaire -> getCommentaire(), PDO::PARAM_STR);
        $req -> bindValue(':DateCreate', $Commentaire -> getDateCreate(), PDO::PARAM_STR);
        
        $req -> execute();
    }

    //  CRUD - Read
    public function ReadCommentaire($ContactID){
        //  Lecture d'un' commentaire
        $sql = "SELECT * FROM commentaire
                WHERE ContactID = :ContactID";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        while($data = $req -> fetch(PDO::FETCH_ASSOC)){
            $commentaire = new Commentaire();

            $commentaire -> setCommentaireID($data['CommentaireId']);
            $commentaire -> setContactID($data['ContactID']);
            $commentaire -> setCommentaire($data['Commentaire']);
            $commentaire -> setDateCreate($data['DateCreate']);

            $commentaires[] = $commentaire;
        }

        return $commentaires;
    }

    public function FindCommentaire($ContactID){
        $sql = "SELECT count(*) as nbr FROM commentaire
                WHERE ContactID = :ContactID";
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        return $data['nbr'];
    }

    //  CRUD - Update

    //  CRUD - Delete
}