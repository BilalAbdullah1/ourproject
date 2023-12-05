<?php
 include ("connection.php" ); 
$name =  $_POST['catname' ]; 
$sql=  "INSERT  INTO `categorytb`(`catname`)
 VALUES  (' {$name} ')" ; 

if(mysqli_query($conn , $sql)){
    $response = [
        'status'=>'ok',
        'success'=>true,
        'message'=>'Record created succesfully!'
    ];
    print_r(json_encode($response));
}else{
    $response = [
        'status'=>'ok',
        'success'=>false,
        'message'=>'Record created failed!'
    ];
    print_r(json_encode($response));
} 
?> 