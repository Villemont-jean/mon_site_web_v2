<?php
class ContactManager{
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
    public function CreateContact(Contact $Contact){
        //  Création d'un Contact
        $sql = "INSERT INTO contact
                (ContactID, nom, prenom, email, CommentaireID, DateCreate, IsTemporaire)
                VALUES
                (:ContactID, :nom, :prenom, :email, :CommentaireID, :DateCreate, :IsTemporaire)";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $Contact -> getContactId(), PDO::PARAM_INT);
        $req -> bindValue(':nom', $Contact -> getNom(), PDO::PARAM_STR);
        $req -> bindValue(':prenom', $Contact -> getPrenom(), PDO::PARAM_STR);
        $req -> bindValue(':email', $Contact -> getMail(), PDO::PARAM_STR);
        $req -> bindValue(':CommentaireID', $Contact -> getCommentaireID(), PDO::PARAM_INT);
        $req -> bindValue(':DateCreate', $Contact -> getDateCreate(), PDO::PARAM_STR);
        $istemp = 0;
        if ($Contact -> getIsTemporaire()){
            $istemp = $Contact -> getIsTemporaire();
        }
        $req -> bindValue(':IsTemporaire', $istemp, PDO::PARAM_INT);
        
        $req -> execute();
    }


    //  CRUD - Read
    public function ReadContact($ContactID){
        //  Lecture d'un Contact par aport à son identifiant
        $sql = "SELECT * FROM contact
                WHERE ContactID = :ContactID";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        $contact = new Contact();

        $contact -> setNom($data['nom']);
        $contact -> setPrenom($data['prenom']);
        if ($data['email'] != null){
            $contact -> setMail($data['email']);
        }
        if ($data['CommentaireId'] != null){
            $contact -> setCommentaireID($data['CommentaireId']);
        }
        $contact -> setDateCreate($data['DateCreate']);
        $contact -> setIsTemporaire($data['IsTemporaire']);

        return $contact;
    }

    public function ReadContactForName($name, $surname){
        //  Lecture d'un Contact par aport à son nom et prénom
        $sql = "SELECT * FROM contact
                WHERE nom = :nom AND prenom = :prenom";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':nom', $name, PDO::PARAM_STR);
        $req -> bindValue(':prenom', $surname, PDO::PARAM_STR);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        return $data['ContactID'];
    }

    public function ReadAllContact(){
        //  Lecture de tous les Contact
        $sql = "SELECT * FROM contact";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> execute();

        while($data = $req -> fetch(PDO::FETCH_ASSOC)){
            $contact = new Contact();

            $contact -> setContactId($data['ContactID']);
            $contact -> setNom($data['nom']);
            $contact -> setPrenom($data['prenom']);
            if ($data['email'] != null){
                $contact -> setMail($data['email']);
            }
            if ($data['CommentaireId'] != null){
                $contact -> setCommentaireID($data['CommentaireId']);
            }
            $contact -> setDateCreate($data['DateCreate']);
            $contact -> setIsTemporaire($data['IsTemporaire']);

            $contacts[] = $contact;
        }

        return $contacts;
    }

    public function ReadFavoriteContact($ContactID, $idcontactID){
        //  Retourn les favorite du contact
        $sql = "SELECT * FROM favorite
                WHERE ContactID = :ContactID AND FavoriteValue=1";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':ContactID', $ContactID, PDO::PARAM_INT);
        $req -> execute();

        while($data = $req -> fetch(PDO::FETCH_ASSOC)){
            $favorite = new Favorite();

            $favorite -> setTempID($data['TempID']);
            $favorite -> setCatTemp($data['CatTemp']);
            $favorite -> setContactID($idcontactID);
            $favorite -> setFavoriteValue($data['FavoriteValue']);

            $favorites[] = $favorite;
        }

        return $favorites;
    }

    public function FindContact(Contact $Contact){
        //  Retourn True si il trouve le même nom et prénom
        $sql = "SELECT count(*) AS nbr FROM contact
                WHERE nom = :nom AND prenom = :prenom";
        
        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':nom', $Contact -> getNom(), PDO::PARAM_STR);
        $req -> bindValue(':prenom', $Contact -> getPrenom(), PDO::PARAM_STR);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        return $data['nbr'];
    }

    public function FindFavorite($id){
        $sql = "SELECT count(*) AS nbr FROM favorite
                WHERE ContactID = :id AND FavoriteValue = 1";

        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':id', $id, PDO::PARAM_INT);
        $req -> execute();

        $data = $req -> fetch(PDO::FETCH_ASSOC);

        return $data['nbr'];
    }

    

    //  CRUD - Update
    /*public function UpdateContact(){
        //  Modifier un élément Template
    }*/


    //  CRUD - Delete
    public function DeleteContact($id){
        //  Supprime un élément du Template
        $sql = "DELETE FROM contact
                WHERE ContactID = :id";

        $req = $this -> cnx -> prepare($sql);
        $req -> bindValue(':id', $id, PDO::PARAM_INT);
        $req -> execute();
    }
}