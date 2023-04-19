<?php
class Order extends DB
{
    public $id;
    public $stadiumChildrenId;
    public $userId;
    public $timeBook;
    public $hour;
    public $createdAt;
    
    public function addDataOrder($stadiumChildrenId, $userId, $timeBook, $hour) {
        $this -> stadiumChildrenId = $stadiumChildrenId;
        $this -> userId = $userId;
        $this -> timeBook = $timeBook;
        $this -> hour = $hour;
    }

    public function fillFromDB(array $row)
    {
        [
            'id' => $this->id,
            'stadiumChildrenId' => $this->stadiumChildrenId,
            'userId' => $this->userId,
            'timeBook' => $this->timeBook,
            'hour' => $this->hour,
            'createdAt' => $this->createdAt,
        ] = $row;
        return $this;
    }


    public function createOrder() {
        try {
            $query = "INSERT INTO orders (stadiumChildrenId, userId, timeBook, hour) VALUES (?, ?, ?, ?);";
            $sth = $this -> pdo -> prepare($query);
            $sth->execute(
                [
                    $this -> stadiumChildrenId,
                    $this -> userId,
                    $this -> timeBook,
                    $this -> hour,
                ]
            );

            $rowCount = $sth -> rowCount();
            if ($rowCount > 0) {
                return true;
            } 

        } catch (PDOException $e) { 
            echo $e -> getMessage();
        }
        return false;
    }
}