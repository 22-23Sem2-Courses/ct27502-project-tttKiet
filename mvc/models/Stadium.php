<?php
    class Stadium extends DB {
        public $id;
        public $name;
        public $address;
        public $phone;
        public $openTime;
        public $closeTime;
        public $star;
        public $imgLink;

        
        public function getAll() {
            $query = "SELECT * FROM stadiums";
         
            try {
                $sth = $this -> pdo -> query($query);

                return $sth ;
            } catch (PDOException $e) {
               echo "Error: " . $e->getMessage();			
            }
        }

        public function fillById($id) { 
            if($id > 0 && filter_var($id, FILTER_VALIDATE_INT)){
                $query = 'SELECT * FROM stadiums WHERE id = ?';
                $sth = $this -> pdo -> prepare($query);
                $sth->execute(
                    [
                        $id
                    ]
                );

                if($row = $sth -> fetch()) {
                   $Stadium =  new Stadium();
                   $Stadium -> fillFromDB($row);

                   return $Stadium;
                } else {
                    return -1;
                }
            }
        }

        public function getStadiumChildrens() {
            $stadiumChildrens = [];

            $query = 'SELECT `stadiumChildrens`.`id` as `id` from stadiumChildrens 
            LEFT JOIN stadiums ON `stadiumChildrens`.`stadiumId` = `stadiums`.`id`
            where `stadiums`.`id` = ?
            ';

            $sth = $this -> pdo -> prepare($query);
            $sth->execute(
                [
                    $this -> id
                ]
            );


            while($row = $sth -> fetch()) {
                $stadiumChildrens[] = $row;
            } 

            return $stadiumChildrens;
        }

        public function findFreeYard() { 
            $this -> openTime;
            $this -> closeTime;

            $query = 'SELECT `stadiumchildrens`.`id` as `id`, `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`, `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour` 
            FROM `stadiums` 
            LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
            LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
            WHERE `stadiums`.`id` = ?';

            $sth = $this -> pdo -> prepare($query);
            $sth->execute(
                [
                    1
                ]
            );

            $stadiumChildrens = $this -> getStadiumChildrens();

            $resultOrder = [];
            while($row = $sth -> fetch()) {
                $resultOrder[] = $row;
            } 

            // print_r($stadiumChildrens);  
            $freeTime = [];
            foreach($stadiumChildrens as $stadiumChildren ) {
                $freeTime[$stadiumChildren['id']] = [
                    'from'=> $this -> openTime,
                    'end'=> $this -> closeTime,
                ];
            }

            // print_r($freeTime);
            foreach($resultOrder as $result ) {
               print_r($result);
               
               $this -> bookTimeForYard($freeTime, $result['id'], $result['timeBook'],$result['numberHour']);
            }
        }

        public function bookTimeForYard(&$freeTime, $idYard, $timeBook, $numberHour) {
            if($timeBook && $timeBook) {
// ------------------------------dang xu ly
                echo "Book: " . $timeBook;
                echo "numberHour: " . $numberHour;
            }
            
        }

        public function fillFromDB(array $row)
        {
            [
                'id' => $this->id,
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
                'openTime' => $this->openTime,
                'closeTime' => $this->closeTime,
                'star' => $this->star,
                'imgLink' => $this->imgLink,
            ] = $row;
            return $this;
        }
        
    }
?>