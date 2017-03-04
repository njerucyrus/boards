<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/3/17
 * Time: 9:41 PM
 */
require 'connectdb.php';


$connection = new Connection();
$conn = $connection->getConnection();

class Board
{
    private $id;
    private $boardCode;
    private $width;
    private $height;
    private $lat;
    private $lgn;
    private $town;
    private $boardType;
    private $price;
    private $ownedBy;
    private $weeklyImpression;

    /*
     * Uncoment  the constractor later
     *
     */

//    private $conn;
//
//    public function __construct($conn)
//    {
//        $this->conn = $conn;
//    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
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
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLgn()
    {
        return $this->lgn;
    }

    /**
     * @param mixed $lgn
     */
    public function setLgn($lgn)
    {
        $this->lgn = $lgn;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town)
    {
        $this->town = $town;
    }

    /**
     * @return mixed
     */
    public function getBoardType()
    {
        return $this->boardType;
    }

    /**
     * @param mixed $boardType
     */
    public function setBoardType($boardType)
    {
        $this->boardType = $boardType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getOwnedBy()
    {
        return $this->ownedBy;
    }

    /**
     * @param mixed $ownedBy
     */
    public function setOwnedBy($ownedBy)
    {
        $this->ownedBy = $ownedBy;
    }

    /**
     * @return mixed
     */
    public function getWeeklyImpression()
    {
        return $this->weeklyImpression;
    }

    /**
     * @param mixed $weeklyImpression
     */
    public function setWeeklyImpression($weeklyImpression)
    {
        $this->weeklyImpression = $weeklyImpression;
    }

    public function create()
    {
        global $conn;
        try {

            /*
            * First get the values using getters
            * and bind the parameter to the sql stmt
            * this prevents  the php notice
            * `Only variables should be passed by reference`
            */

            $boardCode = $this->getBoardCode();
            $width = $this->getWidth();
            $height = $this->getHeight();
            $lat = $this->getLat();
            $lgn = $this->getLgn();
            $town = $this->getTown();
            $boardType = $this->getBoardType();
            $price = $this->getPrice();
            $ownedBy = $this->getOwnedBy();
            $weeklyImpressions = $this->getWeeklyImpression();

            $stmt = $conn->prepare("INSERT INTO boards(board_code, width, height,lat,
                                  lgn,town,board_type,price,owned_by,
                                  weekly_impressions)
                                  VALUES (:board_code, :width, :height,:lat,
                                  :lgn,:town,:board_type,:price,:owned_by,
                                  :weekly_impressions)
                                  ");

            $stmt->bindParam(":board_code", $boardCode);
            $stmt->bindParam(":width", $width);
            $stmt->bindParam(":height", $height);
            $stmt->bindParam(":lat", $lat);
            $stmt->bindParam(":lgn", $lgn);
            $stmt->bindParam(":town", $town);
            $stmt->bindParam(":board_type", $boardType);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":owned_by", $ownedBy);
            $stmt->bindParam(":weekly_impressions", $weeklyImpressions);
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

            /*
           * First get the values using getters
           * and bind the parameter to the sql stmt
           * this prevents  the php notice
           * `Only variables should be passed by reference`
           */

            $boardCode = $this->getBoardCode();
            $width = $this->getWidth();
            $height = $this->getHeight();
            $lat = $this->getLat();
            $lgn = $this->getLgn();
            $town = $this->getTown();
            $boardType = $this->getBoardType();
            $price = $this->getPrice();
            $ownedBy = $this->getOwnedBy();
            $weeklyImpressions = $this->getWeeklyImpression();

            $stmt = $conn->prepare("UPDATE boards SET board_code=:board_code, width=:width, height=:height,
                                    lat=:lat, lgn=:lgn,town=:town, board_type=:board_type,
                                    price=:price, owned_by=:owned_by, 
                                    weekly_impressions=:weekly_impressions
                                    WHERE id=:id");

            /*
             * Bind the parameter to the sql prepare statement
             */
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":board_code", $boardCode);
            $stmt->bindParam(":width", $width);
            $stmt->bindParam(":height", $height);
            $stmt->bindParam(":lat", $lat);
            $stmt->bindParam(":lgn", $lgn);
            $stmt->bindParam(":town", $town);
            $stmt->bindParam(":board_type", $boardType);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":owned_by", $ownedBy);
            $stmt->bindParam(":weekly_impressions", $weeklyImpressions);
            /*
             * Execute and return true
             */
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
            $stmt = $conn->prepare("DELETE FROM boards WHERE id=:id");
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
            $stmt = $conn->prepare("SELECT * FROM boards WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            /*
             * Create a  array to hold the results
             */
            $result = array();

            if ($stmt->rowCount() > 0) {


                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $result['id'] = $row['id'];
                $result['board_code'] = $row['board_code'];
                $result['width'] = $row['width'];
                $result['height'] = $row['height'];
                $result['lat'] = $row['lat'];
                $result['lgn'] = $row['lgn'];
                $result['board_type'] = $row['board_type'];
                $result['price'] = $row['price'];
                $result['owned_by'] = $row['owned_by'];
                $result['weekly_impressions'] = $row['weekly_impressions'];

                return json_encode($result);

            } else {
                $json_array['output'] = 'No boards found!';
                return json_encode($json_array);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            $json_array['output'] = 'error occurred!';
            return json_encode($json_array);
        }

    }

    /*
     * function that returns a json response
     * of the the boards being selected
     */

    public function filter($query)
    {
        global $conn;
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            /*
             * json array to hold the results
             */
            $json_array = array();
            if ($stmt->rowCount() > 0) {
                $result = array();


                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $result['id'] = $row['id'];
                    $result['board_code'] = $row['board_code'];
                    $result['width'] = $row['width'];
                    $result['height'] = $row['height'];
                    $result['lat'] = $row['lat'];
                    $result['lgn'] = $row['lgn'];
                    $result['board_type'] = $row['board_type'];
                    $result['price'] = $row['price'];
                    $result['owned_by'] = $row['owned_by'];
                    $result['weekly_impressions'] = $row['weekly_impressions'];

                    array_push($json_array, $result);

                }
                return json_encode($json_array);
            } else {
                $json_array['output'] = 'No boards found!';
                return json_encode($json_array);
            }


        } catch (PDOException $e) {
            echo $e->getMessage();

            $json_array['output'] = 'error occurred!';
            return json_encode($json_array);
        }

    }

    public function all()
    {
        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM boards WHERE 1");
            $stmt->execute();
            /*
             * json array to hold the results
             */
            $json_array = array();
            if ($stmt->rowCount() > 0) {
                $result = array();


                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $result['id'] = $row['id'];
                    $result['board_code'] = $row['board_code'];
                    $result['width'] = $row['width'];
                    $result['height'] = $row['height'];
                    $result['lat'] = $row['lat'];
                    $result['lgn'] = $row['lgn'];
                    $result['board_type'] = $row['board_type'];
                    $result['price'] = $row['price'];
                    $result['owned_by'] = $row['owned_by'];
                    $result['weekly_impressions'] = $row['weekly_impressions'];

                    array_push($json_array, $result);

                }
                return json_encode($json_array);
            } else {
                $json_array['output'] = 'No boards found!';
                return json_encode($json_array);
            }


        } catch (PDOException $e) {
            echo $e->getMessage();

            $json_array['output'] = 'error occurred!';
            return json_encode($json_array);


        }
    }
}

/*
 * Test response
 */
$b = new Board();
print_r($b->all());

