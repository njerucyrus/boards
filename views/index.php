<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/5/17
 * Time: 11:29 AM
 */

require '../crud/users.php';
require '../crud/boards.php';
require '../crud/board_tracker.php';
require '../crud/orders.php';


$user = new User();

$board = new Board();



?>
<?php include 'includes/head.php'; ?>
<div class="container-fluid" style="margin-top: 15px;">
    <div class="row">
        <div class="col col-md-9 col-md-offset-3">
            <div class="col col-md-11">
                <form class="form-horizontal">
                    <input type="text" placeholder="search billboard" class="form-control text-center">

                </form>
            </div>
            <?php
            $board_list = $board->all();
            if (!is_null($board_list)) {

                while ($row = $board_list->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="container-fluid"></div>

                            <div class="col col-md-12">

                                <div class="row">
                                    <div class="col-md-3 thumbnail">
                                        <img src="../assets/uploads/img/noimage.png">
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="panel" style="background-color: rgba(0,0,0,0.14)">
                                            <div class="panel-heading">
                                                <h4 style="color: rgba(235,69,3,0.93);"> <?php echo $row['town'] ?> (<?php echo $row['location'] ?>)</h4>
                                            </div>
                                            <div class="panel-body">
                                                <p><span class="label label-info" style="font-weight: bold;">&quot;<?php echo $row['width'];?> &times; <?php echo $row['height'];?>&quot;</span> double-sided, digital billboard located in Santa Clara, CA.
                                                    Visible to traffic traveling to <?php echo $row['seen_by']; ?>
                                                </p>
                                                <span class="pull-right">Weekly impressions <strong><?php echo $row['weekly_impressions']; ?></strong></span>
                                                <span><button
                                                            class="btn btn-xs btn-danger">Request quote</button> </span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>

                <?php
            } else {
                ?>

                <div class="jumbotron">
                    <div class="alert alert-info">
                        <p>No Bill boards found!</p>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</div>

</div>

