<?php

class UserController extends Controller
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