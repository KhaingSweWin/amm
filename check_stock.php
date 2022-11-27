<?php
include_once __DIR__."/includes/config.php";
if(isset($_POST['item_name'])){
    $item_name=$_POST['item_name'];
    $query="SELECT COUNT(id),
    sum(qty) AS QTY
    FROM
    stock
    WHERE item_id = ".$item_name."
    GROUP BY
    item_id";
    $query_run= mysqli_query($con,$query);
    $output=mysqli_fetch_array($query_run,MYSQLI_ASSOC);
    $query2="SELECT COUNT(id),
    sum(item_qty) AS ITEM_QTY
    FROM
    lent_detail
    WHERE item_id = ".$item_name."
    GROUP BY
    item_id";
    $query_run2=mysqli_query($con,$query2);
    $output2=mysqli_fetch_array($query_run2,MYSQLI_ASSOC);
    $query3="SELECT
    sum(return_qty) AS R_QTY
    FROM return_detail
    WHERE return_detail.LentDetail_id = ANY 
    (SELECT id FROM lent_detail WHERE item_id= ".$item_name.")";
    $query_run3=mysqli_query($con,$query3);
    $output3=mysqli_fetch_array($query_run3,MYSQLI_ASSOC);
    $final_total=$output['QTY']-$output2['ITEM_QTY']+$output3['R_QTY'];
    echo $final_total;
}
?>