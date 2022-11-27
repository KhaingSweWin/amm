<?php
session_start();
  $price_yearly=$_SESSION['year'];
  // echo $price_yearly;
header('Content-Type: application/json');

$con = mysqli_connect("localhost","root","","aung myanmar");

$query="
SELECT
DATE_FORMAT(lent_date, '%d') AS DAY,
DATE_FORMAT(lent_date, '%M') AS MONTH,
DATE_FORMAT(lent_date, '%Y') AS YEAR,

SUM(unit_price*item_qty)  AS total_price
FROM
lent join lent_detail on lent.id = lent_detail.lent_id
Where
YEAR(lent_date) = $price_yearly

GROUP BY
DATE_FORMAT(lent_date, '%M ')";

   $result= mysqli_query($con,$query);
   $data=array();
   foreach($result as $row){
       $data[]=$row;
   }
   mysqli_close($con);
 echo json_encode($data);

?>
