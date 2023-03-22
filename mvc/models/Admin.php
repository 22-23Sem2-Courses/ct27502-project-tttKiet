<?php
class Admin extends DB
{
    public $id;
    public $fullName;
    public $phone;
    public $address;
    public $email;
    public $type;

    public function getStadiumFromAdminId($id)
    {
        $query = 'SELECT stadiums.*
          FROM stadiums
          INNER JOIN users ON stadiums.userId = users.id
          WHERE users.id = ?';

        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute([$id]);

            $results = [];

            while ($row = $sth->fetch()) {
                $results[] = $row;
            }

            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getInfomationUserFromUserId($userId)
    {
        $query = 'SELECT * FROM users WHERE id = ?';

        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute([$userId]);

            $results = [];

            while ($row = $sth->fetch()) {
                $results[] = $row;
            }

            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getOrderByStadiumId($stadiumId)
    {
        $query = 'SELECT `users`.`id` as `userId`, `users`.`fullName` as `userName`, `users`.`email` as `userEmail`,
            `users`.`phone` as `userPhone` , `stadiumchildrens`.`id` as `id`,
            `orders`.`createdAt` as `createdAt`,
            `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`,
            `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour`,
            `stadiums`.`name` as `stadiumName`, `stadiums`.`address` as `address`,
            `stadiums`.`phone` as `phone`
             FROM `stadiums` 
             LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
             LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
             LEFT JOIN `users` ON `users`.`id` = `orders`.`userId`
             WHERE `orders`.`timeBook` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 5 DAY) 
                AND `stadiums`.`id` = ?
             ORDER BY `orders`.`timeBook` ASC
             ;';


        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute([
                $stadiumId
            ]);

            $results = [];

            while ($row = $sth->fetch()) {
                $results[] = $row;
            }

            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getStadiumChildrens($stadiumId)
    {
        $stadiumChildrens = [];
        $query = 'SELECT `stadiumChildrens`.`id` as `id`, `stadiumChildrens`.`price` as `price`, `stadiumChildrens`.`type` as `type` from stadiumChildrens 
        LEFT JOIN stadiums ON `stadiumChildrens`.`stadiumId` = `stadiums`.`id`
        where `stadiums`.`id` = ?
        ';

        $sth = $this->pdo->prepare($query);
        $sth->execute(
            [
                $stadiumId,
            ]
        );

        while ($row = $sth->fetch()) {
            $stadiumChildrens[] = $row;
        }

        return $stadiumChildrens;
    }

    public function findFreeYard($date, $openTime, $closeTime, $stadiumId)
    {
        $query = 'SELECT `stadiumchildrens`.`id` as `id`, `stadiumChildrens`.`price` as `price`, `stadiumchildrens`.`type` as `type`, `stadiumchildrens`.`price` as `price`, `orders`.`id` as `order.id`, `orders`.`timeBook` as `timeBook`, `orders`.`hour` as `numberHour` 
        FROM `stadiums` 
        LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
        LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
        WHERE `stadiums`.`id` = ? AND DATE(`orders`.`timeBook`) = DATE(?)';

        $sth = $this->pdo->prepare($query);
        $sth->execute(
            [
                $stadiumId, $date
            ]
        );

        $stadiumChildrens = $this->getStadiumChildrens($stadiumId);

        $resultOrder = [];
        while ($row = $sth->fetch()) {
            $resultOrder[] = $row;
        }

        $freeTimes = [];

        // Khởi tạo thời gian trống từng sân là giờ bắt đầu mở cửa và kết thúc
        foreach ($stadiumChildrens as $stadiumChildren) {
            $freeTimes[$stadiumChildren['id']] = [
                [
                    'from' => $openTime,
                    'end' => $closeTime,
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
            $this->bookTimeForYard($freeTimes, $result['id'], $result['timeBook'], $result['numberHour'], $closeTime);
        }

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['free'] = array_values($freeTimes[$data[$i]['id']]);
        }
        return $data;
    }

    public function bookTimeForYard(&$freeTimes, $idYard, $timeBook, $numberHour, $closeTime)
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
                    $dateTimeClose  = new DateTime($timeBookFormat . $closeTime);
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
}
