<?php
class Stadium extends DB
{
    public $id;
    public $name;
    public $address;
    public $phone;
    public $openTime;
    public $closeTime;
    public $star;
    public $imgLink;


    public function getAll()
    {
        $query = "SELECT * FROM stadiums";

        try {
            $sth = $this->pdo->query($query);

            return $sth;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function fillById($id)
    {
        if ($id > 0 && filter_var($id, FILTER_VALIDATE_INT)) {
            $query = 'SELECT * FROM stadiums WHERE id = ?';
            $sth = $this->pdo->prepare($query);
            $sth->execute(
                [
                    $id
                ]
            );

            if ($row = $sth->fetch()) {
                $Stadium =  new Stadium();
                $Stadium->fillFromDB($row);

                return $Stadium;
            } else {
                return -1;
            }
        }
    }

    public function getStadiumChildrens()
    {
        $stadiumChildrens = [];
        $query = 'SELECT `stadiumChildrens`.`id` as `id`, `stadiumChildrens`.`price` as `price`, `stadiumChildrens`.`type` as `type` from stadiumChildrens 
            LEFT JOIN stadiums ON `stadiumChildrens`.`stadiumId` = `stadiums`.`id`
            where `stadiums`.`id` = ?
            ';

        $sth = $this->pdo->prepare($query);
        $sth->execute(
            [
                $this->id
            ]
        );

        while ($row = $sth->fetch()) {
            $stadiumChildrens[] = $row;
        }

        return $stadiumChildrens;
    }

    public function checkBookingForChildren($idChildren, $date, $timeBook, $hour)
    {
        $query = 'SELECT `stadiumchildrens`.`id` as `id`, `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`, `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour` 
            FROM `stadiums` 
            LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
            LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
            WHERE `stadiumchildrens`.`id` = ? AND DATE(`orders`.`timeBook`) = DATE(?)';


        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute(
                [
                    $idChildren,  $date
                ]
            );

            $resultOrder = [];

            while ($row = $sth->fetch()) {
                $resultOrder[] = $row;
            }


            $freeTimes[$idChildren] = [
                [
                    'from' => $this->openTime,
                    'end' => $this->closeTime,
                ]
            ];

            foreach ($resultOrder as $result) {
                $this->bookTimeForYard($freeTimes, $idChildren, $result['timeBook'], $result['numberHour']);
            };

            $isOrder = $this->bookTimeForYard($freeTimes, $idChildren, $timeBook, $hour);


            return $isOrder;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findFreeYard($date)
    {
        $query = 'SELECT `stadiumchildrens`.`id` as `id`, `stadiumChildrens`.`price` as `price`, `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`, `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour` 
            FROM `stadiums` 
            LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
            LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
            WHERE `stadiums`.`id` = ? AND DATE(`orders`.`timeBook`) = DATE(?)';

        $sth = $this->pdo->prepare($query);
        $sth->execute(
            [
                $this->id, $date
            ]
        );

        $stadiumChildrens = $this->getStadiumChildrens();

        $resultOrder = [];
        while ($row = $sth->fetch()) {
            $resultOrder[] = $row;
        }

        $freeTimes = [];

        // Khởi tạo thời gian trống từng sân là giờ bắt đầu mở cửa và kết thúc
        foreach ($stadiumChildrens as $stadiumChildren) {
            $freeTimes[$stadiumChildren['id']] = [
                [
                    'from' => $this->openTime,
                    'end' => $this->closeTime,
                ]
            ];

            $data[] = [
                'id' => $stadiumChildren['id'],
                'type' => $stadiumChildren['type'],
                'price' => $stadiumChildren['price'],
                'free' => []
            ];
        }

        foreach ($resultOrder as $result) {
            $this->bookTimeForYard($freeTimes, $result['id'], $result['timeBook'], $result['numberHour']);
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['free'] = array_values($freeTimes[$data[$i]['id']]);
        }
        return $data;
    }

    public function bookTimeForYard(&$freeTimes, $idYard, $timeBook, $numberHour)
    {
        if ($timeBook && $timeBook) {
            $numberMinute = $numberHour * 60;

            // Thời gian bắt đầu thuê sân
            $dateTimeBookingStart = new DateTime();
            $dateTimeBookingStart->setTimestamp(strtotime($timeBook));


            // Thời gian trả sân
            $endTimestamp = strtotime($timeBook . ' +' . $numberMinute . ' minutes');
            $dateTimeBookingEnd = new DateTime();
            $dateTimeBookingEnd->setTimestamp($endTimestamp);

            // 
            // print_r($dateTimeBookingStart) ;
            for ($i = 0; $i < count($freeTimes[$idYard]); $i++) {
                $timeBookDate = new DateTime($timeBook);
                $timeBookFormat = $timeBookDate->format('Y-m-d');
                // Thời gian bắt đầu trống trong lịch
                $from = $freeTimes[$idYard][$i]['from'];
                $dateTimeStart = new DateTime($timeBookFormat . $from);

                // Thời gian kết thúc trống trong lịch
                $end = $freeTimes[$idYard][$i]['end'];
                $dateTimeEnd = new DateTime($timeBookFormat . $end);

                if ($dateTimeBookingStart >= $dateTimeStart  && $dateTimeEnd  >= $dateTimeBookingEnd) {
                    $freeTimes[$idYard][$i]['end'] = $dateTimeBookingStart->format('H:i:s');

                    // Nếu thời gian còn trống nhỏ hơn 1h => không đủ để bắtd đầu trận mới
                    // Lấy thời điểm của $dateTimeEnd dưới dạng Unix timestamp
                    $dateTimeClose  = new DateTime($timeBookFormat . $this->closeTime);
                    $timestampEnd = $dateTimeClose->getTimestamp();
                    $timestampBookingEnd = $dateTimeBookingEnd->getTimestamp();
                    if ($dateTimeEnd == $dateTimeBookingEnd && $dateTimeStart == $dateTimeBookingStart) {
                        $this->clearArrayOrderFree($freeTimes, $idYard, $i);
                        return true;
                    } else if ($timestampEnd - $timestampBookingEnd < 3600) {
                        $freeTimes[$idYard][$i] = [
                            'from' => $dateTimeStart->format('H:i:s'),
                            'end' => $dateTimeBookingStart->format('H:i:s'),
                        ];
                        $this->clearArrayOrderFree($freeTimes, $idYard, -1);
                        return true;
                    } else {
                        $freeTimes[$idYard][] = [
                            'from' => $dateTimeBookingEnd->format('H:i:s'),
                            'end' => $dateTimeEnd->format('H:i:s'),
                        ];
                        $this->clearArrayOrderFree($freeTimes, $idYard, -1);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function clearArrayOrderFree(&$freeTimes, $idYard, $j)
    {
        if ($j == -1) {
            for ($i = 0; $i < count($freeTimes[$idYard]); $i++) {
                if ($freeTimes[$idYard][$i]['from'] === $freeTimes[$idYard][$i]['end']) {

                    unset($freeTimes[$idYard][$i]);
                    $freeTimes[$idYard] = array_values($freeTimes[$idYard]);
                }
            }
        } else {
            unset($freeTimes[$idYard][$j]);
            $freeTimes[$idYard] = array_values($freeTimes[$idYard]);
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

    public function getHoursOrderFromStadiumId($stadiumId)
    {
        $query = "SELECT o.*
          FROM orders o
          JOIN stadiumChildrens sc ON o.stadiumChildrenId = sc.id
          JOIN stadiums s ON sc.stadiumId = s.id
          WHERE s.id = ?";
        $sth = $this->pdo->prepare($query);
        $sth->execute([$stadiumId]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
