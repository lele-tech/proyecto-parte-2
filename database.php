<?php 
    namespace Medoo;
    require 'Medoo.php';
    /* 
    - For Laragon: username='root' / password=''
    - For MAMP: username='root' / password='root'
      */
    $database = new Medoo([
        'type'=>'mysql',
        'host' => 'localhost',
        'database' => 'recipe_book',
        'username' => 'root',
        'password' => ''
    ]);
?>