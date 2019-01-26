<?php

require_once 'User.php';

class Database
{
    public function __construct()
    {
        // database connection
    }

    public function insert()
    {
        // insert query
    }

    public function select()
    {
        // select query
    }
}

$connection = new Database('mysql');

$user1 = new User($connection);
