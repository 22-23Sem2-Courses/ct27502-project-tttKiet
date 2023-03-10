<?php
class Feedback extends DB
{
    public $id;
    public $star;
    public $description;
    public $createdAt;
    public $updatedAt;
    public $userId;
    public $stadiumId;

    public function addFeedback($rating, $description)
    {
        try {
            $query = 'INSERT INTO feedbacks (star, description) VALUES (?, ?)';
            $sth = $this->pdo->prepare($query);
            $sth->execute(
                [
                    $rating,
                    $description
                ]
            );
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getFeedback()
    {
        try {
            $query = 'SELECT * FROM feedbacks';
            $sth = $this->pdo->query($query);

            $result = [];
            while ($row = $sth->fetch()) {
                $feedback = new Feedback();
                $feedback->fillFromDB($row);
                $result[] = $feedback;
            }
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllStadium()
    {
        try {
            $query = 'SELECT * FROM stadiums';
            $sth = $this->pdo->query($query);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function fillFromDB(array $row)
    {
        [
            'id' => $this->id,
            'star' => $this->star,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
        ] = $row;
        return $this;
    }
}
