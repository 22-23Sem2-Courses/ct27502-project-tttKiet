<?php

class UserController extends Controller
{
    function index()
    {
        $this->view("login");

    }
    function login()
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['email']) && isset($_POST['pass']) ) {
               
                // echo "<script type='text/javascript'>alert('ok');</script>";
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $user = $this->model("User");

                $userDb =  $user -> authenticate($email, $pass);
                if(!empty($userDb)) {
                    // echo "<script type='text/javascript'>alert('$userDb');</script>";
                    //  $this->view("login", [
                    //     'user' => $userDb,
                    //  ]);
                    // print_r($userDb);
                    // header("Location: /");

                    $_SESSION['user'] = [
                        'email' =>  $email,
                        'fullName' => $userDb -> fullName,
                        'type' =>  $userDb -> type
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
}