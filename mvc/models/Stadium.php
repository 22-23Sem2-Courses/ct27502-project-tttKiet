<?php
    class Stadium extends DB {
        
        public function getAll() {
            $query = "SELECT * FROM stadiums";
         
            try {
                $sth = $this -> pdo -> query($query);

                return $sth ;
            } catch (PDOException $e) {
               echo "Error: " . $e->getMessage();			
            }
        }
        
    }
?>