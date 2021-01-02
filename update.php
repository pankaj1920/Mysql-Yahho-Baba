<?php

require_once('db_connection.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $age = $_POST['age'];
    $id = $_POST['id'];

    $query = "UPDATE `personal` SET age ='$age' WHERE id='$id' ";


    $run = mysqli_query($con, $query);

    if ($run) {

        $quer = "SELECT * FROM `personal` WHERE id='$id'";
        $ru = mysqli_query($con, $quer);
        if ($ru) {
            while ($data = mysqli_fetch_assoc($ru)) {
                $response['status'] = "1";
                $response['data'] = array(
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
            $response['message'] = "Something went wrong while fetching data";
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
