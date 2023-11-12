<?php
class FavoriteManager{
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
    public function CreateFavorite(Favorite $Favorite){
        //  Création d'un Favorie
        $sql = "INSERT INTO favorite
                (TempID, CatTemp, ContactID, FavoriteValue)
                VALUES
                (:TempID, :CatTemp, :ContactID, :FavoriteValue)";
        
        $req = $this -> cnx -> prepare($sql);

        $req -> bindValue(':TempID', $Favorite -> getTempID(), PDO::PARAM_INT);
        $req -> bindValue(':CatTemp', $Favorite -> getCatTemp(), PDO::PARAM_INT);
        $req -> bindValue(':ContactID', $Favorite -> getContactID(), PDO::PARAM_INT);
        $req -> bindValue(':FavoriteValue', $Favorite -> getFavoriteValue(), PDO::PARAM_INT);
        
        $req -> execute();
    }


    //  CRUD - Read
    public function ReadFavoriteValue($TempID, $ContactID){
        //  Lecture d'un Favorie
        $sql = "SELECT COUNT(*) AS nbr FROM favorite
                WHERE TempID = :TempID AND ContactID = :ContactID AND FavoriteValue = 1";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':TempID', $TempID, PDO::PARAM_INT);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);

        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        return $data['nbr'];
    }

    public function ReadFavoriteUser($ContactID){
        $sql = "SELECT * FROM Favorite
                WHERE ContactID = :ContactID";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        while($data = $req -> fetch(PDO::FETCH_ASSOC)){
            $favorite = new favorite();

            $favorite -> setFavoriteID($data['FavoriteID']);
            $favorite -> setTempID($data['TempID']);
            $favorite -> setCatTemp($data['CatTemp']);
            $favorite -> setContactID($data['ContactID']);
            $favorite -> setFavoriteValue($data['FavoriteValue']);

            $favorites[] = $favorite;
        }

        return $favorites;
    }

    public function FindFavorite($TempID, $ContactID){
        //  Recherche si l'image est déjà en Favorie return l'ID si non 0
        $sql = "SELECT count(*) AS nbr FROM Favorite
                WHERE TempID = :TempID AND ContactID = :ContactID AND FavoriteValue = 1";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':TempID', $TempID, PDO::PARAM_INT);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);
        
        return $data['nbr'];
    }

    public function FindFavoriteUser($ContactID){
        //  Recherche si l'image est déjà en Favorie return l'ID si non 0
        $sql = "SELECT count(*) AS nbr FROM Favorite
                WHERE ContactID = :ContactID";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);
        
        return $data['nbr'];
    }

    //  CRUD - Update
   public function UpdateFavorite(Favorite $Favorite){
        //  Modifier un élément Favorite
        $sql = "UPDATE Favorite
                SET FavoriteValue = :FavoriteValue
                WHERE TempID = :TempID";
        
        $req = $this -> cnx -> prepare($sql);

        $req -> bindValue(':TempID', $Favorite -> getTempID(), PDO::PARAM_INT);
        $req -> bindValue(':FavoriteValue', $Favorite -> getFavoriteValue(), PDO::PARAM_INT);
        
        $req -> execute();
    }


    //  CRUD - Delete
    public function DeleteFavorite($ContactID){
        //  Supprime un élément du Favorite 
        $sql = "DELETE FROM Favorite
                WHERE ContactID = :ContactID";
        
        $req = $this -> cnx -> prepare($sql);

        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        
        $req -> execute();
    }
}