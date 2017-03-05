<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 2:20 AM
 */
require '../connectdb.php';

class Auth
{

    private $token;
    //private $conn;
//    public function __construct($conn)
//    {
//        $this->conn = $conn;
//    }


    public function authenticate($username, $password)
    {
        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
            $stmt->bindParam(":username", $username);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) {
                    return true;
                } else {
                    return false;
                }


            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * Generate a csrf_token to
     * prevent form submission from other sites
     * using js or other means
     * --This variable should be sent in session
     * for every form submission and check if it matches
     * on submitting the form
     * Unset the session on successful form submission
     */
    function generateCSRFToken()
    {
        $this->token = md5(uniqid('auth', true));
        return $this->token;
    }
}

