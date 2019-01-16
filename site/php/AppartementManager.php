<?php
    include_once 'DataBaseConnexion.php';
    include_once 'DatabaseManager.php';
    include_once 'Appartement.php';

//=================================================================
//                   CLASS MANAGER - Appartement
//=================================================================
class AppartementManager extends DBClassManager {
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(DBClass $datas){
        $q = $this->_db->prepare('INSERT INTO TAppartement (ville, rue, numero, surface, NbPieces, anneeconstruction) 
        VALUES(:ville, :rue, :numero, :surface, :NbPieces, :anneeConstruction)');

        $q->bindValue(':ville', $datas->ville());
        $q->bindValue(':rue', $datas->rue());
        $q->bindValue(':numero', $class->numero(), PDO::PARAM_INT);
        $q->bindValue(':surface', $class->surface(), PDO::PARAM_INT);
        $q->bindValue(':NbPieces', $class->nbPieces(), PDO::PARAM_INT);
        $q->bindValue(':anneeConstruction', $class->anneeConstruction(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function delete(DBClass $datas){
        $this->_db->exec('DELETE FROM TAppartement WHERE idAppartement = '.$datas->idAppartement());
    }

    public function get($id){
        $id = (int) $id;

        $q = $this->_db->query('SELECT idAppartement, ville, rue, numero, surface, NbPieces, anneeconstruction FROM TAppartement WHERE idAppartement = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
        return new Appartement($donnees);
    }

    public function getList($where = null){
        $Appartements = [];

        $clauseWhere = is_null($where) ? "" : " WHERE $where ";
    
        $q = $this->_db->query('SELECT idAppartement, ville, rue, numero, surface, NbPieces, anneeconstruction FROM TAppartement' . $clauseWhere .' ORDER BY idAppartement');
    
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
          $Appartements[] = new Appartement($donnees);
        }
    
        return $Appartements;
    }  

    public function getListFromClient($id){
        return $this->getList(" IdClient=$id ");
    }

    public function update(DBClass $datas){
        $q = $this->_db->prepare('UPDATE TAppartement SET nom = :ville, prenom = :rue, numero = :numero, surface = :surface, NbPieces = :nbPieces, anneeConstruction = : anneeConstruction WHERE idAppartement = :idAppartement');

        $q->bindValue(':ville', $datas->ville());
        $q->bindValue(':rue', $datas->rue());
        $q->bindValue(':numero', $class->numero(), PDO::PARAM_INT);
        $q->bindValue(':surface', $class->surface(), PDO::PARAM_INT);
        $q->bindValue(':NbPieces', $class->nbPieces(), PDO::PARAM_INT);
        $q->bindValue(':anneeConstruction', $class->anneeConstruction(), PDO::PARAM_INT);
        $q->bindValue(':idAppartement', $datas->idAppartement(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function clone(DBClass $datas){
        $newAppartement = clone $datas;
        $this->add($newAppartement);
        return $newAppartement;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}

 $AppartementManager = new AppartementManager(DBConnexion::getInstanceConnection());
 $listAppartements = $AppartementManager->getList();

?>