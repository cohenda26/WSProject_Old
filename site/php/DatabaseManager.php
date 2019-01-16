<?php   
    include_once 'DatabaseTable.php';
    
    //=================================================================
    //                   DATABASE MANAGER TEMPLATE
    //=================================================================
    interface iDataBase{
        public function add(DBClass $datas);
        public function delete(DBClass $datas);
        public function get($id);      
        public function getList();    
        public function update(DBClass $datas);
        public function clone(DBClass $datas);
        public function setDb(PDO $db);

    }

    class DBClassManager implements iDataBase{
        private $_db; // Instance de PDO

        public function __construct($db)
        {
          $this->setDb($db);
        }
        public function add(DBClass $datas){

        }
        public function delete(DBClass $datas){

        }
        public function get($id){

        }
        public function getList(){

        }  
        public function update(DBClass $datas){

        }
        public function clone(DBClass $datas){

        }
        public function setDb(PDO $db)
        {
          $this->_db = $db;
        }
    }


?>