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

        public function findFreeYard($date) { 
            $query = 'SELECT `stadiumchildrens`.`id` as `id`, `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`, `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour` 
            FROM `stadiums` 
            LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
            LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
            WHERE `stadiums`.`id` = ? AND DATE(`orders`.`timeBook`) = DATE(?)';

            $sth = $this -> pdo -> prepare($query);
            $sth->execute(
                [
                    $this -> id, $date
                ]
            );

            $stadiumChildrens = $this -> getStadiumChildrens();

            $resultOrder = [];
            while($row = $sth -> fetch()) {
                $resultOrder[] = $row;
            } 

            $freeTimes = [];

            // Khởi tạo thời gian trống từng sân là giờ bắt đầu mở cửa và kết thúc
            foreach($stadiumChildrens as $stadiumChildren ) {
                $freeTimes[$stadiumChildren['id']] = [
                    [
                        'from'=> $this -> openTime,
                        'end'=> $this -> closeTime,
                    ]
                ];
            }
            // $this -> bookTimeForYard($freeTimes, 1, '2023-03-16 13:00:00', 1.5);


            foreach($resultOrder as $result ) {
               
               $this -> bookTimeForYard($freeTimes, $result['id'], $result['timeBook'],$result['numberHour']);
            }

            return $freeTimes;

        }

        public function bookTimeForYard(&$freeTimes, $idYard, $timeBook, $numberHour) {
            // echo '----' .$numberHour ;  
            // echo $freeTimes['1']['from'];

            if($timeBook && $timeBook) {
                $numberMinute = $numberHour * 60;

                // Thời gian bắt đầu thuê sân
                $dateTimeBookingStart = new DateTime(); 
                $dateTimeBookingStart -> setTimestamp(strtotime($timeBook));


                // Thời gian trả sân
                $endTimestamp = strtotime($timeBook . ' +' . $numberMinute . ' minutes');
                $dateTimeBookingEnd = new DateTime(); 
                $dateTimeBookingEnd -> setTimestamp($endTimestamp);

                // 
                // print_r($dateTimeBookingStart) ;
                for($i = 0; $i < count($freeTimes[$idYard]); $i++) {
                    $timeBookDate = new DateTime($timeBook);
                    $timeBookFormat = $timeBookDate -> format('Y-m-d');
                    // Thời gian bắt đầu trống trong lịch
                    $from = $freeTimes[$idYard][$i]['from'];
                    $dateTimeStart = new DateTime($timeBookFormat . $from); 

                    // Thời gian kết thúc trống trong lịch
                    $end = $freeTimes[$idYard][$i]['end'];
                    $dateTimeEnd = new DateTime($timeBookFormat . $end); 

                  

                    if($dateTimeBookingStart >= $dateTimeStart  && $dateTimeEnd  >= $dateTimeBookingEnd  ) {
                        $freeTimes[$idYard][$i]['end'] = $dateTimeBookingStart -> format('H:i:s');

                        // Nếu thời gian còn trống nhỏ hơn 1h => không đủ để bắtd đầu trận mới
                        $interval = $dateTimeBookingEnd -> diff($dateTimeEnd);
                        // Lấy thời điểm của $dateTimeEnd dưới dạng Unix timestamp
                        $timestampEnd = $dateTimeEnd->getTimestamp(); 
                        $timestampBookingEnd = $dateTimeBookingEnd->getTimestamp(); 
                        if($dateTimeEnd == $dateTimeBookingEnd || $timestampEnd - $timestampBookingEnd < 3600) {
                        } else {
                            $freeTimes[$idYard][] = [
                                'from' => $dateTimeBookingEnd -> format('H:i:s'),
                                'end' => $dateTimeEnd -> format('H:i:s'),
                            ];
                        }
                        break;
                       
                    }
                }

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