<?php
include_once __DIR__."/includes/config.php";
?>
<?php 
include_once "layouts/header.php";
?>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>စဥ်</th>
                              <th>ပစ္စည်းအမည်</th>
                              <th>စာရင်းရှိအရေအတွက်</th>
                              <th>ငှားထားသည့်အရေအတွက်</th>
                              <th>ပြန်အပ်သည့်အရေအတွက်</th>
                              <th>ကျိုးပဲ့/ပျောက်ဆုံးအရေအတွက်</th>
                              <th>ဆိုင်ရှိအရေအတွက်</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                          //asdasd
                          // $query = "select customer.name, lent.* from customer join lent on customer.id = lent.customer_id";
                          // $result = mysqli_query($con,$query);
                          // $count = 1;
                          // foreach($result as $row){ 
                                                      
                          //   $cus_name=$row['name']; 
                          
                          //   $data_id = $row['id']; 
                          //   $data_inv = $row['invoice_number']; 
                             
                          //   $data_date = $row['lent_date']; 
                          //   $data_qty = $row['total_qty']; 
                          //   $data_dep = $row['deposit'];  
                             
                        ?> 
                        <tr> 

                        </tr> 
                        <?php 
                        // $count ++; 
                        // } 
                        
                        ?>
                          </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>  
        </div>
      </div>
<?php 
include_once "layouts/footer.php"
?>