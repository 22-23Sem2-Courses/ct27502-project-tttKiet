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

}