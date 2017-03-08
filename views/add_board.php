<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/5/17
 * Time: 9:27 PM
 */
/*
 * logic here
 */
require '../crud/auth.php';
require '../crud/boards.php';
require 'file_uploader.php';

$auth = new Auth();
$crsf_token = $auth->generateCSRFToken();

$_SESSION['csrf_token'] = $crsf_token;


if (isset(
    $_POST['submit'],
    $_POST['town'],
    $_POST['location'],
    $_POST['seen-by'],
    $_POST['board-type'],
    $_POST['width'],
    $_POST['height'],
    $_POST['weekly_impressions'],
    $_POST['price']
)) {

    $town = $_POST['town'];
    $location = $_POST['location'];
    $seenBy = $_POST['seen-by'];
    $boardType = $_POST['board-type'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $weeklyImpressions = $_POST['weekly_impressions'];
    $price = $_POST['price'];

    /*
     * upload image
     */
    $uploader = new FileUploader('image');
    $target_dir = '../assets/uploads/img/';
    $form_name = 'image';
    $fileUploaded = $uploader->uploadFile($target_dir, $form_name);

    if ($fileUploaded) {
        $file_url = $uploader->getFilePath();
        /*
         * all data is set now we submit the form to the database
         */
        //we create a new instance of board  then set the attributes
        $board = new Board();

        $board->setBoardCode(234);
        $board->setTown($town);
        $board->setLocation($location);
        $board->setSeenBy($seenBy);
        $board->setOwnedBy('hudutech');
        $board->setBoardType($boardType);
        $board->setHeight($height);
        $board->setWidth($width);
        $board->setPrice($price);
        $board->setWeeklyImpression($weeklyImpressions);
        $board->setImage($file_url);
        $board->setLat(-3.3393);
        $board->setLgn(0.00344);

        //insert in the database
        $created = $board->create();
        if ($created) {
            echo "Board created successfully";
        } else {
            echo "An Error occurred";
        }
    }
}

?>
<?php include 'includes/head.php' ?>
<?php include 'includes/navbar.php' ?>

<div class="container-fluid">
    <div class="col col-md-4 col-md-offset-4">
        <form class="form-group" action="add_board.php" method="post" enctype="multipart/form-data">

            <label for="town">Town</label>
            <input type="text" name="town" id="town" class="form-control">

            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control"
                   placeholder="specific location of the billboard">

            <label for="seen-by">Seen By</label>
            <textarea class="form-control" id="seen-by" name="seen-by">
        </textarea>

            <label class="radio-inline"><input type="radio" name="board-type">Single Sided</label>
            <label class="radio-inline"><input type="radio" name="board-type">Double Sided</label>
            <br>

            <label for="height">Height</label>
            <input type="number" name="height" id="height" class="form-control">

            <label for="width">Width</label>
            <input type="number" name="width" id="width" class="form-control">

            <label for="weekly-impressions">Weekly impressions</label>
            <input type="number" name="weekly_impressions" id="weekly-impressions" class="form-control">

            <label for="price">Set Price</label>
            <input type="text" name="price" id="price" class="form-control">

            <label for="image">Primary Photo</label>
            <input type="file" name="image" class="form-control" id="image">
            <div class="col-md-6" style="margin-top: 10px;">
                <!--hidden fields for testing-->
                <input type="hidden" name="lat" value="0.3444">
                <input type="hidden" name="lgn" value="-5.94044">
                <input type="hidden" name="csrf_token" value="<?php echo $crsf_token; ?>">
                <button type="submit" class="btn btn-danger btn-block" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>