<?php 
    class Database{
        private $HOST = 'localhost';
        private $NAME = 'image_app';
        private $USER = 'testUser';
        private $PASS = 'testPass';
        private $conn;

        public function connect(){
            try {
                $this->conn = new PDO("mysql:host={$this->HOST};dbname={$this->NAME}", $this->USER, $this->PASS);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (Exception $e) {
                throw $e;
            }
            return $this->conn;
        }

    }
?>