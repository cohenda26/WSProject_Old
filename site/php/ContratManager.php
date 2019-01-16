<?php
    include_once 'DataBaseConnexion.php';
    include_once 'DatabaseManager.php';
    include_once 'Contrat.php';

//=================================================================
//                   CLASS MANAGER - Contrat
//=================================================================
class ContratManager extends DBClassManager {
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(DBClass $datas){
        $q = $this->_db->prepare('INSERT INTO TContrat (datedebut, datefin, actif) VALUES(:datedebut, :datefin, :actif)');

        $q->bindValue(':datedebut', $datas->dateDebut());
        $q->bindValue(':datefin', $datas->dateFin());
        $q->bindValue(':actif', $class->actif(), PDO::PARAM_BOOL);
    
        $q->execute();
    }

    public function delete(DBClass $datas){
        $this->_db->exec('DELETE FROM TContrat WHERE idContrat = '.$datas->idContrat());
    }

    public function get($id){
        $id = (int) $id;

        $q = $this->_db->query('SELECT idContrat, datedebut, datefin, actif FROM TContrat WHERE idContrat = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
        return new Contrat($donnees);
    }

    public function getList(){
        $Contrats = [];

        $q = $this->_db->query('SELECT idContrat, datedebut, datefin, actif FROM TContrat ORDER BY idContrat');
    
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
          $Contrats[] = new Contrat($donnees);
        }
    
        return $Contrats;
    }  

    public function update(DBClass $datas){
        $q = $this->_db->prepare('UPDATE TContrat SET datedebut = :datedebut, datefin = :datefin, actif = :actif WHERE idContrat = :idContrat');

        $q->bindValue(':datedebut', $datas->dateDebut());
        $q->bindValue(':datefin', $datas->dateFin());
        $q->bindValue(':actif', $class->actif(), PDO::PARAM_BOOL);
        $q->bindValue(':idContrat', $datas->idContrat(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function clone(DBClass $datas){
        $newContrat = clone $datas;
        $this->add($newContrat);
        return $newContrat;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}


$ContratManager = new ContratManager(DBConnexion::getInstanceConnection());
$listContrats = $ContratManager->getList();
// $Contrat1 = $listContrats[0];
// $Contrat2 = $ContratManager->clone($Contrat1);

?>