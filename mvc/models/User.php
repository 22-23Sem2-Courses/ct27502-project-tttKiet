<?php
class User extends DB
{

    public int $id;
    public string $fullName;
    public string $phone;
    public string $passwork;
    public string $address;
    public string $email;
    public string $type;

    public function authenticate($email, $password) { 
    
        $query = "SELECT `id`, `fullName`, `phone`, `email`, `address`, `type`, `phone` FROM `users` WHERE `email`=? AND passWord=?";

        try {
            $sth = $this->pdo->prepare($query);
            $sth -> execute([
                $email, $password
            ]);
            $row = $sth->fetch();

            return $row;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function addDataUser(
        $fullName,
        $phone,
        $email,
        $pass,
        $address,
    ) {
        $this -> fullName = $fullName;
        $this -> phone = $phone;
        $this -> email = $email;
        $this -> passwork = $pass;
        $this ->  address = $address;
        $this ->  type = 'user';
    }


    public function fillFromDb($email) {
        $query = "SELECT * FROM `users` WHERE `email`='{$email}'";

        try {
            $sth = $this -> pdo -> query($query);

            if($sth -> rowCount() == 1) {
                $row = $sth -> fetch();

                $this -> id = $row['id'];
                $this -> fullName = $row['fullName'];
                $this -> phone = $row['phone'];
                $this -> address = $row['address'];
                $this -> email = $row['email'];
                $this -> type = $row['type'];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        
    }

    function checkExists() {
        $query = 'SELECT * FROM users WHERE `email` = ?';

        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute(
                [
                    $this -> email,
                ]
            );


            return $sth -> rowCount() == 1 ? true  : false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function create() {
        $query = 'INSERT INTO users (fullName, phone, email, passWord, address, type) VALUES (?, ?, ?, ?, ?, ?)';
        if($this -> checkExists()) {
            return 0;
        }
        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute(
                [
                    $this -> fullName,
                    $this -> phone,
                    $this -> email,
                    $this -> passwork,
                    $this ->  address,
                    $this ->  type
                ]
            );

            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return 0;

    }

    function saveWithSession() {
        $_SESSION['user'] = [
            'email' =>  $this -> email,
            'id' => $this -> id,
            'phone' => $this -> phone,
            'fullName' => $this -> fullName,
            'address' => $this -> address,
            'type' =>  $this -> type,
        ];
    }

    function changeInfo($phone, $address) {
        $query = "UPDATE `users` SET `phone` = ?, `address` = ? where `id` = ?";

        try {
            $sth = $this -> pdo -> prepare($query);
            $sth -> execute([
                $phone,
                $address,
                $this -> id,
            ]);
            $this -> phone = $phone;
            $this -> address = $address;
            $this -> saveWithSession();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function changePassword($password, $newPassword) {
        $query = "SELECT * FROM `users` WHERE `id`= ? AND `passWord` = ? ";

        try {
            $sth = $this -> pdo -> prepare($query);
            $sth -> execute([
                $this -> id,
                $password
            ]);
            if($sth -> rowCount() == 1) {
                $query = "UPDATE `users` SET `passWord` = ? where `id` = ?";
                $sth = $this -> pdo -> prepare($query);

                try {
                    $sth -> execute([
                        $newPassword,
                        $this -> id,
                    ]);
                    if($sth -> rowCount() == 1) {
                        return 1;
                    } else {
                        return 0;
                    }

                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

            } else {
                return -1;
            }

            return 0;
           
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function fillOrderWithStadiumIdDISTINCT() {
        $query = 'SELECT DISTINCT `stadiums`.`id` as `stadiumId` 
                    FROM `stadiums` 
                    LEFT JOIN `stadiumchildrens` ON `stadiums`.`id` = `stadiumchildrens`.`stadiumId` 
                    LEFT JOIN `orders` ON `orders`.`stadiumchildrenId` = `stadiumchildrens`.`id` 
                    LEFT JOIN `users` ON `users`.`id` = `orders`.`userId` 
                    WHERE `orders`.`timeBook` BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 5 DAY) 
                    AND `users`.`id` = ?
                    ORDER BY STR_TO_DATE(`orders`.`timeBook`, "%Y-%m-%d %H:%i:%s") ASC
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
             ORDER BY STR_TO_DATE(`orders`.`timeBook`, "%Y-%m-%d %H:%i:%s") ASC
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