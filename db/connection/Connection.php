<?php

class Connection {
    private $con;

    public function __construct() {
        $this->con = mysqli_connect("localhost", "root", "", "php_gallery");
    }

    /**
     * @return false|mysqli
     */
    public function getCon()
    {
        return $this->con;
    }
}