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
           $this->postby=$row['year'];
           $this->year=$row['postby'];
           $this->datetime=$row['datetime'];
           

        }


        // Create Post or Notice
        public function create()
        {
            //create query
            $query = 'INSERT INTO notice
            SET
              notice = :notice,
              dept = :dept,
              year = :year,
              postby= :postby';

              // Prepare Statement
              $stmt = $this->conn->prepare($query);

              //clean up data for sequrity
              $this->notice = htmlspecialchars(strip_tags($this->notice));
              $this->dept = htmlspecialchars(strip_tags($this->dept));
              $this->year = htmlspecialchars(strip_tags($this->year));
              $this->postby = htmlspecialchars(strip_tags($this->postby));

              //Bind Data
                $stmt->bindParam(':notice',$this->notice);
                $stmt->bindParam(':dept',$this->dept);
                $stmt->bindParam(':year',$this->year);
                $stmt->bindParam(':postby',$this->postby);
            // Execute query
            if($stmt->execute())
            {
                return true;
            }

            //print error if something goes wrong
            printf("Error: %s.\n",$stmt->error);
            return false;


        }

    }