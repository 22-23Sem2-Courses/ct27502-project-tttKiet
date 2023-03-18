<?php
class User extends DB
{

    public int $id;
    public string $fullName;
    public string $phone;
    public string $address;
    public string $email;
    public string $type;

    public function authenticate($email, $password) { 
    
        $query = "SELECT `id`, `fullName`, `phone`, `email`, `address`, `type`, `phone` FROM `users` WHERE `email`='{$email}' AND passWord='{$password}'";

        try {
            $sth = $this->pdo->query($query);
            $row = $sth->fetch();

            return $row;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function fillFormDb($id, $fullName, $phone, $address, $email, $type) {
        $this -> id = $id;
        $this -> fullName = $fullName;
        $this -> phone = $phone;
        $this -> address = $address;
        $this -> email = $email;
        $this -> type = $type;
    }

    public function fillOrderWithStadiumIdDISTINCT() {
        $query = 'SELECT DISTINCT `stadiums`.`id` as `stadiumId` 
                    FROM `stadiums` 
                    LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
                    LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
                    LEFT JOIN `users` ON `users`.`id` = `orders`.`userId` 
                    WHERE `orders`.`timeBook` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 5 DAY) 
                    AND `users`.`id` = ?
                    ORDER BY `orders`.`timeBook` ASC;
                ';

                
        try {
            $sth = $this -> pdo -> prepare($query);
            $sth -> execute([
                $this -> id
            ]);

            $results = [];

            while($row = $sth -> fetch()) {
                $results[] = $row;
            }

            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Default only allow view 5 days after for one Stadium
    public function getOrderByStadiumId($stadiumId) {
        $query = 'SELECT `users`.`id` as `userId` , `stadiumchildrens`.`id` as `id`,
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
                AND `users`.`id` = ?
                AND `stadiums`.`id` = ?
             ORDER BY `orders`.`timeBook` ASC
             ;';

        
        try {
            $sth = $this -> pdo -> prepare($query);
            $sth -> execute([
                $this -> id,
                $stadiumId
            ]);

            $results = [];

            while($row = $sth -> fetch()) {
                $results[] = $row;
            }

            return $results;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


}