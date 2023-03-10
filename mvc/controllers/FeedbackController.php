<?php

class FeedbackController extends Controller
{
    function index()
    {

        $feedback = $this->model("Feedback");
        $allFeedbacks = $feedback->getFeedback();
        $this->view("feedback", ['feedbacks' => $allFeedbacks]);
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['rating']) && isset($_POST['description'])) {
                $rating = $_POST['rating'];
                $description = $_POST['description'];
                $feedback = $this->model("Feedback");
                if ($feedback->addFeedback($rating, $description)) {
                    echo "<script type='text/javascript'>alert('Thêm feedback thành công');</script>";
                    header("Location: /feedback");
                } else {
                    echo "<script type='text/javascript'>alert('Thêm feedback k thành công');</script>";
                }
            }
        } else {
            $this->view("feedback");
        }
    }
}
