<?php 

    class Home extends Controller {
        function index() {
            echo 'Home page!';
            $user = $this -> model('User');
        }
    }
?>