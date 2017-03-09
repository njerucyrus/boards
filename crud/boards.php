<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/3/17
 * Time: 9:41 PM
 */
require '../connectdb.php';

class Board implements Crud
{
    private $id;
    private $boardCode;
    private $width;
    private $height;
    private $lat;
    private $lgn;
    private $town;
    private $location;
    private $boardType;
    private $price;
    private $ownedBy;
    private $seenBy;
    private  $image;
    private $weeklyImpression;

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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
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
    public function getSeenBy()
    {
        return $this->seenBy;
    }

    /**
     * @param mixed $seenBy
     */
    public function setSeenBy($seenBy)
    {
        $this->seenBy = $seenBy;
    }


    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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
            $location = $this->getLocation();
            $boardType = $this->getBoardType();
            $price = $this->getPrice();
            $ownedBy = $this->getOwnedBy();
            $image = $this->getImage();
            $seenBy = $this->getSeenBy();
            $weeklyImpressions = $this->getWeeklyImpression();

            $stmt = $conn->prepare("INSERT INTO boards(board_code, width, height,lat,
                                  lgn,town,location, seen_by, board_type,price,owned_by,image,
                                  weekly_impressions)
                                  VALUES (:board_code, :width, :height,:lat,
                                  :lgn,:town,:location, :seen_by,:board_type,:price,:owned_by,:image,
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
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":owned_by", $ownedBy);
            $stmt->bindParam(":weekly_impressions", $weeklyImpressions);
            $stmt->bindParam(":location", $location);
            $stmt->bindParam(":seen_by", $seenBy);

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
            $image = $this->getImage();
            $weeklyImpressions = $this->getWeeklyImpression();
            $location = $this->getLocation();
            $seenBy = $this->getSeenBy();

            $stmt = $conn->prepare("UPDATE boards SET board_code=:board_code, width=:width, height=:height,
                                    lat=:lat, lgn=:lgn,town=:town, board_type=:board_type,
                                    price=:price, owned_by=:owned_by, image=:image,
                                    weekly_impressions=:weekly_impressions, 
                                    location=:location, seen_by=:seen_by
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
            $stmt->bindParam(":image", $image);
            $stmt->bindParam(":owned_by", $ownedBy);
            $stmt->bindParam(":weekly_impressions", $weeklyImpressions);
            $stmt->bindParam(":location", $location);
            $stmt->bindParam(":seen_by", $seenBy);
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

    public static function delete($id)
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

    public static function filterById($id)
    {
        global $conn;
        try {

            $stmt = $conn->prepare("SELECT * FROM boards WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return $stmt;

            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;

        }

    }



    public static function filter($query)
    {
        global $conn;
        try {
            $stmt = $conn->prepare($query);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt;

            } else {
                return null;
            }


        } catch (PDOException $e) {
            echo $e->getMessage();

                return null;
        }

    }

    public static function all()
    {
        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM boards WHERE 1");
           // $stmt = $this->conn->prepare("SELECT * FROM boards WHERE 1");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                return $stmt;
            } else {

               return null;
            }



        } catch (PDOException $e) {
            echo $e->getMessage();

            return null;
        }
    }
}


