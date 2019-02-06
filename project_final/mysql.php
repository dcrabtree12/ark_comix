<?php

$connection =
    new mysqli('localhost','root','','book_comic');

$config = @parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/php.ini");
$etcPath = $config['etc_directory'];
include "$etcPath./connect.php";
$con->select_db('book_comic');
