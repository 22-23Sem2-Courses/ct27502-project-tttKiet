<?php

class FeedbackController extends Controller
{
    function index()
    {
        // Feedback
        $feedback = $this->model("Feedback");
        $allFeedbacks = $feedback->getFeedback();

        // Stadium
        $stadiumsModel = $this->model('Stadium');
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
        $stadium = [];
        while ($row = $sth->fetch()) {
            if ($row['id'] == $id) {
                $stadium = $row;
                break;
            }
        }
        $orders = $stadiumsModel->getHoursOrderFromStadiumId($stadium['id']);
        $sumHours = 0.0;
        $sumOrders = count($orders);
        foreach ($orders as $order) {
            $sumHours += $order['hour'];
        }
        // print_r($sumOrders);
        // print_r($sumHours);
        $this->view("detailFeedback", ['stadium' =>  $stadium, 'sumOrders' => $sumOrders, 'sumHours' => $sumHours]);
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
                $feedback->countStar($stadiumId);
                header("Location: /feedback/stadium/{$stadiumId}");
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
                $feedback->countStar($stadiumId);
                header("Location: /feedback/stadium/{$stadiumId}");
            } else {
                echo "<script type='text/javascript'>alert('Sửa đánh giá không thành công');</script>";
            }
        }
        $feedback = $this->model("Feedback");
        $rating = [];
        foreach ($stadiums as $stadium) {
            $rating[$stadium['id']] = $feedback->countStar($stadium['id']);
        }
        $this->view("editFeedbackDetail", ['stadium' =>  $stadiums[$id - 1]]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['feedbackId'];
            $stadiumId = $_POST['stadiumId'];
            $feedback = $this->model("Feedback");
            if ($feedback->deleteFeedback($id)) {
                $feedback->countStar($stadiumId);
                return true;
            } else {
                return false;
            }
        }
    }
}
