<?php

require_once('db_connection.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // AND OR and NOT

    // $query = "SELECT * FROM `personal` WHERE age<='20' AND gender='M'";
    $query = "SELECT * FROM `personal` WHERE (city='Bophal' OR city='Agra') AND gender='M' ";
    // $query = "SELECT * FROM `personal` WHERE NOT city='Bophal' " ;

    $run = mysqli_query($con, $query);

    if ($run) {

        while ($data = mysqli_fetch_assoc($run)) {
            $response['status'] = "1";
            $response['data'][] = array(
                "id" => $data['id'],
                "name" => $data['name'],
                "age" => $data['age'],
                "gender" => $data['gender'],
                "mobile" => $data['mobile'],
                "city" => $data['city']
            );
        }
    } else {
        $response['status'] = "0";
        $response['message'] = "Something went wrong";
    }
    
} else {
    $response['status'] = "0";
    $response['message'] = "Invalid Method Selected";
}

echo json_encode($response);
