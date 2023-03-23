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
                $user = $this -> model("User");
                $userDb =  $user -> authenticate($email, $pass);
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
                    $this -> view('login',[ 
                        'error' => 'Email hoặc mật khẩu không chính xác!'
                    ]);
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

    function details($idBill) {
        $user = $this -> model("User");
        if (!isset( $_SESSION['user']) || empty( $_SESSION['user'])) {
            header("Location: /");
            exit();
        } 
 
        $user -> fillFromDb(
            $_SESSION['user']['email']
        );
        header('Content-Type: application/json');

        $orderViews = [];
        $numberStadiumBooked = $user -> fillOrderWithStadiumIdDISTINCT();
        
        foreach ($numberStadiumBooked as $stadiumId) {
            $orderOfUser = $user -> getOrderByStadiumId($stadiumId['stadiumId']);
            $orderViews[] = $orderOfUser;
        }

        $foundOrder = [];

        foreach ( $orderViews as $orderView) {
            $foundOrder =  array_values(array_filter($orderView, function($order) use ($idBill) {
                return $order['order.id'] == $idBill;
            }));
            if (!empty($foundOrder)) {
                $jsonData = json_encode([
                    'code' => 0,
                    'message' => 'Success!!!',
                    'data' => $foundOrder
                ]);
                echo $jsonData;
                exit();
            }
            
        }
       
        $jsonData = json_encode([
            'code' => 1,
            'message' => 'Error!!!',
        ]);
        echo $jsonData;
        exit();
        
    }


    function soccerFieldBookingCalendar() {
        $user = $this -> model("User");
        if (!isset( $_SESSION['user']) || empty( $_SESSION['user'])) {
            header("Location: /");
            exit();
        } 
        
        $user -> fillFromDb($_SESSION['user']['email']);

        $orderViews = [];
        $numberStadiumBooked = $user -> fillOrderWithStadiumIdDISTINCT();
        // [['stadiumId'] => 1]
        foreach ($numberStadiumBooked as $stadiumId) {
            $orderOfUser = $user -> getOrderByStadiumId($stadiumId['stadiumId']);
            $orderViews[] = $orderOfUser;
        }
        // print_r($numberStadiumBooked );  
        $this -> view('myCalendar', ['order' => $orderViews]);
    }

    function changeInfo($post) {
        
        header('Content-Type: application/json');
        if( isset($post['phone']) && isset($post['address'])) {
            $user =  $this -> model('user');
            $user -> fillFromDb($_SESSION['user']['email']);
            $user -> changeInfo($post['phone'], $post['address']);
            $jsonData = json_encode([
                'code' => 0,
                'message' => 'Đã thay đổi thông tin thành công!',
                
            ]);
            echo $jsonData;
            exit();
        } else {
            $jsonData = json_encode([
                'code' => 2,
                'message' => 'Có lỗi cuối cùng xảy ra!',
            ]);
            echo $jsonData;
            exit();
        }
    }

    function changePassword($post) {
        
        header('Content-Type: application/json');
        
        if( isset($post['password']) && isset($post['new-password'])  ) {
            $user =  $this -> model('user');
            $user -> fillFromDb($_SESSION['user']['email']);
            $result = $user -> changePassword($post['password'], $post['new-password']);
           
            if($result == 1) {

                $jsonData = json_encode([
                    'code' => 0,
                    'message' => 'Đổi mật khẩu thành công!',
                    
                ]);
                echo $jsonData;
                exit();
            } else if($result == 0) {
                $jsonData = json_encode([
                    'code' => 2,
                    'message' => 'Mật khẩu mới không được trùng với mật khẩu cũ!',
                    
                ]);
                echo $jsonData;
                exit();
            } else if($result == -1) {
                $jsonData = json_encode([
                    'code' => 3,
                    'message' => 'Mật khẩu nhập không chính xác!',
                    
                ]);
                echo $jsonData;
                exit();
            }
        } else {
        }
        $jsonData = json_encode([
            'code' => 1,
            'message' => 'Có lỗi cuối cùng xảy ra!',
        ]);
        echo $jsonData;
        exit();
    }

    function account() {
        if(!isset($_SESSION['user']) || empty($_SESSION['user'])) {
         header('Location: /');
        }
        $this -> view('myAccount');
    }
}