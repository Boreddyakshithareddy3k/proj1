<?php
   
    $host = '127.0.0.1';
    $username = 'root';
    $dbpassword = 'Haswanthi@11117';
    $database = 'formdata';
    

    $conn = new PDO("mysql:host=$host;dbname=$database",$username,$dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
?>