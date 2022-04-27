<?php
require_once 'constant.php';

class connection{
    private static $db;
    private $connection;

    public function __construct() {
        $this->connection = new MySQLi(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_connection);
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new connection();
        }
        return self::$db->connection;
    }


}
?>