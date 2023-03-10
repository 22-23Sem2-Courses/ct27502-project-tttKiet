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
                        'fullName' => $userDb['fullName'],
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
}
