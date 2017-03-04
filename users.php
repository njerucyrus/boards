<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 12:41 AM
 */

require 'auth.php';

class User extends Auth
{
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $company;
    private $accountType;
    private $username;
    private $password;

    function create()
    {
        global $conn;
        try {
            /*
             * Get the values using getters
             */

            $firstName = $this->getFirstName();
            $lastName = $this->getLastName();
            $email = $this->getEmail();
            $phoneNumber = $this->getPhoneNumber();
            $company = $this->getCompany();
            $accountType = $this->getAccountType();
            $username = $this->getUsername();
            $password = $this->getPassword();

            $stmt = $conn->prepare("INSERT INTO users(first_name, last_name,
                                  email,phone_number, company, account_type,username, password)
                                  VALUES (:first_name, :last_name, :email,:phone_number, :company,
                                   :account_type,:username, :password)");

            $stmt->bindParam(":first_name", $firstName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone_number", $phoneNumber);
            $stmt->bindParam(":company", $company);
            $stmt->bindParam(":account_type", $accountType);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {

            echo $e->getMessage();
            return false;
        }

    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * @param mixed $accountType
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function update($id)
    {
        global $conn;
        try {

            /*
             * Get the values using getters
             */

            $firstName = $this->getFirstName();
            $lastName = $this->getLastName();
            $email = $this->getEmail();
            $phoneNumber = $this->getPhoneNumber();
            $company = $this->getCompany();
            $accountType = $this->getAccountType();
            $username = $this->getUsername();
            $password = $this->getPassword();


            $stmt = $conn->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name,
                                     email=:email, phone_number=:phone_number, company=:company, account_type=:account_type,
                                      username=:username, password=:password WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":first_name", $firstName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone_number", $phoneNumber);
            $stmt->bindParam(":company", $company);
            $stmt->bindParam(":account_type", $accountType);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        global $conn;
        try {
            $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*
     * List account details for a given id
     */
    public function filterById($id)
    {
        global $conn;
        $response = array();
        try {

            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $response['id'] = $row['id'];
                $response['username'] = $row['username'];
                $response['first_name'] = $row['first_name'];
                $response['last_name'] = $row['last_name'];
                $response['email'] = $row['email'];
                $response['phone_number'] = $row['phone_number'];
                $response['company'] = $row['company'];
                $response['account_type'] = $row['account_type'];

                return json_encode($response);
            } else {
                $response['message'] = "No data found!";
                return json_encode($response);
            }

        } catch (PDOException $e) {
            $response['message'] = "Error occurred! " . $e->getMessage();
            return json_encode($response);
        }
    }

    public function filter($query)
    {
        global $conn;

        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $json_array = array();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $response['id'] = $row['id'];
                    $response['username'] = $row['username'];
                    $response['first_name'] = $row['first_name'];
                    $response['last_name'] = $row['last_name'];
                    $response['email'] = $row['email'];
                    $response['phone_number'] = $row['phone_number'];
                    $response['company'] = $row['company'];
                    $response['account_type'] = $row['account_type'];

                    array_push($json_array, $response);

                }

                return json_encode($json_array);
            } else {
                $response['message'] = "No data found!";
                return json_encode($response);
            }


        } catch (PDOException $e) {
            $response['message'] = "Error occurred! " . $e->getMessage();
            return json_encode($response);
        }
    }

    public function all()
    {
        global $conn;

        try {

            $stmt = $conn->prepare("SELECT * FROM users WHERE 1");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $json_array = array();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $response['id'] = $row['id'];
                    $response['username'] = $row['username'];
                    $response['first_name'] = $row['first_name'];
                    $response['last_name'] = $row['last_name'];
                    $response['email'] = $row['email'];
                    $response['phone_number'] = $row['phone_number'];
                    $response['company'] = $row['company'];
                    $response['account_type'] = $row['account_type'];

                    array_push($json_array, $response);

                }

                return json_encode($json_array);
            } else {
                $response['message'] = "No data found!";
                return json_encode($response);
            }


        } catch (PDOException $e) {
            $response['message'] = "Error occurred! " . $e->getMessage();
            return json_encode($response);
        }
    }

}




