<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 3:15 AM
 */

require '../connectdb.php';

$connection = new Connection();

$conn = $connection->getConnection();

class Order
{

    private $orderId;
    private $refNo;
    private $boardId;
    private $amount;
    private $status;
    private $date;

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getRefNo()
    {
        return $this->refNo;
    }

    /**
     * @param mixed $refNo
     */
    public function setRefNo($refNo)
    {
        $this->refNo = $refNo;
    }

    /**
     * @return mixed
     */
    public function getBoardId()
    {
        return $this->boardId;
    }

    /**
     * @param mixed $boardId
     */
    public function setBoardId($boardId)
    {
        $this->boardId = $boardId;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function create()
    {
        global $conn;

        try
        {
            $orderId = $this->getOrderId();
            $refNo = $this->getRefNo();
            $boardId = $this->getBoardId();
            $amount = $this->getAmount();
            $status = $this->getStatus();
            $date = $this->getDate();

            $stmt = $conn->prepare("INSERT INTO orders(order_id, ref_no, 
                                    board_id, amount, status, order_date)
                                    VALUES (:order_id, :ref_no, 
                                    :board_id, :amount, :status, :order_date)");

            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':ref_no', $refNo);
            $stmt->bindParam(':board_id', $boardId);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_date', $date);

            $stmt->execute();
            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;

        }
    }

    function update($orderId)
    {
        global $conn;
        try {
            $refNo = $this->getRefNo();
            $boardId = $this->getBoardId();
            $amount = $this->getAmount();
            $status = $this->getStatus();
            $date = $this->getDate();

            $stmt = $conn->prepare("UPDATE orders SET ref_no=:ref_no,
                                    board_id=:board_id, amount=:amount,
                                    status=:status, order_date=:order_date WHERE
                                    order_id=:order_id
                                    ");

            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':ref_no', $refNo);
            $stmt->bindParam(':board_id', $boardId);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_date', $date);
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
            $stmt = $conn->prepare("DELETE FROM orders WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return true;

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

    /*
     * return order matching certain id
     */
    public function filterByOrderId($id){
        global $conn;
        $response = array();
        try
        {
            $stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if($stmt->rowCount() > 0 )
            {
                $result = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $result['id'] = $row['id'];
                    $result['order_id'] = $row['order_id'];
                    $result['ref_no'] = $row['ref_no'];
                    $result['board_id'] = $row['board_id'];
                    $result['amount'] = $row['amount'];
                    $result['status'] = $row['status'];
                    $result['order_date'] = $row['order_date'];

                    array_push($response, $result);
                }
                return json_encode($response);
            }
            else{
                /*
                 * return an empty array
                 */
                return json_encode($response);
            }

        }
        catch (PDOException $e)
        {
            $response['message'] = 'Error occurred'.$e->getMessage();

            return json_encode($response);

        }
    }
    /*
     * Filter with more options
     */
    public function filter($query)
    {

        global $conn;
        $response = array();
        try
        {
            $stmt = $conn->prepare($query);

            $stmt->execute();

            if($stmt->rowCount() > 0 )
            {
                $result = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $result['id'] = $row['id'];
                    $result['order_id'] = $row['order_id'];
                    $result['ref_no'] = $row['ref_no'];
                    $result['board_id'] = $row['board_id'];
                    $result['amount'] = $row['amount'];
                    $result['status'] = $row['status'];
                    $result['order_date'] = $row['order_date'];

                    array_push($response, $result);
                }
                return json_encode($response);
            }
            else{
                /*
                 * return an empty array
                 */
                return json_encode($response);
            }

        }
        catch (PDOException $e)
        {
            $response['message'] = 'Error occurred'.$e->getMessage();

            return json_encode($response);

        }
    }

    /*
     * Get all orders
     */
    public function all()
    {
        global $conn;
        $response = array();
        try
        {
            $stmt = $conn->prepare("SELECT * FROM orders WHERE 1");

            $stmt->execute();

            if($stmt->rowCount() > 0 )
            {
                $result = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $result['id'] = $row['id'];
                    $result['order_id'] = $row['order_id'];
                    $result['ref_no'] = $row['ref_no'];
                    $result['board_id'] = $row['board_id'];
                    $result['amount'] = $row['amount'];
                    $result['status'] = $row['status'];
                    $result['order_date'] = $row['order_date'];

                    array_push($response, $result);
                }
                return json_encode($response);
            }
            else{
                /*
                 * return an empty array
                 */
                return json_encode($response);
            }

        }
        catch (PDOException $e)
        {
            $response['message'] = 'Error occurred'.$e->getMessage();

            return json_encode($response);

        }
    }


}

$order = new Order();
$order->setBoardId(17);
$order->setOrderId('590384');
$order->setRefNo("#47KDI3");
$order->setAmount(350.00);
$order->setStatus('Completed');
$order->setDate(date("Y-m-d"));

print_r($order->filterByOrderId(4));

//if($created){
//    print_r($order->all());
//}


