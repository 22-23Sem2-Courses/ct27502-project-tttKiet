<?php

class UserController extends Controller
{
    function index()
    {
        $this->view("login");
    }
    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['email']) && isset($_POST['pass'])) {

                // echo "<script type='text/javascript'>alert('ok');</script>";
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $user = $this->model("User");

                $userDb =  $user->authenticate($email, $pass);
                if (!empty($userDb)) {
                    $_SESSION['user'] = [
                        'email' =>  $email,
                        'id' => $userDb['id'],
                        'phone' => $userDb['phone'],
                        'fullName' => $userDb['fullName'],
                        'address' => $userDb['address'],
                        'type' =>  $userDb['type']
                    ];

                    $_SESSION['loggedin'] = true;
                    header("Location: /");
                } else {
                    echo "<script type='text/javascript'>alert('sai');</script>";
                }
            }
        } else {
            $this->view("login");
        }
    }

    function register()
    {
        $errMessage = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email'])  && isset($_POST['repass']) && isset($_POST['address'])
                && isset($_POST['pass'])
            ) {
                $fullName = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $confirm = $_POST['repass'];
                $address = $_POST['address'];
                $type = 'user';

                if ($pass !== $confirm) {
                    $errMessage = 'Nhập lại mật khẩu không chính xác!';
                    $this->view("login", ['register' => true, 'errMessage' => $errMessage]);
                } else {
                    $query = 'INSERT INTO users (fullName, phone, email, passWord, address, type) VALUES (?, ?, ?, ?, ?, ?)';
                    $user = $this->model("User");

                    try {
                        $sth = $user->pdo->prepare($query);
                        $sth->execute(
                            [
                                $fullName,
                                $phone,
                                $email,
                                $pass,
                                $address,
                                $type
                            ]
                        );
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                    $this->view("login", ['register' => true, 'regDone' => true, 'errMessage' => $errMessage]);
                }
            }
        } else {
            $this->view("login", ['register' => true, 'errMessage' => $errMessage]);
        }
    }

    

    function soccerFieldBookingCalendar() {
        $user = $this -> model("User");
        if (!isset( $_SESSION['user']) || empty( $_SESSION['user'])) {
            header("Location: /");
            exit();
        } 
        $user -> fillFormDb(
                $_SESSION['user']['id'], 
                $_SESSION['user']['fullName'],
                $_SESSION['user']['phone'], 
                $_SESSION['user']['address'], 
                $_SESSION['user']['email'], 
                $_SESSION['user']['type']
        );
        $orderViews = [];
        $numberStadiumBooked = $user -> fillOrderWithStadiumIdDISTINCT();
        foreach ($numberStadiumBooked as $stadiumId) {
            // print_r($stadiumId);
            $orderOfUser = $user -> getOrderByStadiumId($stadiumId['stadiumId']);
            $orderViews[] = $orderOfUser;
        }
        // $orderOfUser
        $this -> view('myCalendar', ['order' => $orderViews]);
    }
}