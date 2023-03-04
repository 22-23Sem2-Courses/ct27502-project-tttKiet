<?php 

    class DB {
        public $connect;
        protected $servername = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dbname = "football_order";

        function __construct() {
            try {
                echo 'Bắt đầu kết nối đến CSDL! ------------- ';
                $this -> connect = new PDO('mysql:host='. $this -> servername .';dbname='. $this -> dbname, $this -> username, $this -> password);
                $this -> connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'Kết nối đến CSDL thành công!';
                
            } catch (PDOException $e) {
                echo 'Không thể kết nối đến CSDL';
                exit();
            }
        }

    }

?>