<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/3/17
 * Time: 7:58 PM
 */


class Connection
{
    private $databaseName = 'billboard';
    private $password = '';
    private $databaseHost = 'localhost';
    private $databaseUser = 'root';
    private $conn;

    function getConnection()
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->databaseHost};
                dbname={$this->databaseName}",
                $this->databaseUser,
                $this->password
            );

            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

}
