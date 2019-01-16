<?php
    include_once 'DataBaseConnexion.php';
    include_once 'DatabaseManager.php';
    include_once 'Courtier.php';

//=================================================================
//                   CLASS MANAGER - Courtier
//=================================================================
class CourtierManager extends DBClassManager {
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(DBClass $datas){
        $q = $this->_db->prepare('INSERT INTO TCourtier (nom, numessek, ville, rue, numero, telephone ) 
        VALUES(:nom, :numessek, :ville, :rue, :numero, :telephone)');

        $q->bindValue(':nom', $datas->nom());
        $q->bindValue(':prenom', $datas->numEssek());
        $q->bindValue(':ville', $datas->ville());
        $q->bindValue(':rue', $datas->rue());
        $q->bindValue(':numero', $datas->numero(), PDO::PARAM_INT);
        $q->bindValue(':telephone', $datas->telephone());
        //$q->bindValue(':collone', $class->variable(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function delete(DBClass $datas){
        $this->_db->exec('DELETE FROM TCourtier WHERE idCourtier = '.$datas->idCourtier());
    }

    public function get($id){
        $id = (int) $id;

        $q = $this->_db->query('SELECT idCourtier, nom, numessek, ville, rue, numero, telephone  FROM TCourtier WHERE idCourtier = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
        return new Courtier($donnees);
    }

    public function getList(){
        $Courtiers = [];

        $q = $this->_db->query('SELECT idCourtier, nom, numessek, ville, rue, numero, telephone FROM TCourtier ORDER BY nom');
    
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
          $Courtiers[] = new Courtier($donnees);
        }
    
        return $Courtiers;
    }  

    public function update(DBClass $datas){
        $q = $this->_db->prepare('UPDATE TCourtier SET nom = :nom, numessek = :numessek, ville = :ville, rue = :rue, numero : :numero, telephone = :telephone WHERE idCourtier = :idCourtier');

        $q->bindValue(':nom', $datas->nom());
        $q->bindValue(':prenom', $datas->numEssek());
        $q->bindValue(':ville', $datas->ville());
        $q->bindValue(':rue', $datas->rue());
        $q->bindValue(':numero', $datas->numero(), PDO::PARAM_INT);
        $q->bindValue(':telephone', $datas->telephone());
        $q->bindValue(':idCourtier', $datas->idCourtier(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function clone(DBClass $datas){
        $newCourtier = clone $datas;
        $this->add($newCourtier);
        return $newCourtier;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}


$CourtierManager = new CourtierManager(DBConnexion::getInstanceConnection());
$listCourtiers = $CourtierManager->getList();
// $Courtier1 = $listCourtiers[0];
// $Courtier2 = $CourtierManager->clone($Courtier1);

?>