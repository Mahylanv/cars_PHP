<?php
session_start();

define("SQL_HOST", "localhost");
define("SQL_USER", "root");
define("SQL_PASS", "root");
define("SQL_DBNAME", "cars");



try{
    $db = new PDO("mysql:dbname=".SQL_DBNAME.";charset=utf8;host=".SQL_HOST, SQL_USER, SQL_PASS);

}catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
require('functions.php');
require('core.php');