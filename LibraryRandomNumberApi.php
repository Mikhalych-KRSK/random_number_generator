<?php

include_once("./app/RandomNumberGenerator.php");
require_once("./app/RandomNumberStorage.php");
require_once("./config/db_connect.php");

class LibraryRandomNumberApi {
    private $baseUrl;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    public function parseUrlFunc($url) {
        $query = parse_url($url, PHP_URL_QUERY);
        $params = array();
        parse_str($query, $params);
        return $params;
    }

    public function generateRandomNumber() {
        $params = $this->parseUrlFunc($this->baseUrl);
        if ($params['func'] == 'random') {
            $generator = new RandomNumberGenerator();
            return $generator->generateRandomNumber();
        } else {
            return 'Error';
        }
    }

    public function getNumberById() {
        $params = $this->parseUrlFunc($this->baseUrl);
        if (isset($params['id'])) {
            $id = $params['id'];
            $number = RandomNumberStorage::getNumberById($id);
            if ($number != null || $number != '') {
                return $number;
            } else {
                return 'No number';
            }
        } else {
            return 'Error';
        }
    }
}
