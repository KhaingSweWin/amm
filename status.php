<?php
include_once __DIR__."/includes/config.php";

if(isset($_POST['id'])){
    $statusid = mysqli_real_escape_string($con,$_POST['id']);
    $query = "UPDATE dep SET ranking ='1' WHERE id=".$statusid;
    mysqli_query($con,$query);
    
    echo 1;
}
else{
    echo 0;

}
?>