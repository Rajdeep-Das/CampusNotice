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
        public $year;

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
                   p.year,
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

        //Get Single Post
        public function read_single()
        {
             //create query
             $query = 'SELECT
             p.id,
             p.notice,
             p.dept,
             p.year,
             p.postby,
             p.datetime
          FROM
            ' . $this->table . ' p
          WHERE
          p.id = ? 
          LIMIT 0,1' ;

          // Prepare Statement
          $stmt = $this->conn->prepare($query);

          //Bind id
          $stmt->bindParam(1,$this->id);
         
           // Execute
           $stmt->execute();

           $row = $stmt->fetch(PDO::FETCH_ASSOC);

           //Set Properties
          
           $this->notice=$row['notice'];
           $this->dept=$row['dept'];
           $this->postby=$row['postby'];
           $this->year=$row['year'];
           $this->datetime=$row['datetime'];
           

        }

    }