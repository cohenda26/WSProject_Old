<?php
    class ItemRoute {
        public $title = '';
        public $file = '';
        public function __construct($title, $file){
            $this->title = $title;
            $this->file = $file;
        }
    }

    $routes = array(
        'home' => new ItemRoute('Home page','contents/home.php'),
        'assHabitation' => new ItemRoute('Assurance Habitation', 'contents/assHabitation.php')
    );

    $page = $routes['home'];
    if ( isset($_GET['p']) ){
        if (array_key_exists($_GET['p'], $routes) ) {
            $page = $routes[$_GET['p']];
        }
    }


    require('./templates/model.php');
?>