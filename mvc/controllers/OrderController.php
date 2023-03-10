<?php

class OrderController extends Controller
{
    function index()
    {
        $stadiumsModel = $this -> model('stadium');
        $sth = $stadiumsModel -> getAll();
        $stadiums = [];
        while($row = $sth->fetch()) {
            $stadiums[] = $row;
        }

        $this->view("order", ['stadiums' =>  $stadiums ]);

    }

}