<?php
session_start();
 $year=$_SESSION['year'];
header('Content-Type: application/json');
   
   // echo $year;

$conn = mysqli_connect("localhost","root","","aung myanmar");
$sqlQuery = "SELECT
COUNT(id),
DATE_FORMAT(lent_date, '%Y-%m-%d') AS DAY,
DATE_FORMAT(lent_date, '%M') AS month,
DATE_FORMAT(lent_date, '%Y') AS YEAR,
sum(deposit) AS deposit
FROM
lent
WHERE
    YEAR(lent_date) =$year

GROUP BY
DATE_FORMAT(lent_date, '%m ');";

$query = mysqli_query($conn,$sqlQuery);
//print_r($query);
 $result= (mysqli_fetch_array($query));
//print_r($result);
$data = array();
foreach ($query as $row) {
   // print_r($row);
	 $data[] = $row;
	
}
mysqli_close($conn);

echo json_encode($data);
// /print_r($year);
// print_r($data);
// echo $year;

 
   

 




?>