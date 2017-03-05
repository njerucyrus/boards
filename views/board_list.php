<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 6:31 PM
 */

require '../crud/boards.php';

$board = new Board();

$list = $board->all();

if(!is_null($list)){
   while ($row = $list->fetch(PDO::FETCH_ASSOC)){
       echo $row['board_code']."\n";
   }

}

else {
    echo "No data";
}



