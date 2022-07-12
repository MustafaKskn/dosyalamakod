<?php

$host="localhost";
$username="root";
$password="";
$dbname="resimyuk";
try {
$conn = new PDO("mysql:host=localhost;dbname=resimyuk", "root", "");}
catch (PDOException $ex) {
    die($conn->getMessage());
}

?>