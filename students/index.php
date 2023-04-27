<?php
    // Set headers to allow cross-origin requests
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

    $method = $_SERVER['REQUEST_METHOD'];
    $data = [
        [            
            "name" => "Juan Dela Cruz",
            "course" => "BEED"
        ],
        [            
            "name" => "Pepito Manaloto",
            "course" => "AB PolSci"
        ],
        [            
            "name" => "Renmark Salalila",
            "course" => "BSIT"
        ]
    ];



    if($method == "GET") {        
        if(isset($_GET['id'])) {
            if(isset($data[$_GET['id']]))
                echo json_encode($data[$_GET['id']]);
            else
                echo json_encode('No Record Found!');
        }
        else
            echo json_encode($data);
    }

    if($method == "POST") {
        $temp = urldecode(file_get_contents('php://input'));
        parse_str($temp, $value);

        array_push($data, ["name" => $value['name'], "course" => $value['course']]);
 
        $response = [
            "message" => "Post Success",
            "data" => $data
        ];
        echo json_encode($response);
    }

    if($method == "PUT") {
        if(isset($_GET['id'])) {
            if(isset($data[$_GET['id']])) {
                $temp = urldecode(file_get_contents('php://input'));
                parse_str($temp, $value);
     
                $data[$_GET['id']]['name'] = $value['name'];
                $data[$_GET['id']]['course'] = $value['course'];

                $response = [
                    "message" => "Put Success",
                    "data" => $data
                ];
                echo json_encode($response);
            }                
            else {
                echo json_encode('No Record Found!');
            }
        }
        else        
            echo json_encode('No Record Found!');
    }

    if($method == "DELETE") {
        if(isset($_GET['id'])) {
            if(isset($data[$_GET['id']])) {
                unset($data[$_GET['id']]);
                
                $response = [
                    "message" => "Delete Success",
                    "data" => $data
                ];
                echo json_encode($response);
            }                
            else {
                echo json_encode('No Record Found!');
            }
        }
        else        
            echo json_encode('No Record Found!');
    }


?>