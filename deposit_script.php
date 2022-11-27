<?php
include_once "includes/config.php";
if(!empty($_POST['id'])){
    $id = $_POST['id'];
    $query = "SELECT lent.deposit FROM lent where lent.id=".$id;
    $result = mysqli_query($con,$query);
    $outcome = mysqli_fetch_row($result);
    echo $outcome[0];
}
?>