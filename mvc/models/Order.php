<?php
class Order extends DB
{
    public $id;
    public $stadiumChildrenId;
    public $userId;
    public $timeBook;
    public $hour;
    public $createdAt;
    

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

    public function getAllOrderInDay($date) {
        try {
            $query = "SELECT * FROM orders WHERE DATE(timeBook) = DATE(?)";
            $sth = $this -> pdo -> prepare($query);
            $sth->execute(
                [
                    $date,
                ]
            );

            $result = [];
            while($row = $sth->fetch()) {
                // var_dump($row);
                $order = new Order();
                $order  -> fillFromDB($row);
                $result[] = $order;
            }
            return $result;

        } catch (PDOException $e) { 
            echo $e -> getMessage();
        }
    }
}