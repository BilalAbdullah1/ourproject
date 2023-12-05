<?php
include ("connection.php" ); 
$id= $_GET['cid' ];
$sql= "SELECT *  FROM `categorytb`  WHERE  `cid` =   $id";
$result= mysqli_query($conn ,  $sql);
$fetch= mysqli_fetch_assoc($result) ;
print_r(json_encode($fetch));
?>
