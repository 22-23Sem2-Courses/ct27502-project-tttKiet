<?php

class FeedbackController extends Controller
{
    function index()
    {
        // Feedback
        $feedback = $this->model("Feedback");
        $allFeedbacks = $feedback->getFeedback();

        // Stadium
        $stadiumsModel = $this->model('stadium');
        $sth = $stadiumsModel->getAll();
        $stadiums = [];
        while ($row = $sth->fetch()) {
            $stadiums[] = $row;
        }

        $this->view("feedback", ['feedbacks' => $allFeedbacks, 'stadiums' =>  $stadiums]);
    }

    function stadium($id)
    {
        if ($id <= 0 || filter_var($id, FILTER_VALIDATE_INT) == false) {
            header("Location: /");
        }
        // Stadium
        $stadiumsModel = $this->model('stadium');
        $sth = $stadiumsModel->getAll();
        $stadiums = [];
        while ($row = $sth->fetch()) {
            $stadiums[] = $row;
        }
        $this->view("detailFeedback", ['stadium' =>  $stadiums[$id - 1]]);
    }



    function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'];
            $description = $_POST['description'];
            $stadiumId = $_POST['stadiumId'];
            $userId = $_POST['userId'];
            $feedback = $this->model("Feedback");
            if ($feedback->addFeedback($rating, $description, $stadiumId, $userId)) {
                echo "<script type='text/javascript'>alert('Thêm feedback thành công');</script>";
                header("Location: /feedback");
            } else {
                echo "<script type='text/javascript'>alert('Bạn đã thêm feedback cho sân này rồi');</script>";
            }
        } else {
            $this->view("feedback");
        }
    }

    function update($id)
    {
        if ($id <= 0 || filter_var($id, FILTER_VALIDATE_INT) == false) {
            header("Location: /");
        }
        // Stadium
        $stadiumsModel = $this->model('stadium');
        $sth = $stadiumsModel->getAll();
        $stadiums = [];
        while ($row = $sth->fetch()) {
            $stadiums[] = $row;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'];
            $description = $_POST['description'];
            $feebackId = $_POST['feedbackId'];
            $stadiumId = $_POST['stadiumId'];
            $feedback = $this->model("Feedback");
            if ($feedback->updateFeedback($feebackId, $rating, $description)) {
                // $_SESSION['updatedFeeback'] = [
                //     'id' =>  $feebackId,
                //     'updated' => true,
                // ];
                header("Location: /feedback/stadium/{$stadiumId}");
            } else {
                echo "<script type='text/javascript'>alert('Sửa đánh giá không thành công');</script>";
            }
        }
        $this->view("editFeedbackDetail", ['stadium' =>  $stadiums[$id - 1]]);
    }

    public function delete()
    {
        $data = $_POST['name'];
        echo "$data";
    }
}
