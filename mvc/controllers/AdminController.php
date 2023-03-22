<?php

class AdminController extends Controller
{

    function index()
    {
        $this->view("listOrder");
    }

    function listOrder()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'admin') {
            // Get stadium from adminId
            $admin = $this->model('Admin');
            $ownerStadium = $admin->getStadiumFromAdminId($_SESSION['user']['id']);
            $allOrder = $admin->getOrderByStadiumId($ownerStadium[0]['id']);
            $this->view("listOrder", ['stadium' => $ownerStadium, 'allOrder' => $allOrder]);
        }
    }

    function viewByDate($viewByDate)
    {
        if (isset($viewByDate) && isset($_SESSION['user']) && $_SESSION['user']['type'] == 'admin') {
            $admin = $this->model('Admin');
            $ownerStadium = $admin->getStadiumFromAdminId($_SESSION['user']['id']);
            $openTime = $ownerStadium[0]['openTime'];
            $closeTime = $ownerStadium[0]['closeTime'];
            $stadiumId = $ownerStadium[0]['id'];
            $allOrder = $admin->getOrderByStadiumId($stadiumId);

            // Filter all order in day
            $orderInDay = array_filter($allOrder, function ($item) use ($viewByDate) {
                return substr($item['timeBook'], 0, 10) === $viewByDate;
            });

            $emptyStadium = $admin->findFreeYard($viewByDate, $openTime, $closeTime, $stadiumId);
            print_r($emptyStadium[0]);

            $this->view("listOrder", ['stadium' => $ownerStadium, 'allOrder' => $orderInDay, 'currentDate' => $viewByDate, 'emptyStadium' => $emptyStadium]);
        }
    }
}
