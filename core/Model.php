<?php

namespace core;



abstract class Model
{
    public $db;

    public function __construct () {
        $this->db = Db::getInstance();
    }



    public function validate($data)
    {



    }

    public function getErrors()
    {

    }



    public function getLabels()
    {

    }

    public function save($table)
    {

    }

    public function update($table, $id)
    {


    }


}