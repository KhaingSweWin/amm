<?php 
include_once __DIR__."/includes/config.php"; 
include_once __DIR__."/includes/db.php"; 
session_start(); 
if(isset($_POST['search'])){ 
  if(!empty($_POST['year'])){ 
    $year=$_POST['year']; 
   $_SESSION['year']=$year; 
    $query="SELECT 
    COUNT(id), 
    DATE_FORMAT(lent_date, '%Y-%m-%d') AS DAY, 
    DATE_FORMAT(lent_date, '%Y-%m') AS MONTH, 
    DATE_FORMAT(lent_date, '%Y') AS YEAR, 
    sum(deposit) AS deposit 
   
    FROM 
    lent 
    WHERE 
    YEAR(lent_date) = ".$year." 
    GROUP BY 
    DATE_FORMAT(lent_date, '%Y ');"; 
    $query_run = mysqli_query($con, $query); 
    $output=mysqli_fetch_array($query_run,MYSQLI_ASSOC); 
    
    /// 
    $query1="SELECT 
    COUNT(id), 
    DATE_FORMAT(lent_date, '%Y-%m-%d') AS DAY, 
    DATE_FORMAT(lent_date, '%Y-%m') AS MONTH, 
    DATE_FORMAT(lent_date, '%Y') AS YEAR, 
    sum(total_qty) AS Qty 
   
    FROM 
    lent 
    WHERE 
    YEAR(lent_date) = ".$year." 
    GROUP BY 
    DATE_FORMAT(lent_date, '%Y ');"; 
    $query_run1 = mysqli_query($con, $query1); 
    $output1=mysqli_fetch_array($query_run1,MYSQLI_ASSOC); 
  } 
} 
?> 
<?php 
include_once __DIR__. "/layouts/header.php"; 
?> 
<style> 
  .page-body-wrapper { 
    padding-top: 0px; 
  } 
</style> 
      <!-- partial --> 
      <div class="main-panel"> 
        <div class="content-wrapper"> 
          <div class="row"> 
            <div class="col-md-12 grid-margin"> 
              <div class="row"> 
                <div class="col-12 col-xl-8 mb-4 mb-xl-0"> 
                  <h3 class="font-weight-bold">Welcome Aamir</h3> 
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6> 
                </div> 
              </div> 
            </div> 
          </div> 
          <div class="row"> 
            <div class="col-md-12 grid-margin transparent"> 
              <div class="row"> 
                <div class="col-md-4 stretch-card"> 
                <form method="POST"> 
                  <label class="form-label">Enter Year</label> 
                  <div class="row"> 
                  <div class="col-md-10"> 
                  <input type="text" class="form-control" name="year"> 
                  </div> 
                  <div class="col-md-2 d-flex justify-content-center align-items-center"> 
                  <button class="btn btn-primary" type="submit" name="search"><i class="mdi mdi-magnify mdi-18px"></i></button> 
                  </div> 
                  </div> 
                </form> 
                </div> 
                <div class="col-md-4  stretch-card transparent"> 
                  <div class="card card-dark-blue"> 
                    <div class="card-body"> 
                      <p class="mb-4">Total Deposit</p> 
                      <p class="fs-30 mb-2" id="number"> 
                        <?php 
                          if(isset($_POST['year'])){ 
                          print_r($output['deposit']); 
                          }                        
                        ?> 
                      </p> 
                      <p>Yearly</p> 
                    </div> 
                  </div> 
                </div> 
                <div class="col-md-4 stretch-card transparent"> 
                  <div class="card card-light-danger"> 
                    <div class="card-body"> 
                      <p class="mb-4">Total Qty of item(lented)</p> 
                      <p class="fs-30 mb-2" id="number1"> 
                        <?php 
                        if(isset($_POST['year'])){ 
                           
                          print_r($output1['Qty']); 
                        } 
                        ?> 
                      </p> 
                        <p>Yearly</p> 
                    </div> 
                  </div> 
                </div> 
            </div> 
          </div> 
          <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card"> 
              <div class="card"> 
                <div class="card-body"> 
                  <p class="card-title">Total Deposit(Monthly)</p> 
                  <p class="font-weight-500"></p> 
                  
                  <canvas id="monthly-deposit"></canvas> 
                </div> 
              </div> 
            </div> 
            <div class="col-md-6 grid-margin stretch-card"> 
              <div class="card"> 
                <div class="card-body"> 
                 <div class="d-flex justify-content-between"> 
                  <p class="card-title">Lent Qty(Month)</p>                   
                 </div> 
                  <p class="font-weight-500"></p> 
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div> 
                  <canvas id="monthly-lent"></canvas> 
                </div> 
              </div> 
            </div> 
            <div class="row"> 
            <div class="col-md-6 grid-margin stretch-card"> 
              <div class="card"> 
                <div class="card-body"> 
                  <p class="card-title">Total Price(Monthly)</p> 
                  <p class="font-weight-500"></p> 
                  
                  <canvas id="monthly-price"></canvas> 
                </div> 
              </div> 
            </div> 

            <div class="col-md-6 grid-margin stretch-card"> 
              <div class="card"> 
                <div class="card-body"> 
                  <p class="card-title">Total Price(Monthly)</p> 
                  <p class="font-weight-500"></p> 
                  
                  <canvas id=""></canvas> 
                </div> 
              </div> 
          </div> 
          
          
           
         
        </div> 
        <!-- content-wrapper ends --> 
        <!-- partial:partials/_footer.html --> 
<?php 
include_once __DIR__. "/layouts/footer.php"; 
 
?> 
<script  src="js/Chart.min.js"></script> 
<script> 
  // location.reload(); 
 
 
        $(document).ready(function () { 
            showGraph(); 
            showGraph2(); 
            showGraph3(); 

     
 
 
        var input = document.getElementById('input') 
        input.addEventListener("keypress",function(event){ 
                if(event.key == "Enter"){ 
                  response=null; 
                  // event.preventDefault(); 
                    console.log("Enter"); 
                    var value=input.value; 
                    if(value !==""){ 
                        console.log(value); 
                        event.preventDefault(); 
 
                        $.ajax({ 
                    url:"test.php", 
                    type:"post", 
                    data:{year:value}, 
                    success:function(response){ 
                        if(response == 1){  
                            console.log('12345');  
                             
                        }else{  
                            console.log(response);  
                            var split = response.split("_") 
                            var here_val = split[0]; 
                            var there_val = split[1]; 
                            var here= document.getElementById('here'); 
                            here.innerHTML= here_val; 
                            var there=document.getElementById('there'); 
                            there.innerHTML=there_val; 
                             
                        }              
                    } 
                     
                })   
                 
               
                       
                    }                       
                }  //enter    
                     
}) 
 
 
 
 
 
        function showGraph() 
        { 
            { 
                $.post("dashdata/dashdata.php", 
                function (datas) 
                { 
                    console.log(datas); 
                     var months = []; 
                    var deposits = []; 
 
                    for (var i in datas) { 
                        months.push(datas[i].month); 
                        deposits.push(datas[i].deposit); 
                    } 
                    console.log(months); 
                    console.log(deposits); 
                    var chartdata = { 
                        labels: months, 
                        datasets: [ 
                            { 
                                label: 'Monthly Deposit', 
                                backgroundColor: 'coral', 
                                borderColor: '#46d5f1', 
                                hoverBackgroundColor: 'aqua', 
                                hoverBorderColor: 'yellow', 
                                data: deposits 
                            } 
                        ] 
                    }; 
 
                    var graphTarget = $("#monthly-deposit"); 
 
                    var barGraph = new Chart(graphTarget, { 
                        type: 'bar', 
                        data: chartdata 
                    }); 
                }); 
            } 
        } 
 
 
 
        function showGraph2() 
        { 
            { 
                $.post("dashdata/dashdata2.php", 
                function (data) 
                { 
                    console.log(data); 
                     var months = []; 
                    var qty = []; 
 
                    for (var i in data) { 
                        months.push(data[i].month); 
                        qty.push(data[i].total_qty); 
                    } 
                    console.log(months); 
                    console.log(qty); 
                    var chartdata = { 
                        labels: months, 
                        datasets: [ 
                            { 
                                label: 'Lent Qty(Monthly)', 
                                backgroundColor: 'coral', 
                                borderColor: '#46d5f1', 
                                hoverBackgroundColor: 'aqua', 
                                hoverBorderColor: 'yellow', 
                                data: qty 
                            } 
                        ] 
                    }; 
 
                    var graphTarget = $("#monthly-lent"); 
 
                    var barGraph = new Chart(graphTarget, { 
                        type: 'bar', 
                        data: chartdata 
                    }); 
                }); 
            } 
        } 
 
 
        function showGraph3() 
        { 
            { 
                $.post("dashdata/dashdata3.php", 
                function (data) 
                { 
                    console.log(data); 
                     var months = []; 
                    var price = []; 
 
                    for (var i in data) { 
                        months.push(data[i].MONTH); 
                        price.push(data[i].total_price); 
                    } 
                    console.log(months); 
                    console.log(price); 
                    var chartdata = { 
                        labels: months, 
                        datasets: [ 
                            { 
                                label: 'Total Price(Monthly)', 
                                backgroundColor: 'transparent', 
                                borderColor: '#46d5f1', 
                                hoverBackgroundColor: 'aqua', 
                                hoverBorderColor: 'yellow', 
                                data: price 
                            } 
                        ] 
                    }; 
 
                    var graphTarget = $("#monthly-price"); 
 
                    var barGraph = new Chart(graphTarget, { 
                        type: 'line', 
                        data: chartdata 
                    }); 
                }); 
            } 
        } 
 
      }); 
 
     var good = $('#number').html(); 
     var num = parseInt(good); 
     console.log(num); 
     if (Number.isInteger(num)) { 
      // $('#number').html(good) 
      console.log(num) 
  } 
  else  
{ 
//  $('#number').html("This year doesn't exist in databse") 
$('#number').html('No Data') 
} 
 
 
var good1 = $('#number1').html(); 
     var num1 = parseInt(good1); 
     console.log(num1); 
     if (Number.isInteger(num1)) { 
      // $('#number').html(good) 
      console.log(num1) 
  } 
  else  
{ 
//  $('#number').html("This year doesn't exist in databse") 
$('#number1').html('No Data'); 
$('#number1').css('font-size',''); 
} 
   
 
    //  console.log(good) 
 
</script>