<?php

class DB
{
public static function dbConnection()
{
    $params = require_once (ROOT . '/config/db_params.php');
    $db = new PDO("mysql:host={$params['host']};dbname={$params['dbname']}", $params['user'], $params['password']);
    $db->exec('set names utf8');
    return $db;
}
}