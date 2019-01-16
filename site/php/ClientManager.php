<?php
    include_once 'DataBaseConnexion.php';
    include_once 'DatabaseManager.php';
    include_once 'Client.php';

//=================================================================
//                   CLASS MANAGER - CLIENT
//=================================================================
class ClientManager extends DBClassManager {
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(DBClass $datas){
        $q = $this->_db->prepare('INSERT INTO TClient (nom, prenom) VALUES(:nom, :prenom)');

        $q->bindValue(':nom', $datas->nom());
        $q->bindValue(':prenom', $datas->prenom());
        //$q->bindValue(':collone', $class->variable(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function delete(DBClass $datas){
        $this->_db->exec('DELETE FROM TClient WHERE idClient = '.$datas->idClient());
    }

    public function get($id){
        $id = (int) $id;

        $q = $this->_db->query('SELECT idClient, nom, prenom FROM TClient WHERE idClient = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
    
        return new Client($donnees);
    }

    public function getList(){
        $clients = [];

        $q = $this->_db->query('SELECT idClient, nom, prenom FROM TClient ORDER BY nom');
    
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
          $clients[] = new Client($donnees);
        }
    
        return $clients;
    }  

    public function update(DBClass $datas){
        $q = $this->_db->prepare('UPDATE TClient SET nom = :nom, prenom = :prenom WHERE idClient = :idClient');

        $q->bindValue(':nom', $datas->nom());
        $q->bindValue(':prenom', $datas->prenom());
        $q->bindValue(':idClient', $datas->idClient(), PDO::PARAM_INT);
    
        $q->execute();
    }

    public function clone(DBClass $datas){
        $newClient = clone $datas;
        $this->add($newClient);
        return $newClient;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}


$clientManager = new ClientManager(DBConnexion::getInstanceConnection());
$listClients = $clientManager->getList();
$client1 = $listClients[0];
$client1->getListAppartements();
// $client2 = $clientManager->clone($client1);

?>