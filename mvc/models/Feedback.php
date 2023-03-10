<?php
class Feedback extends DB
{
    public $id;
    public $star;
    public $description;
    public $created_at;
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

    public function fillFromDB(array $row)
    {
        [
            'id' => $this->id,
            'star' => $this->star,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ] = $row;
        return $this;
    }
}
