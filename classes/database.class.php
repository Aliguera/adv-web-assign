<?php
    class Database{
        private $username = "aligao";
        private $password = "";
        private $dbhost = "localhost";
        private $dbname = "help_people";
        protected $connection;
        
        public function __construct(){
            $this -> username = getenv("dbuser");
            $this -> password = getenv("dbpassword");
            $this -> dbhost = getenv("dbhost");
            $this -> dbname = getenv("dbname");
            $this -> connection = mysqli_connect('localhost', 'aligao', '', 'help_people');
            // $this -> connection = mysqli_connect($this -> dbhost, $this -> username, $this -> password, $this -> dbname);
        }
        
    }
?>