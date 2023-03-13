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
        if($id <= 0 || filter_var($id, FILTER_VALIDATE_INT) == false) {
            header('Location: /');
        }
        $stadiumModel = $this -> model('Stadium');
        $filterStadium = $stadiumModel -> fillById($id);
        $this->view("book", [
            'stadium' => $filterStadium,
        ]);
    }

    public function filterEmptyYard($stadiumId, $dateValue) {
        if(!$stadiumId || !$dateValue) {
            $jsonData = json_encode([
                'code' => 1,
                'message' => 'Error! Missing StadiumId and DateValue!',
               ]);
            echo $jsonData;
            exit();
        }
        $stadiumModel = $this -> model('Stadium');
        $stadiumModel = $stadiumModel -> fillById($stadiumId);
        $freeTimes = $stadiumModel -> findFreeYard($dateValue);

        $jsonData = json_encode([
            'code' => 0,
            'message' => 'Success!!!',
            'order' => $freeTimes
           ]);
        header('Content-Type: application/json');
        echo $jsonData;

        exit();
    }

    // Post request

    public function booking($pa) {

        [
            'dateValue' => $dateValue,
            'hourTimeBook' => $hourTimeBook,
            'numberHour' => $numberHour,
            'stadiumChildrenId' => $stadiumChildrenId,
            'userId' => $userId,
        ] = $pa;

        $stadiumChildren = $this -> model('StadiumChildren');
        $stadiumChildren = $stadiumChildren -> fillById($stadiumChildrenId);
        
        header('Content-Type: application/json');

        if($stadiumChildren !== -1) {
            $stadium = $this -> model('Stadium');
            $stadium = $stadium -> fillById($stadiumChildren -> stadiumId);
            if($stadium !== -1) {
                $isOrder = $stadium -> checkBookingForChildren($stadiumChildrenId, $dateValue, $hourTimeBook, $numberHour);
               if($isOrder) {
                    $Order = $this -> model('Order');
                    $dateFormat = new DateTime($dateValue . $hourTimeBook);
                    $date = $dateFormat -> format('Y-m-d H:i:s');
                    
                    $Order -> addDataOrder($stadiumChildrenId, $userId, $date, $numberHour);
                    
                    // $test = $Order -> createOrder();
                    // $jsonData = json_encode($test);
                    // echo $jsonData;
                    // exit();
                    $isSuccess  = $Order -> createOrder();
                    if($isSuccess) {
                        $jsonData = json_encode([
                            'code' => 0,
                            'message' => 'Success!!!',
                        ]);
                        echo $jsonData;
                        exit();
                    } else {
                        $jsonData = json_encode([
                            'code' => 1,
                            'message' => 'Error!!! Insert Order',
                        ]);
                        echo $jsonData;
                        exit();
                    }
               }
            }

        }

        $jsonData = json_encode([
            'code' => 2,
            'message' => 'Lỗi!! Giờ này sân đã được đặt!',
        ]);
        echo $jsonData;
        exit();
    }

}