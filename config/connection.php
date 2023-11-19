<?php
class DB
{
    private static $instance = null;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname=hotel_reservation_system', 'root', 'root');
                self::$instance->exec("SET NAMES 'utf8'");
                 echo "vc hehe";
            } catch (PDOException $ex) {
                die($ex->getMessage());
            }
        }
        return self::$instance;
    }
}

$db = DB::getInstance();
