<?php

/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/9/17
 * Time: 5:34 AM
 */
require_once '../crud/crud_interface.php';
require_once '../crud/boards.php';

$data = $data = json_decode(file_get_contents('php://input'), true);

$request_method = $_SERVER['REQUEST_METHOD'];


switch ($request_method) {
    case "POST":
        createBillBoard();
        break;

    case "PUT":
        updateBillBoard();
        break;

    case "DELETE":
        deleteBillBoard();
        break;

    case "GET":
        if(isset($_GET['id'])){
            getBillBoardById();
        }
        else{
            getAllBillBoards();
        }
    break;

}


/**
 *this method creates an new billboard resource
 * the method should be called on HTTP POST request only.
 * the attributes of the Board class must be set via the
 * setters before calling the create method
 */
function createBillBoard()
{

    if (!empty($data)) {
        $boardCode = $data['boardCode'];
        $town = $data['town'];
        $location = $data['location'];
        $seenBy = $data['seenBy'];
        $ownedBy = $data['ownedBy'];
        $boardType = $data['boardType'];
        $height = $data['height'];
        $width = $data['width'];
        $price = $data['price'];
        $weeklyImpressions = $data['weeklyImpressions'];
        $image = $data['image'];
        $lat = $data['lat'];
        $lgn = $data['lgn'];
        if (isset($image)) {
            /*
             * upload image and get the path
             *  we set an empty file url for testing
             */
            $file_url = '';

            $board = new Board();
            $board->setBoardCode($boardCode);
            $board->setTown($town);
            $board->setLocation($location);
            $board->setSeenBy($seenBy);
            $board->setOwnedBy($ownedBy);
            $board->setBoardType($boardType);
            $board->setHeight($height);
            $board->setWidth($width);
            $board->setPrice($price);
            $board->setWeeklyImpression($weeklyImpressions);
            $board->setImage($file_url);
            $board->setLat($lat);
            $board->setLgn($lgn);

            $created = $board->create();
            if ($created) {
                print_r(json_encode(array(
                    "statusCode" => 200,
                    "status" => "success",
                    "message" => "billboard registered successfully"
                )));
            } else {
                print_r(json_encode(array(
                    "statusCode" => 500,
                    "status" => "failed",
                    "message" => "error occurred"
                )));
            }

        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "status" => "failed",
                "message" => "missing image file"
            )));
        }
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "status" => "failed",
            "message" => "no data received"
        )));
    }
}


/**
 * updates the board using the specified id.
 * all attributes of the board must be set using
 * the setter method of the Board class except  id attribute
 * before calling the update method
 */
function updateBillBoard()
{


    if (!empty($data)) {

        $id = $data['id'];
        $boardCode = $data['boardCode'];
        $town = $data['town'];
        $location = $data['location'];
        $seenBy = $data['seenBy'];
        $ownedBy = $data['ownedBy'];
        $boardType = $data['boardType'];
        $height = $data['height'];
        $width = $data['width'];
        $price = $data['price'];
        $weeklyImpressions = $data['weeklyImpressions'];
        $image = $data['image'];
        $lat = $data['lat'];
        $lgn = $data['lgn'];

        if (isset($image)) {
            /*
             * upload image and get the path
             *  we set an empty file url for testing
             */
            $file_url = '';

            $board = new Board();
            $board->setBoardCode($boardCode);
            $board->setTown($town);
            $board->setLocation($location);
            $board->setSeenBy($seenBy);
            $board->setOwnedBy($ownedBy);
            $board->setBoardType($boardType);
            $board->setHeight($height);
            $board->setWidth($width);
            $board->setPrice($price);
            $board->setWeeklyImpression($weeklyImpressions);
            $board->setImage($file_url);
            $board->setLat($lat);
            $board->setLgn($lgn);

            $updated = $board->update($id);
            if ($updated) {
                print_r(json_encode(array(
                    "statusCode" => 200,
                    "status" => "success",
                    "message" => "billboard updated successfully"
                )));
            } else {
                print_r(json_encode(array(
                    "statusCode" => 500,
                    "status" => "failed",
                    "message" => "error occurred"
                )));
            }

        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "status" => "failed",
                "message" => "missing image file"
            )));
        }
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "status" => "failed",
            "message" => "no data received"
        )));
    }
}

/**
 *deletes the specified board using the
 * id . the id is sent as json object
 * this function utilizes the static method in
 * the Board class
 */
function deleteBillBoard()
{
    if (!empty($data['id'])) {
        $id = $data['id'];

        $deleted = Board::delete($id);
        if ($deleted) {
            print_r(json_encode(array(
                "statusCode" => 204,
                "status" => "success",
                "message" => "billboard deleted successfully"
            )));
        } else {
            print_r(json_encode(array(
                "statusCode" => 500,
                "status" => "failed",
                "message" => "error occurred while deleting"
            )));
        }
    } else {
        print_r(json_encode(array(
            "statusCode" => 500,
            "status" => "failed",
            "message" => "Error! id is missing"
        )));
    }
}

/**
 * returns a single json object on success
 */
function getBillBoardById()
{
    $id = $_GET['id'];
    $queryObject = Board::filterById($id);
    try {
        $response = array();
        while ($row = $queryObject->fetch(PDO::FETCH_ASSOC)) {
            $response['id'] = $row['id'];
            $response['boardCode'] = $row['board_code'];
            $response['width'] = $row['width'];
            $response['height'] = $row['height'];
            $response['lat'] = $row['lat'];
            $response['lgn'] = $row['lgn'];
            $response['town'] = $row['town'];
            $response['location'] = $row['location'];
            $response['boardType'] = $row['board_type'];
            $response['price'] = $row['price'];
            $response['seenBy'] = $row['seen_by'];
            $response['weeklyImpressions'] = $row['weekly_impressions'];
        }
        print_r(json_encode($response));
    } catch (PDOException $e) {

        print_r(json_encode(array(
            "statusCode" => 500,
            "status" => "failed",
            "message" => "Error occurred" . $e->getMessage()
        )));
    }

}


/**
 *returns an array of json objects
 * on success
 */
function getAllBillBoards(){
    $queryObject = Board::all();
    try {
        $json_array = array();
        $response = array();
        while ($row = $queryObject->fetch(PDO::FETCH_ASSOC)) {
            $response['id'] = $row['id'];
            $response['boardCode'] = $row['board_code'];
            $response['width'] = $row['width'];
            $response['height'] = $row['height'];
            $response['lat'] = $row['lat'];
            $response['lgn'] = $row['lgn'];
            $response['town'] = $row['town'];
            $response['location'] = $row['location'];
            $response['boardType'] = $row['board_type'];
            $response['price'] = $row['price'];
            $response['seenBy'] = $row['seen_by'];
            $response['weeklyImpressions'] = $row['weekly_impressions'];

            array_push($json_array, $response);
        }
        print_r(json_encode($json_array));
    } catch (PDOException $e) {

        print_r(json_encode(array(
            "statusCode" => 500,
            "status" => "failed",
            "message" => "Error occurred" . $e->getMessage()
        )));
    }
}