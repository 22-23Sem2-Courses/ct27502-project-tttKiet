<?php

class User extends Controller
{
    function index()
    {
        $this->view("login");
    }

    function login()
    {
        $this->view("login");
    }
}