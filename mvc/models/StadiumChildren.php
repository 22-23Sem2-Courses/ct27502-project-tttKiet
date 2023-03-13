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


        public function isOrderInHourAndDay($date, $hour, $numberHour) {
            $query = 'SELECT `stadiumchildrens`.`id` as `id`, `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`, `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour` 
            FROM `stadiums` 
            LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
            LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
            WHERE `stadiumchildrens`.`id` = ? AND DATE(`orders`.`timeBook`) = DATE(?)';

            $sth = $this -> pdo -> prepare($query);
            $sth -> execute(
                [
                    $this -> id, $date
                ]
            );
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