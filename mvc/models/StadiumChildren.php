<?php
    class StadiumChildren extends DB {
        
        public $id;
        public $stadiumId ;
        public $price;
        public $type;
        public function fillById($id) { 
            if($id > 0 && filter_var($id, FILTER_VALIDATE_INT)){
                $query = 'SELECT * FROM stadiumchildrens WHERE id = ?';
                $sth = $this -> pdo -> prepare($query);
                $sth->execute(
                    [
                        $id
                    ]
                );

                if($row = $sth -> fetch()) {
                   $stadiumChildren =  new StadiumChildren();
                   $stadiumChildren -> fillFromDB($row);
                   return $stadiumChildren;
                } else {
                    return -1;
                }
            }
        }

        public function fillFromDB(array $row)
        {
            [
                'id' => $this->id,
                'stadiumId' => $this->stadiumId,
                'price' => $this->price,
                'type' => $this->type,
            ] = $row;
            return $this;
        }
    }
?>