<?php

class AdminController extends Controller
{

    function index()
    {
        $this->view("listOrder");
    }

    function viewByDate($viewByDate = null)
    {
        if (is_null($viewByDate)) {
            $viewByDate = date('Y-m-d');
        }
        if (isset($viewByDate) && isset($_SESSION['user']) && $_SESSION['user']['type'] == 'admin') {
            $admin = $this->model('Admin');
            $stadium = $this->model('Stadium');
            $ownerStadium = $admin->getStadiumFromAdminId($_SESSION['user']['id']);
            $stadiumId = $ownerStadium[0]['id'];
            $allOrder = $admin->getOrderByStadiumId($stadiumId);
            $stadiumOwner = $stadium->fillById($stadiumId);

            // Filter all order in day
            $orderInDay = array_filter($allOrder, function ($item) use ($viewByDate) {
                return substr($item['timeBook'], 0, 10) === $viewByDate;
            });


            $emptyStadium = $stadiumOwner->findFreeYard($viewByDate);

            $this->view("listOrder", ['stadium' => $ownerStadium, 'allOrder' => $orderInDay, 'currentDate' => $viewByDate, 'emptyStadium' => $emptyStadium]);
        }
    }
}
