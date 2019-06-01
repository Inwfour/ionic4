<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8");

    include "library/config.php";

    $postjson = json_decode(file_get_contents('php://input'), true);
    $today    = date('Y-m-d');
   

    if($postjson['aksi']=='add') {
        $id = "2";
        $query = mysqli_query($mysqli, "INSERT INTO master_customer SET
            id = '',
            name_customer = '$postjson[name_customer]',
            desc_customer = '$postjson[desc_customer]',
            created_at    = '$today'
        ");

        // $idcust = mysqli_query($mysqli);

        if($query) $result = json_encode(array('success'=>true, 
        // 'customerid'=>$idcust
    ));
        else $result = json_encode(array('success'=>false));

        echo $result;
    };

    if($postjson['aksi']=='getdata'){
        $data = array();
        $query = mysqli_query($mysqli, "SELECT * FROM master_customer");

        while($row = mysqli_fetch_array($query)){
            $data[] = array(
                'id' => $row['id'],
                'name_customer' => $row['name_customer'],
                'desc_customer' => $row['desc_customer'],
                'created_at' => $row['created_at'],
            );
        };

        if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
        else $result = json_encode(array('success'=>false));

        echo $result;
    };

    if($postjson['aksi']=='delete'){
        $data = array();
       
        $query = mysqli_query($mysqli, "DELETE * FROM master_customer WHERE id='$postjson[id]'");
        if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
        else $result = json_encode(array('success'=>false));

        echo $result;
        
    }


?>