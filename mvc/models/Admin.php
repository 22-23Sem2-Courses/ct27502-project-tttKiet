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
}
