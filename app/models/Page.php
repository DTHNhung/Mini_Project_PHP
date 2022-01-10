<?php

class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getData() 
    {
        $this->db->query('SELECT * FROM tbl_users');
        $this->db->execute();
        $sql = $this->db->resultSet();
        return $sql;
    }
}
?>