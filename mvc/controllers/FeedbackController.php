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

    function stadium()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $idDetail = intval(substr($url, -1));

        // Stadium
        $stadiumsModel = $this->model('stadium');
        $sth = $stadiumsModel->getAll();
        $stadiums = [];
        while ($row = $sth->fetch()) {
            $stadiums[] = $row;
        }
        $this->view("detailFeedback", ['stadium' =>  $stadiums[$idDetail]]);
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
}
