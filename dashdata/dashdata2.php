<?php
session_start();
 $qty_yearly=$_SESSION['year'];
header('Content-Type: application/json');

$con = mysqli_connect("localhost","root","","aung myanmar");

$query="
SELECT
   COUNT(id),
   DATE_FORMAT(lent_date, '%Y-%m-%d') AS DAY,
   DATE_FORMAT(lent_date, '%M') AS month,
   DATE_FORMAT(lent_date, '%Y') AS YEAR,
   sum(total_qty) AS total_qty

FROM
   lent
   WHERE
   YEAR(lent_date) = ".$qty_yearly."


GROUP BY
   DATE_FORMAT(lent_date, '%m ');";

   $result2= mysqli_query($con,$query);
   $data2=array();
   foreach($result2 as $row2){
       $data2[]=$row2;
   }
   mysqli_close($con);
 echo json_encode($data2);

?>
