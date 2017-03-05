<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/3/17
 * Time: 7:58 PM
 */

$databaseName = 'billboard';
$password = '';
$databaseHost = 'localhost';
$databaseUser = 'root';

try {
    $conn = new PDO(
        "mysql:host={$databaseHost};
                dbname={$databaseName}",
        $databaseUser,
        $password
    );

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //return $this->conn;
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    //return null;
}