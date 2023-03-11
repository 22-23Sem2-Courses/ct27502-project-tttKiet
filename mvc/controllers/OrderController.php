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

    
    public function book($id) {
        $stadiumModel = $this -> model('Stadium');
        $filterStadium = $stadiumModel -> fillById($id);
        
        $this->view("book");
    }

    public function filterEmptyYard($dateValue) {
        $date = isset($dateValue) ? $dateValue : null;
        $stadiumModel = $this -> model('Stadium');
        $stadiumModel = $stadiumModel -> fillById(1);
        $stadiumModel -> findFreeYard();
        // echo json_encode($stadiumModel -> findFreeYard());

        // $orderArray = $orderModel -> getAllOrderInDay($date);
        
        // if(count($orderArray) == 0) {
        //    echo json_encode([
        //     'code' => 1,
        //     'message' => 'Không có lịch nào trong ngày này!'
        //    ]);
        //    exit();
        // }
        
        // $orderData = array();
        // foreach ($orderArray as $order) {
        //     $orderData[] = array(
        //         'id' => $order->id,
        //         'stadiumChildrenId' => $order->stadiumChildrenId,
        //         'userId' => $order->userId,
        //         'timeBook' => $order->timeBook,
        //         'hour' => $order->hour,
        //         'createdAt' => $order->createdAt
        //     );
        // }
        
        // $jsonData = json_encode([
        //     'code' => 0,
        //     'message' => 'Success!!!',
        //     'order' => $orderData
        //    ]);
        // header('Content-Type: application/json');
        // echo $jsonData;

        exit();
    }

}