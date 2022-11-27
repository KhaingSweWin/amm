<?php
include_once "includes/config.php";
include_once "controller/ReturnController.php";
$returnController = new ReturnController();
if(isset($_POST['submit'])){

    if(!empty($_POST['lent_id'])){
        $lent_id = $_POST['lent_id'];
    }else{
        $error_invoice="Please select an invoice number";
    }

    if(!empty($_POST['return_date'])){
        $return_date = $_POST['return_date'];
    }else{
        $error_date="Please choose date";
    }

    $response = null;

    if(!empty($_POST['lentDetail_id'])){
        $lentDetail_id=$_POST['lentDetail_id'];
    }else{
        $error_item="Please select an item";
    }

    if(!empty($_POST['return_qty'])){
        $qty=$_POST['return_qty'];
    }else{
        $error_qty="Please enter a number";
    }
    
    if(!empty($_POST['has_broken'])){
        $broken = $_POST['has_broken'];
    }
    if(!empty($_POST['broken_qty'])){
        $broken_qty = $_POST['broken_qty'];
    }else{
        $broken_qty=0;
    }

    if(!empty($_POST['actual_price'])){
        $price = $_POST['actual_price'];
    }else{
        $price = 0;
    }

    if(!empty($_POST['emp_id'])){
        $emp_id=$_POST['emp_id'];
    }else{
        $error_emp = "Please choose an employee";
    }

    if(!empty($_POST['discount'])){
        $discount = $_POST['discount'];
    }else{
        $discount = 0;
    }
    if(!empty($_POST['deposit'])){
        $deposit = $_POST['deposit'];
    }
    if(empty($error_invoice) && empty($error_date) && empty($error_item) && empty($error_qty) && empty($error_emp)){

        $checker_query="Select * from lent where lent.id=".$lent_id;
        $query_execute = mysqli_query($con,$checker_query);
        while($checker_result = mysqli_fetch_array($query_execute)){
            $checker = $checker_result['checker'];
        }
        if($checker==0){
            $checker_update = $returnController->updateChecker($lent_id,1);
        }

        $addReturn= $returnController->addReturn($lent_id,$return_date,$emp_id,$discount,$deposit);
        if($addReturn){
            $cuery = "select max(id) from return_tb";
            $outcome = mysqli_query($con,$cuery);
            $event = mysqli_fetch_row($outcome);
            $last_id = $event[0];
            echo $last_id;
            foreach($lentDetail_id as $index => $iDs){
                $arr_id=$iDs;
                $arr_qty=$qty[$index];
                $arr_broken = $broken[$index];
                $arr_bQty = $broken_qty[$index];
                $arr_price = $price[$index];
                $rDetail_data= $returnController->addReturnDetail($last_id,$lent_id,$arr_id,$arr_qty,$arr_broken,$arr_bQty,$arr_price);

                if($rDetail_data){
                    header('location:return.php');
                }
            }
        }
    }
    else{
        echo "error";
    }
}
?>
<?php 
include_once "layouts/header.php";
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper" id="scrollbar">

        <div class="container-fluid">
     <!-- Form Modal Button -->
     <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b>ပြန်အပ်စာရင်းထည့်ရန်</b></a>
              </div>
              <!-- Search Button -->
              <div class="input-group col-md-4">
              <input type="text" class="form-control" name="" id="" placeholder="အမည်">
                <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div>

               <!-- large modal for Return Item Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">ပြန်အပ်စာရင်းထည့်ခြင်း</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method='post'>
            <div class="modal-body">
                        
                        <p>ပြန်အပ်စာရင်း</p>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="">Invoice No</label>
                            <select name="lent_id" class='form-control' id='invoice_no' placeholder="ဘောင်ချာနံပါတ်">
                                <option value="">ဘောင်ချာနံပါတ်ကို ရွေးပါ</option>
                                <?php
                                    $selectquery="select * from  lent where lent.checker<2";
                                    $select_result = mysqli_query($con,$selectquery);
                                    $outcome=null;
                                    $ld_id=null;
                                    while($outcome=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):;
                                    
                                ?>
                                <option value="<?php echo $ld_id=$outcome['id']; ?>"><?php echo $outcome['invoice_number']; ?>
                                </option>
                                <?php 
                                    endwhile;
                                ?> 
                            </select>
                            <span class='text-danger'><?php if(isset($error_invoice)) echo $error_invoice; ?></span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">ငှားရမ်းသူအမည်</label>
                            <input type="text" class="form-control" id="customer" placeholder="ငှါးရမ်းသူအမည်" value='<?php //echo $cus_name[0]; ?>'>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">ပြန်အပ်ရက်စွဲ</label>
                            <input type="date" class="form-control" name="return_date" id="return_date" placeholder='ပြန်အပ်ရက်စွဲ'>
                            <span class='text-danger'><?php if(isset($error_date)) echo $error_date; ?></span>
                        </div>

                                

                        <div class="col-md-4 mt-3">
                          <label class="form-label">ပြန်အပ်သည့်ပစ္စည်း</label>
                            <select class="form-control" lentdetail="<?php echo $ld_id ?>" name="lentDetail_id[]" id="return_item" placeholder="ပြန်အပ်သည့်ပစ္စည်း">

                            </select>
                            <span class='text-danger'><?php if(isset($error_item)) echo $error_item; ?></span>
                        </div>
                        <div class="col-md-2 mt-3">
                                <label for="" class="form-label">အ‌ရေအတွက်</label>
                                <input type="number" name='return_qty[]' min="1" id="return_qty" class="form-control" placeholder="အ‌ရေအတွက်">
                                <span class='text-danger'><?php if(isset($error_qty)) echo $error_qty; ?></span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="" class="form-label">တစ်ရက်ငှါးရမ်းနှုန်း</label>
                            <input type="number" min="1" name="" class="form-control" placeholder="တစ်ရက်ငှါးရမ်းနှုန်း" id="unit_price">
                                
                        </div>
                        <div class="col-md-2 mt-3">
                            <label for="">&nbsp;</label>
                            <button  class="btn btn-outline-primary mt-4" id="addbtn">+</button>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">ကျိုးပဲ့/ပျောက်ဆုံး</label>
                            <select name="has_broken[]" class="form-control" id="hasBroken" plcaeholder="ကျိုးပဲ့/ပျောက်ဆုံး" >
                                <option value="1" >ရှိ</option>
                                <option value="0" selected>မရှိ</option>
                            </select>
                        </div>
                        <div class="col-md-2 mt-3">
                            <label for="">အ‌ရေအတွက်</label>
                            <input type="number" class='form-control' min='0' id='broken_qty' name='broken_qty[]' placeholder='ကျိုးပဲ့အရေအတွက်'>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">ကာလပေါက်စျေး</label>
                            <input type="number" class='form-control' id='actual_price' name='actual_price[]' placeholder='ကာလပေါက်စျေး'>
                        </div>

                                <!-- <div class="col-md-1 mt-3">
                                <label for="">&nbsp;</label>
                                <button  class="btn btn-outline-danger ">-</button>
                              </div> -->
                        <div class="container-fluid" id="return_form">

                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">ဝန်ထမ်း</label>
                            <select name="emp_id" class="form-control" id="employee" placeholder="လက်ခံပေးသည့်တာဝန်ခံ">
                                <option>လက်ခံသူအမည်ကို ရွေးပါ</option>
                                <?php
                                    $selectquery="select * from  employee ";
                                    $select_result = mysqli_query($con,$selectquery);
                                    while($outcome=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):;
                                ?>
                                <option value="<?php echo $outcome['id']; ?>">
                                    <?php echo $outcome['emp_name']; ?>
                                </option>
                                <?php endwhile; ?> 
                            </select>
                            <span class='text-danger'><?php if(isset($error_emp)) echo $error_emp; ?></span>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">လျော့စေ◌ျး</label>
                            <input type="number" id='discount' name="discount" class='form-control' placeholder='Discount'>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">စရန်ပြန်ပေးငွေ</label>
                            <input type="number" name="deposit" min='0' id='deposit' class='form-control' placeholder='စရန်ပြန်ပေးငွေ'>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
      </div>
        </form>
        </div>
  </div>
</div>     
</div>
    <div class="container-fluid">
        <div class="row" id="scrollbar">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">ပြန်အပ်စာရင်းဇယား</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="datatable" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>စဥ်</th>
                                                        <th>ဘောင်ချာ <br> နံပါတ်</th>
                                                        <th>ငှားရမ်းသူအမည်</th>
                                                        <th>ငှါးထားသည့် <br> ရက်စွဲ</th>
                                                        <th>ပြန်အပ်သည့် <br> ရက်စွဲ</th>
                                                        <th>ပြန်အပ်ပစ္စည်း</th>
                                                        <th>စပေါ်‌ပြန် <br>ပေးငွေ</th>
                                                        <th>ကျိုးပဲ့/ <br> ပျောက်ဆုံး</th>
                                                        <th>စုစုပေါင်း <br> ကျသင့်ငွေ</th>
                                                        <th>လုပ်ဆောင်ချက်</th>
                                                    </tr>
                                                </thead>
                                                <tbody q_id="return_table">
                                                <?php
                                                    $query1="Select customer.cus_name,lent.*,lent.id as lid,return_tb.* from customer inner
                                                    join lent on customer.id=lent.customer_id inner join return_tb on 
                                                    lent.id=return_tb.lent_id";
                                                    $query1_execute=mysqli_query($con,$query1);
                                                    $count=1;
                                                    while($result1=mysqli_fetch_array($query1_execute)){
                                                        echo "<tr>";
                                                        echo "<td>".$count."</td>";
                                                        echo "<td>".$result1['invoice_number']."</td>";
                                                        echo "<td>".$result1['cus_name']."</td>";
                                                        echo "<td>".$result1['lent_date']."</td>";
                                                        echo "<td>".$result1['return_date']."</td>";

                                                        //preparing for calTotalCost
                                                        $initial_date=new DateTime($result1['lent_date']);
                                                        $final_date=new DateTime($result1['return_date']);
                                                        $dis=intval($result1['discount']);

                                                        //get id for 2nd query
                                                        $ret_id=$result1['id'];
                                                        $id_count=0;
                                                        $has_broken=0;
                                                        $cost=0;
                                                        //2nd query
                                                        $query2="Select return_detail.id as rd,return_detail.*,lent_detail.*,
                                                        lent_detail.id as ld_id from lent_detail inner 
                                                        join return_detail on lent_detail.id=return_detail.LentDetail_id 
                                                        where return_detail.return_id=".$ret_id;
                                                        $query2_execute=mysqli_query($con,$query2);
                                                        while($result2=mysqli_fetch_array($query2_execute)){
                                                            if($result2['rd']){
                                                                $id_count++;
                                                            }
                                                            $update_id=intval($result2['ld_id']);
                                                            //preparing for calTotalCost
                                                            $r_qty=intval($result2['return_qty']);
                                                            $price=intval($result2['unit_price']);
                                                            $broken_qty=intval($result2['broken_qty']);
                                                            $actual_price=intval($result2['price']);
                                                            $cost+=$returnController->calTotalCost($initial_date,$final_date,$r_qty,$price,$broken_qty,$actual_price,$dis);
                                                            
                                                            if($result2['has_broken']==1)
                                                                $has_broken++;
                                                            $total_return_qty=0;
                                                            $total_return_qty+=$r_qty;

                                                            $update_query="Select lent_detail.*,return_detail.*,sum(return_qty) from lent_detail inner join return_detail on 
                                                            lent_detail.id=return_detail.LentDetail_id where return_detail.LentDetail_id=".$update_id;
                                                            $execute2=mysqli_query($con,$update_query);
                                                            while($execution2=mysqli_fetch_array($execute2)){
                                                                $lent_qty=intval($execution2['item_qty']);
                                                                $give_back_qty=intval($execution2['sum(return_qty)']);
                                                                if($lent_qty==$give_back_qty)
                                                                    $give_back_update=$returnController->updateGive_back($update_id);
                                                            }
                                                        }

                                                        //for calculation of deposit
                                                        $return_depo=0;
                                                        $deposit_query="Select lent.deposit,return_tb.deposit as r_deposit from lent inner
                                                        join return_tb on lent.id=return_tb.lent_id where return_tb.id=".$result1['id'];
                                                        $depo_execute=mysqli_query($con,$deposit_query);
                                                        while($depo_result=mysqli_fetch_array($depo_execute)){
                                                            $r_deposit=intval($depo_result['r_deposit']);
                                                            $cost-=$r_deposit;
                                                        }
                                                        echo "<td>".$id_count." မျိုး</td>";
                                                        echo "<td>".$r_deposit."</td>";
                                                        if($has_broken>0)
                                                            echo "<td><a href='broken.php?id=".$ret_id."' class='text-black'>ရှိ</a></td>";
                                                        else
                                                            echo "<td>မရှိ</td>";
                                                        if($cost>0)
                                                            echo "<td class='text-success'><h4>".$cost."</h4></td>";
                                                        else
                                                            echo "<td class='text-danger'><h4>".$cost."</h4></td>";
                                                        echo "<td><a href='return_detail.php?id=".$ret_id."' class='btn btn-primary'>အသေးစိတ်</a></td>";
                                                        echo "</tr>";
                                                        $count++;

                                                        $id_checker=$result1['lid'];
                                                        $total_return_qty=0;
                                                        $kuery="SELECT return_detail.*,lent.* FROM lent INNER JOIN return_detail on 
                                                        return_detail.lent_id=lent.id WHERE return_detail.lent_id=".$id_checker;
                                                        $kuery_execute=mysqli_query($con,$kuery);
                                                        while($final_outcome=mysqli_fetch_array($kuery_execute)){
                                                            $lent_qty=$final_outcome['total_qty'];
                                                            $return_qty=$final_outcome['return_qty'];
                                                            $total_return_qty+=$return_qty;
                                                            if($lent_qty==$total_return_qty){
                                                                $checker2=$returnController->updateChecker($id_checker,2);
                                                            }
                                                        }

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
      <!-- main-panel ends -->

<?php 
include_once "layouts/footer.php";
?>
