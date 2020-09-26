<?php

    class DB {
        private $db_url = 'localhost';
        private $db_name = 'fullstack_test';
        private $db_user = 'root';
        private $db_password = '';
    
        private $conn = null;

        public function connect() {
            return new mysqli($this->db_url, $this->db_user, $this->db_password, $this->db_name);
        }
        
        public function __construct() {
            $this->conn = $this->connect();
        }

        public function getConn() {
            return $this->conn;
        }

    }
?>