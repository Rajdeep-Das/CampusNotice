<?php
    class Post {
        //DB stuff
        private $conn;
        private $table = 'notice';

        //Post Properties
        public $id;
        public $notice;
        public $dept;
        public $postby;
        public $datetime;

        //constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Posts
        public function read(){
            //create query
            $query = 'SELECT
                   p.id,
                   p.notice,
                   p.dept,
                   p.postby,
                   p.datetime
                FROM
                  ' . $this->table . ' p
                ORDER BY
                p.datetime DESC' ;


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute
            $stmt->execute();

            return $stmt;
            
        }

    }