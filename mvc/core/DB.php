<?php 

    class DB {
        public $pdo;
        protected $servername = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dbname = "football_order";

        function __construct() {
            try {
                $this -> pdo = new PDO('mysql:host='. $this -> servername .';dbname='. $this -> dbname, $this -> username, $this -> password);
                $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                echo 'Không thể kết nối đến CSDL';
                exit();
            }
        }

    }

?>