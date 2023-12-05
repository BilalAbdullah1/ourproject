<?php
include ("connection.php" ); 
$id =$_GET['cid' ];  
$sql= "DELETE FROM  `categorytb` WHERE `cid`  =  $id " ; 

if(mysqli_query($conn , $sql)){
    $response = [
        'status'=>'ok',
        'success'=>true,
        'message'=>'Record deleted succesfully!'
    ];
    print_r(json_encode($response));
}else{
    $response = [
        'status'=>'ok',
        'success'=>false,
        'message'=>'Record deleted failed!'
    ];
    print_r(json_encode($response));
} 
?> 