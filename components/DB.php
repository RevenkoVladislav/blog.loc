<?php

class DB
{
public static function dbConnection()
{
    $params = require (ROOT . '/config/db_params.php');
    $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
    $connection = new PDO($dsn, $params['user'], $params['password'], $options);
    return $connection;
}
}