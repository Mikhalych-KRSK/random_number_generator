<?php

//Подключение к базе

define('DB_HOSTNAME', '**');
define('T_DB_USERNAME', '**');
define('T_DB_PASSWORD', '**');
define('T_DB_DATABASE', '**');

define('DB_DRIVER', 'mysql');
define('T_DB_CHARACTER', 'utf8');
define('DB_COLLATION', 'utf8_general_ci');

class connect_db
{
    public $state = "";
    public $i = "";
    public $dbo = null;

    function __construct()
    {
        try {
            ////подключение к базе
            $conn = DB_DRIVER . ":host=" . DB_HOSTNAME . ";dbname=" . T_DB_DATABASE;
            $db = new PDO($conn, T_DB_USERNAME, T_DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbo = $db;
            $db->exec("set character set " . T_DB_CHARACTER);
            $db->exec("set character_set_client=" . T_DB_CHARACTER);
            $db->exec("set character_set_results=" . T_DB_CHARACTER);
            $result = $db->exec("set collation_connection=" . DB_COLLATION);
            $this->state = "connected";
        } catch (PDOException $e) {
            ////ошибка доступа к базе данных
            $this->state = "";
            ////логируем ошибку
            //new db_error($e->getMessage());
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    function __destruct()
    {
        $this->sbo = null;
    }
}

?>