<?php
    class Admin extends Database{
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }
    }
?>