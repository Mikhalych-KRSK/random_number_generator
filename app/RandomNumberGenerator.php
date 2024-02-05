<?php

class RandomNumberGenerator {
    public function generateRandomNumber() {
        $randomNum = mt_rand(1, 1000);
        $id = $this->generateId();
        RandomNumberStorage::addGeneratedNumber($id, $randomNum);
        
        return array('id' => $id, 'number' => $randomNum);
    }

    private function generateId() {
        $db = new connect_db();
        $db = $db->dbo;

        $sql_id_select = $db->prepare("SELECT MAX(id) AS max_id FROM numbers;");
        $sql_id_select->execute([]);

        foreach ($sql_id_select as $row) {
            $max_id = $row['max_id'];
        }

        return ++$max_id;
    }
}
