<?php
    include_once 'Doctrine.php';
    
    //spl_autoload_register(array('Doctrine','autoload'));
    
    $manager = Doctrine_Manager::getInstance();
    $conn = Doctrine_Manager::connection('mysql://root:photography@localhost/goject','doctrine');
    $database = $conn->import->listDatabases();
    print_r($databases);
?>