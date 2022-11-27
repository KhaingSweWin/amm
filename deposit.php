<?php 
include_once __DIR__."/includes/config.php";
?>
<?php
include_once "layouts/header.php";
?>
      <!-- partial -->
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
                                            <table id="datatable" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>စဥ်</th>
                                                    <th>ဘောက်ချာနံပါတ်</th>
                                                    <th>စပေါ်ငွေ</th>
                                                    <th>ပြန်အပ်သည့်စပေါ်ငွေ</th>
                                                    <th>ကျန်ရှိသည့်စပေါ်ငွေ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dep_table">
                                                  <?php
                                                  $query="select * from  lent";
                                                  $results= mysqli_query($con,$query);
                                                  $count = 1;
                                                  if(!empty($results)){
                                                    foreach($results as $result){
                                                      $lent_id=$result['id'];
                                                      $invoice_num=$result['invoice_number'];
                                                      $data_dep=$result['deposit'];
                                                      $select_query="SELECT COUNT(id),
                                                      sum(deposit) AS dept
                                                      FROM
                                                      return_tb 
                                                      WHERE lent_id = ".$lent_id."
                                                      GROUP BY
                                                      lent_id";
                                                      $query_run= mysqli_query($con,$select_query);
                                                      $output=mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                                                      if(!empty($output)){
                                                        $last_dep= $data_dep - $output['dept'];
                                                      }

                                                      ?>
                                                      <tr>
                                                        <td><div><?php echo $count?></div></td>
                                                        <td><div><?php echo $invoice_num?></div></td>
                                                        <td><div><?php echo $data_dep?></div></td>
                                                        <td><div><?php if(isset($output)){
                                                          print_r($output['dept']);
                                                        }else{echo 0;
                                                        } ?></div></td>
                                                        <td><div><?php echo $last_dep ?></div></td>
                                                      </tr>
                                                      <?php
                                                      $count++;
                                                    }

                                                  }
                                                  else{

                                                  }
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
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->

<?php 
include_once "layouts/footer.php";
?>

