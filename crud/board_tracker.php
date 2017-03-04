<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 11:44 AM
 */
require '../connectdb.php';

$connection = new Connection();
$conn = $connection->getConnection();


class BoardTracker
{
    private $boardCode;
    private $customer;
    private $dateBooked;
    private $days;


    public function getBoardCode()
    {
        return $this->boardCode;
    }

    /**
     * @param mixed $boardCode
     */
    public function setBoardCode($boardCode)
    {
        $this->boardCode = $boardCode;
    }


    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getDateBooked()
    {
        return $this->dateBooked;
    }

    /**
     * @param mixed $dateBooked
     */
    public function setDateBooked($dateBooked)
    {
        $this->dateBooked = $dateBooked;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param mixed $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }



    /**
     * @return mixed
     */

    public function getExpiryDate()
    {
        $expiryDate = date("Y-m-d",mktime(0,0,0,date('m'),date('d')+$this->getDays(),date('Y')));
        return $expiryDate;
    }


    public function create()
    {
        global $conn;
        try {
            $boardCode = $this->getBoardCode();
            $customer = $this->getCustomer();
            $dateBooked = $this->getDateBooked();
            $expiryDate = $this->getExpiryDate();

            $stmt = $conn->prepare("INSERT INTO board_tracker(board_code, customer,
                                                date_booked,expiry_date)
                                              VALUES(:board_code, :customer,
                                              :date_booked,:expiry_date)");

            $stmt->bindParam(":board_code", $boardCode);
            $stmt->bindParam(":customer", $customer);
            $stmt->bindParam(":date_booked", $dateBooked);
            $stmt->bindParam(":expiry_date", $expiryDate);

            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;

        }

    }

    public function update($id)
    {
        global $conn;
        try {
            $boardCode = $this->getBoardCode();
            $customer = $this->getCustomer();
            $dateBooked = $this->getDateBooked();
            $expiryDate = $this->getExpiryDate();

            $stmt = $conn->prepare("UPDATE board_tracker SET board_code=:board_code,
                                    customer=:customer, date_booked=:date_booked
                                    , expiry_date=:expiry_date
                                    WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":board_code", $boardCode);
            $stmt->bindParam(":customer", $customer);
            $stmt->bindParam(":date_booked", $dateBooked);
            $stmt->bindParam(":expiry_date", $expiryDate);

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
            $stmt = $conn->prepare("DELETE FROM board_tracker WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function filterById($id)
    {
        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM board_tracker WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $response = array();
            if ($stmt->rowCount() > 0) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $response['id'] = $row['id'];
                $response['board_code'] = $row['board_code'];
                $response['customer'] = $row['customer'];
                $response['date_booked'] = $row['date_booked'];
                $response['expiry_date'] = $row['expiry_date'];

                return json_encode($response);

            } else {
                return json_encode($response);
            }
        } catch (PDOException $e) {
            $response['message'] = 'Error occurred. ' . $e->getMessage();
            return json_encode($response);
        }

    }

    public function filter($query)
    {
        global $conn;
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();

            $json_array = array();
            if ($stmt->rowCount() > 0) {
                $response = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $response['id'] = $row['id'];
                    $response['board_code'] = $row['board_code'];
                    $response['customer'] = $row['customer'];
                    $response['date_booked'] = $row['date_booked'];
                    $response['expiry_date'] = $row['expiry_date'];

                    array_push($json_array, $response);


                }
                return json_encode($json_array);

            } else {
                return json_encode($json_array);
            }

        } catch (PDOException $e) {

            $response['message'] = 'Error occurred. ' . $e->getMessage();
            return json_encode($response);
        }
    }

    public function all()
    {

        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM board_tracker WHERE 1");
            $stmt->execute();

            $json_array = array();
            if ($stmt->rowCount() > 0) {
                $response = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $response['id'] = $row['id'];
                    $response['board_code'] = $row['board_code'];
                    $response['customer'] = $row['customer'];
                    $response['date_booked'] = $row['date_booked'];
                    $response['expiry_date'] = $row['expiry_date'];

                    array_push($json_array, $response);


                }
                return json_encode($json_array);

            } else {
                return json_encode($json_array);
            }

        } catch (PDOException $e) {

            $response['message'] = 'Error occurred. ' . $e->getMessage();
            return json_encode($response);
        }
    }

}


$bt = new BoardTracker();
$bt->setBoardCode('256#');
$bt->setCustomer('Hudutech solns');
$bt->setDateBooked(date('Y-m-d'));
$bt->setDays(30);

$created = $bt->create();

if($created)
{
    print_r($bt->all());

}




