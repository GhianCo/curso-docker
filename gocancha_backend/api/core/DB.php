<?php

class DB
{
    public $dbh; // handle of the db connexion
    private static $instance;

    private function __construct()
    {
        // building data source name from config        

        $dsn = 'mysql:host=' . DB_HOST .
               ';dbname='    . DB_NAME .
               ';port='      . DB_PORT .
               ';connect_timeout=15';
        
        $this->dbh = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    // others global functions
}

?>
