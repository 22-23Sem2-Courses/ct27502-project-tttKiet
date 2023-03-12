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

    public function addFeedback($rating, $description, $stadiumId, $userId)
    {
        // Check if user already added feedback
        $query = "SELECT * FROM feedbacks WHERE stadiumId = ? AND userId = ?";
        $sth = $this->pdo->prepare($query);
        $sth->execute([$stadiumId, $userId]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return false;
        }

        try {
            $query = 'INSERT INTO feedbacks ( star, description, userId, stadiumId) VALUES ( ?, ?, ?, ?)';
            $sth = $this->pdo->prepare($query);
            $sth->execute(
                [
                    $rating,
                    $description,
                    $userId,
                    $stadiumId,
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


    public function getFeedbackWithStadiumId($stadiumId)
    {
        // $query = "SELECT * FROM feedbacks WHERE stadiumId = ?";

        $query = "SELECT f.*, u.fullName as userName 
              FROM feedbacks f
              JOIN users u ON f.userId = u.id
              WHERE f.stadiumId = ?
              ORDER BY f.createdAt DESC
              ";

        try {
            $sth = $this->pdo->prepare($query);
            $sth->execute([$stadiumId]);
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function fillFromDB(array $row)
    {
        [
            'id' => $this->id,
            'star' => $this->star,
            'description' => $this->description,
            'stadiumId' => $this->stadiumId,
            'createdAt' => $this->createdAt,
        ] = $row;
        return $this;
    }
}
