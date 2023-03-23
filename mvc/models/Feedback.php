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

    public function checkAlreadyFeedback($stadiumId, $userId)
    {
        // Check if user already added feedback
        $query = "SELECT * FROM feedbacks WHERE stadiumId = ? AND userId = ?";
        $sth = $this->pdo->prepare($query);
        $sth->execute([$stadiumId, $userId]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return false;
        }
        return true;
    }

    public function updateFeedback($id, $rating, $description)
    {
        $query = "UPDATE feedbacks SET star = ?, description = ?, updatedAt = NOW() WHERE id = ?";
        $sth = $this->pdo->prepare($query);
        $sth->execute([$rating, $description, $id]);
        // returns true if update was successful
        return $sth->rowCount() > 0;
    }

    public function deleteFeedback($id)
    {
        $query = "DELETE FROM feedbacks WHERE id = ?";
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute([$id]);
        if ($result && $sth->rowCount() > 0) {
            return true;
        } else {
            // delete operation failed
            return false;
        }
    }

    public function countStar($stadiumId)
    {
        $query = 'SELECT star FROM feedbacks WHERE stadiumId = ?';
        $sth = $this->pdo->prepare($query);
        $sth->execute([$stadiumId]);
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        // Count star from feedbacks
        $total = 0;
        $count = count($result);
        if (count($result) == 0) {
            return 5;
        }
        foreach ($result as $feedback) {
            $total += $feedback['star'];
        }
        $average = $total / $count;

        // Round average (làm tròn giá trị trung bình)
        $rounded_average = round($average, 0);

        // if stadium not exist feedback, set star = 5
        if (!$rounded_average) {
            $rounded_average = 5;
        }

        $update_query = "UPDATE stadiums SET star = ? WHERE id = ?";
        $update_sth = $this->pdo->prepare($update_query);
        $update_sth->execute([$rounded_average, $stadiumId]);

        // returns true if update was successful
        return $update_sth->rowCount() > 0;
    }
}
