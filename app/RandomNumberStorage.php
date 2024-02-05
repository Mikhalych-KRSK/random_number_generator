<?php

class RandomNumberStorage {

    public static function addGeneratedNumber($id, $number) {
        $db = new connect_db();
        $db = $db->dbo;

        $sql_numbers_insert = $db->prepare("INSERT INTO numbers (id, number) VALUES (?, ?);");
        $sql_numbers_insert->execute([$id, $number]);
    }

    public static function getNumberById($id) {
        $db = new connect_db();
        $db = $db->dbo;

        $sql_numbers_select = $db->prepare("SELECT id, number FROM numbers WHERE id = ?;");
        $sql_numbers_select->execute([$id]);

        foreach ($sql_numbers_select as $row) {
            $number = $row['number'];
        }

        if (isset($number)) {
            return array('id' => $id, 'number' => $number);
        } else {
            return null;
        }
    }
}
