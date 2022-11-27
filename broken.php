<?php 
include_once "includes/config.php";
include_once 'layouts/header.php';
?>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="container-fluid">
              <!-- Form Modal Button -->
            <div class="row mb-4">
              <!-- <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b>Add Broken Item</b></a>
              </div> -->
               <!-- Search Button -->
              <div class="input-group col-md-4">
              <input type="text" class="form-control" name="" id="" placeholder="ပစ္စည်းအမည်">
                <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div>
            </div>

            <!-- large modal for Broken Item Registration Form-->
<!-- <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Broken Item Registration Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <form action="">
                <div class="modal-body">
                            <h4>Broken Items</h4>
                            <p>ကျိုးပဲ့/ ပျောက်ဆုံး</p>
                            <div class="row">

                                <div class="col-md-6 mt-3">
                                <label for="">Items Name</label>
                                <input type="text" class="form-control" name="" id="" placeholder="ပစ္စည်းအမည်">
                                </div>

                                <div class="col-md-6 mt-3">
                                <label for="">Broken Qty</label>
                                <input type="text" class="form-control" name="" id="" placeholder="အရေအတွက်	">
                                </div>
                            </div>
                                 <div class="row">

                                <div class="col-md-6 mt-3">
                                <label for="">Actual Price</label>
                                <input type="text" class="form-control" name="" id="" placeholder="ကာလပေါက်ဈေး">
                                </div>

                                <div class="col-md-6 mt-3">
                                <label for="">Compensate</label>
                                <input type="text" class="form-control" name="" id="" placeholder="	လျော်ကြေးငွေ">
                                </div>
                            </div>
                            <div class="modal-footer mt-5">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" name="submit" class="btn btn-primary">Submit</button>
      </div>
                </form>
      
      
    </div>
  </div>
</div>      -->
            </div>

            <!-- Broken Table -->
            <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">ကျိုးပဲ့/ပျောက်ဆုံး</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="datatable" class="display expandable-table" style="width:100%">
                          <thead>

                            <tr>
                              <th>စဥ်</th>
                              <th>ဘောင်ချာနံပါတ်</th>
                              <th>ပစ္စည်းအမည်</th>
                              <th>အရေအတွက်</th>
                              <th>ကာလပေါက်ဈေး</th>
                              <th>လျော်ကြေးငွေ</th>
                              <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                          </thead>
                          <tbody id="broken_table">
                            <?php
                              
                              if(!empty($_GET['id'])){
                                $id= $_GET['id'];
                                $query="select lent.*,return_detail.* from lent inner join return_detail on 
                                lent.id=return_detail.lent_id where return_detail.return_id=".$id;;
                              }
                              else{
                                $query="select lent.*,return_detail.* from lent inner join return_detail on 
                                lent.id=return_detail.lent_id where return_detail.has_broken=1";
                              }
                              $count=1;
                              $query_execute = mysqli_query($con,$query);
                              while($result = mysqli_fetch_array($query_execute)){
                                echo "<tr>";
                                echo "<td>".$count."</td>";
                                echo "<td>".$result['invoice_number']."</td>";
                                $ld_id=$result['LentDetail_id'];
                                $query2="Select item.item_name from item inner join lent_detail on 
                                lent_detail.item_id=item.id where lent_detail.id=".$ld_id;
                                $query2_execute=mysqli_query($con,$query2);
                                while($response=mysqli_fetch_array($query2_execute)){
                                  echo "<td>".$response['item_name']."</td>";
                                }
                                echo "<td>".$qty=$result['broken_qty']."</td>";
                                echo "<td>".$price=intval($result['price'])."</td>";
                                $cost = intval($qty)*intval($price);
                                echo "<td>".$cost."</td>";
                                echo "<td>blah blah</td>";
                                echo "</tr>";
                                $count++;
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
        </div>
        </div>
      </div>
<?php 
include_once 'layouts/footer.php'
?>