<?php

class UserController extends Controller
{
    function index()
    {
        $this->view("home");

    }

    function login()
    {
        $this->view("login");
    }
}