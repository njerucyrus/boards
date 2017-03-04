<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 2:20 AM
 */
require 'connectdb.php';

$connection = new Connection();
$conn = $connection->getConnection();
class Auth
{

   /*
     * Try an example of simple authentication
     * later will implement using cryptography mechanisms
     */

    public function authenticate($username, $password)
    {
        global $conn;

        try
        {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();

            if($stmt->rowCount() == 1){

                return true;
            }
            else{
                return false;
            }

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }
}

