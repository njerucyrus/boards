<?php

/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/8/17
 * Time: 4:07 PM
 */
interface  Crud
{
    public function create();

    public function update($id);

    public static  function delete($id);

    public static  function all();

    public static  function filter($query);

    public static  function filterById($id);

}


