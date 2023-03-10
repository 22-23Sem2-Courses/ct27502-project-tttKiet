<?php
    class User extends DB {
        
        public function authenticate($email, $password) {
            $query = "SELECT fullName, phone, email, type FROM users WHERE email='{$email}' AND passWord='{$password}'";
         
            try {
                $sth = $this -> pdo -> query($query);
                $row = $sth -> fetch();

                return $row;
            } catch (PDOException $e) {
               echo "Error: " . $e->getMessage();			
            }
        }
    }
