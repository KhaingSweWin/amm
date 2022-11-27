<?php

include_once __DIR__. "/controller/stockcontroller.php";
include_once __DIR__. "/includes/config.php";
$itemcontroller= new ItemController();
if(isset($_POST['submit']))
{
    if(!empty($_POST['item_id']))
    {
        $item_id=$_POST['item_id'];
    }
    if(!empty($_POST['income_date']))
    {
        $income_date=$_POST['income_date'];
    }
    if(!empty($_POST['qty']))
    {
        $qty=$_POST['qty'];
    }
    if(!empty($_POST['actual_price']))
    {
        $actual_price=$_POST['actual_price'];
    }
    if(!empty($_POST['lent_price']))
    {
        $lent_price=$_POST['lent_price'];
    }
   
    $result=$itemcontroller->addItem($item_id,$income_date,$qty,$actual_price,$lent_price);
    if($result)
    {
        header('location:additem.php');
    }
    else 
    {
        echo "<div class='alert alert-danger'></div>";
        echo "Unsuccessful";
    }
}
?>


<?php

$stocks=$itemcontroller->getItems();


include_once "layouts/header.php";
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Form Modal Button -->
            <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b>ပစ္စည်းထည့်ရန်</b></a>
              </div>
              <!-- Search Button -->
              <div class="input-group col-md-4">
              <input type="text" class="form-control" name="" id="" placeholder="ပစ္စည်းအမည်">
                <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div>
               

            <!-- large modal for New Item Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">ထပ်ရောက်ပစ္စည်းထည့်ခြင်း</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action="" method="post">
                    <div class="modal-body">
                    <h4>ထပ်ရောက်ပစ္စည်း</h4>
               
                                                   
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="" class="form-label">ပစ္စည်းအမည်</label><br>
                                                <select name="item_id" id="" class="form-control" required >
                                                <?php
                                                    $selectquery="select * from  item ";
                                                    $select_result = mysqli_query($con,$selectquery);
                                                    
                                                   
                                              
                                                    while($ans=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):;
                                                ?>
                                                    <option value="<?php echo $ans['id']; ?>">
                                                        <?php  echo $ans['item_name'] ?>
                                                    </option>
                                                 <?php endwhile;   ?>   
                                                </select>
                                                                        
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label">ရောက်ရှိသည့်ရက်စွဲ</label>
                                                <input type="date" name="income_date" id="" class="form-control" value="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
                                                
                                            </div>
                                        </div>        
                                        <div class="row mt-3" >
                                            <div class="col-md-6">
                                                <label for="" class="form-label">အသစ်ရောက်အရေအတွက်</label>
                                                <input type="number" name="qty" id="new_qty" class="form-control" placeholder="အသစ်ရောက်အရေအတွက်" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="form-label">ပစ္စည်းတန်ဖိုး</label>
                                                <input type="number" name="actual_price" id="item_value" class="form-control" placeholder="ပစ္စည်းတန်ဖိုး" required>
                                            </div>
                                        </div>      
                                        <div class="row mt-3">
                                        <div class="col-md-6">
                                                <label for="" class="form-label">၁ ရက်ငှားရမ်းနှုံး</label>
                                                <input type="number" name="lent_price" id="rental_rate" class="form-control" placeholder="၁ ရက်ငှားရမ်းနှုံး" required>
                                            </div>
                                        </div>
                                            
                                        
                    </div>
                                        <div class="modal-footer mt-5">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                        </div>
                    </form>
                </div>
                </div>
                            </div>
                        </div>


                 <!-- New Item Table -->
            <div class="container-fluid">
        <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">ထပ်ရောက်ပစ္စည်း စာရင်း</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="datatable" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>စဥ်</th>
                                                    <th>ပစ္စည်းအမည်</th>
                                                    <th>ရောက်ရှိသည့်ရက်စွဲ</th>
                                                    <th>အသစ်ရောက်အရေအတွက်</th>
                                                    <th>ပစ္စည်းတန်ဖိုး</th>
                                                    <th>တစ်ရက်ငှားရမ်းနှုန်း</th>
                                                    <th>လုပ်ဆောင်ချက်</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="stock">
                                                <?php 
                                                   
                                                    $query="select item.item_name, stock.* from item join stock on item.id = stock.item_id ";
                                                   
                                                    $result = mysqli_query($con,$query);
                                                    $row= (mysqli_fetch_array($result));
                                                   // print_r($row);
                                                    if(!empty($row)){
                                                    $item_name=$row['item_name'];
                                                 
                                                    $count = 1;
                                                    foreach($result as $row){
                                                     
                                                        $item_name=$row['item_name'];
                                                     
                                                        $data_id = $row['id'];
                                                        $data_item_id = $row['item_id'];
                                                        
                                                        $data_income_date = $row['income_date'];
                                                        $data_qty = $row['qty'];
                                                        $data_actual_price = $row['actual_price'];
                                                        $data_lent_price = $row['lent_price'];
                                                        
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td> <div  class='' id='name_<?php echo $data_id; ?>'> <?php echo $item_name; ?></div> </td>
                                                    <td> <div contentEditable='true' class='edit_item' id='income_date_<?php echo $data_id; ?>'><?php echo $data_income_date; ?> </div> </td>
                                                    <td> <div contentEditable='true' class='edit_item' id='qty_<?php echo $data_id; ?>'><?php echo $data_qty; ?> </div> </td>
                                                    <td> <div contentEditable='true' class='edit_item' id='actual_price_<?php echo $data_id; ?>'><?php echo $data_actual_price; ?> </div> </td>
                                                    <td> <div contentEditable='true' class='edit_item' id='lent_price_<?php echo $data_id; ?>'><?php echo $data_lent_price; ?> </div> </td>
                                                    <td pid='<?php echo $data_id; ?>'><a class="btn btn-danger delete_item">Delete</a></td>
                                                    </tr>
                                                    <?php
                                                    $count ++;
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
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->

<?php 
include_once "layouts/footer.php";
?>
<script>
    $(":input").keyup(function(){
     if($(this).val().trim().length===0 || $('#item_value').val().trim().length===0 ||  $('#rental_rate').val().trim().length===0 ||  $('#new_qty').val().trim().length===0){
        console.log('space')
        $(':input[type="submit"]').prop('disabled', true);

}
else if($(this).val().trim().length!=null){
    $(':input[type="submit"]').prop('disabled',false);
}

    })
</script>