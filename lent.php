<?php 
include_once __DIR__."/controller/lentcontroller.php";
include_once __DIR__."/controller/lent_detail_controller.php";
include_once __DIR__."/includes/config.php";
$lentcontroller = new Lentcontroller();
if(isset($_POST['upload'])){
  if(!empty($_POST['cus_name'])){
    $cus_name=$_POST['cus_name'];
  }

  if(!empty($_POST['inv_number'])){
    $inv_number=$_POST['inv_number'];
  }   
  if(!empty($_POST['lent_date'])){
    $lent_date=$_POST['lent_date'];
  }
  if(!empty($_POST['deposit'])){
    $deposit=$_POST['deposit'];
  }
  if(!empty($_POST['emp_name'])){
    $emp_name=$_POST['emp_name'];
  }
  $qty=$_POST['qty'];
  $total_qty=array_sum($qty);
  $query1 = "INSERT INTO lent (invoice_number,customer_id,lent_date,total_qty,deposit) VALUES ('$inv_number','$cus_name','$lent_date','$total_qty','$deposit')";
  $query_run1 = mysqli_query($con, $query1);
  $lent_id= mysqli_insert_id($con);

  $name=$_POST['item_name'];
  $unit_price=$_POST['unit_price'];

  foreach($name as $index => $names){
    $s_name=$names;
    $s_unit_price=$unit_price[$index];
    $s_qty=$qty[$index];

    $query = "INSERT INTO lent_detail (item_id,unit_price,item_qty,emp_id,lent_id) VALUES ('$s_name','$s_unit_price','$s_qty','$emp_name','$lent_id')";
    $query_run = mysqli_query($con, $query);
  }

}
?>
<?php 
include_once 'layouts/header.php';
?>

      <div class="main-panel">
        <div class="content-wrapper">
            <div class="container-fluid">
              <!-- Form Modal Button -->
            <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b><h4 class="modal-title" id="myModalLabel">ငှားရမ်းခြင်းထည့်ရန်</h4></b></a>
              </div>
              <!-- Search Button -->
              <!-- <div class="input-group col-md-4">
              <input type="text" class="form-control" name="" id="" placeholder="အမည်">
                <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div> -->
              

            <!-- large modal for Lent Item Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">ငှားရမ်းခြင်း</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                <form action="" method="POST">
                <div class="modal-body">
                           
                            <div class="row">

                                <div class="col-md-4 mt-3">
                                <label for="">ငှါးရမ်းသူအမည်</label>
                                <select name="cus_name" id="" class="form-control">
                                <?php 
                                    $selectquery1="select * from  customer "; 
                                    $select_result1 = mysqli_query($con,$selectquery1); 
                                                     
                                                    
                                               
                                    while($output=mysqli_fetch_array($select_result1,MYSQLI_ASSOC)):; 
                                    ?> 
                                    <option value="<?php echo $output['id']; ?>"> 
                                    <?php  echo $output['cus_name'] ?> 
                                    </option> 
                                    <?php endwhile;?>  
                                </select>
                                </div>

                                <div class="col-md-4 mt-3">
                                <label for="">ဘောင်ချာနံပါတ်</label>
                                <input type="text" class="form-control" name="inv_number" id="" placeholder="ဘောင်ချာနံပါတ်" required>
                                </div>

                                <div class="col-md-4 mt-3">
                                <label for="">ရက်စွဲ</label>
                                <input type="date" class="form-control" name="lent_date" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                <label for="">စပေါ်ငွေ</label>
                                <input type="number" class="form-control" name="deposit" id="" placeholder="စပေါ်ငွေ" required>
                                </div>
                                
                                <div class="col-md-6 mt-3">
                                <label for="">ဝန်ထမ်း</label>
                                <select name="emp_name" id="" class="form-control">
                                <?php 
                                    $selectquery="select * from  employee "; 
                                    $select_result = mysqli_query($con,$selectquery); 
                                                     
                                                    
                                               
                                    while($ans=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):; 
                                    ?> 
                                    <option value="<?php echo $ans['id']; ?>"> 
                                    <?php  echo $ans['emp_name'] ?> 
                                    </option> 
                                    <?php endwhile;?>  
                                </select>
                                </div>
                                <div class="container-fluid mt-3" id="content2">
                                <div class="row">
                                <div class="col-md-4 mt-3">
                                <label for="">ပစ္စည်းအမည်</label>
                                <select name="item_name[]" id="" class="form-control item1" value="">
                                <?php 
                                    $selectquery="select * from  item "; 
                                    $select_result = mysqli_query($con,$selectquery); 
                                                     
                                                    
                                               
                                    while($select_data=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):; 
                                    ?> 
                                    <option value="<?php echo $select_data['id']; ?>"> 
                                    <?php  echo $select_data['item_name'] ?> 
                                    </option> 
                                    <?php endwhile;?>  
                                </select>
                                <!-- <input type="text" class="form-control" name="item_name[]" id="" placeholder=""> -->
                                </div>

                                <div class="col-md-3 mt-3">
                                <label for="">အရေအတွက်</label>
                                <input type="number" class="form-control qty1" name="qty[]" id="" placeholder="အရေအတွက်" required>
                                <span id="error_message" style="color:red"></span>
                                </div>

                                <div class="col-md-4 mt-3">
                                <label for="">တစ်ရက်ငှါးရမ်းနှုန်း</label>
                                <input type="number" class="form-control" max="1000" name="unit_price[]" id="" placeholder="တစ်ရက်ငှါးရမ်းနှုန်း" required>
                                </div>
                                <div class="col-md-1 mt-3">
                                <button  class="btn btn-outline-primary add mt-4" name="more">+</button>
                                </div>
                              </div>
                                </div>
                              </div>
          
                            </div>
                      
                      
                      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="upload" class="btn btn-primary">Submit</button>
      </div>
                </form>
                </div>
  </div>
</div>    
            </div> 


        <!-- Lent Table -->
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
                              <th>ငှါးရမ်းသူအမည်</th>
                              <th>ဘောင်ချာနံပါတ်</th>
                              <th>စုစုပေါင်းအရေအတွက်</th>
                              <th>စပေါ်ငွေ</th>
                              <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                          </thead>
                          <tbody id="lent_table">
                          <?php 
                          //asdasd
                          $query = "select customer.cus_name, lent.* from customer join lent on customer.id = lent.customer_id";
                          $result = mysqli_query($con,$query);
                          $count = 1;
                          if(!empty($result)){
                            foreach($result as $row){ 
                              if($row['checker']==0){
                                                                                      
                              $cus_name=$row['cus_name']; 
                            
                              $data_id = $row['id']; 
                              $data_inv = $row['invoice_number']; 
                               
                              $data_date = $row['lent_date']; 
                              $data_qty = $row['total_qty']; 
                              $data_dep = $row['deposit'];  
                               
                          ?> 
                          <tr> 
                          <td><?php echo $count; ?></td> 
                          <td> <div  class='' id='name_<?php echo $data_id; ?>'> <?php echo $cus_name; ?></div> </td> 
                          <td> <div contentEditable='true' class='edit_lent' id='invoice_number_<?php echo $data_id; ?>'><?php echo $data_inv; ?> </div> </td> 
                          <td> <div contentEditable='true' class='edit_lent' id='total_qty_<?php echo $data_id; ?>'><?php echo $data_qty; ?> </div> </td> 
                          <td> <div contentEditable='true' class='edit_lent' id='deposit_<?php echo $data_id; ?>'><?php echo $data_dep ?> </div> </td> 
                          <td><a data-toggle="modal" data-target="#detail_model" class="btn btn-outline-primary detail_lent" id="<?php echo $data_id?>">Detail</a>
                              <a class="btn btn-danger delete_lent" id="<?php echo $data_id?>">Delete</a>
                         </td> 
                          </tr> 
                          <?php 
                          $count ++; 
                          }
                          else{
                            $cus_name=$row['cus_name']; 
                            
                            $data_id = $row['id']; 
                            $data_inv = $row['invoice_number']; 
                             
                            $data_date = $row['lent_date']; 
                            $data_qty = $row['total_qty']; 
                            $data_dep = $row['deposit']; 
                            ?>
                          <tr> 
                          <td><?php echo $count; ?></td> 
                          <td> <div  class='' id='name_<?php echo $data_id; ?>'> <?php echo $cus_name; ?></div> </td> 
                          <td> <div contentEditable='true' class='edit_lent' id='invoice_number_<?php echo $data_id; ?>'><?php echo $data_inv; ?> </div> </td> 
                          <td> <div contentEditable='true' class='edit_lent' id='total_qty_<?php echo $data_id; ?>'><?php echo $data_qty; ?> </div> </td> 
                          <td> <div contentEditable='true' class='edit_lent' id='deposit_<?php echo $data_id; ?>'><?php echo $data_dep ?> </div> </td> 
                          <td><a data-toggle="modal" data-target="#detail_model" class="btn btn-outline-primary detail_lent" id="<?php echo $data_id?>">Detail</a></td> 
                          </tr>                          
                            <?php
                          $count ++; 
                          }
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
            <div class="modal fade" id="detail_model" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                                            
<div class="receipt-content">
    <div class="container bootstrap snippets bootdey">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">
					<div class="intro">
          အမည်:&nbsp;<strong><p id="customer_name"></p></strong>
					</div>

					<div class="payment-info">
						<div class="row">
							<div class="col-md-6">
								<span>ဘောင်ချာနံပါတ်</span>
								<strong><p id="invoice_num"></p></strong>
							</div>
							<div class="col-md-6 text-right">
								<span>ငှားရမ်းသည့်ရက်စွဲ</span>
								<strong><p id="lented_date"></p></strong>
							</div>
						</div>
					</div>

					<div class="line-items">
						<div class="headers clearfix">
							<div class="row">
								<div class="col-md-4">အမည်</div>
								<div class="col-md-3">အရေအတွက်</div>
								<div class="col-md-5 text-right">တစ်ရက်ငှားရမ်းနှုန်း</div>
							</div>
						</div>
						<div class="items" id="lent_detail_table">
						</div>
            <div class="row mb-2">
              <div class="col-md-4">
              စပေါ်ငွေ
              </div>
              <div class="col-md-4">
                
              </div>
              <div class="col-md-4" id="depo">
                
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
              စုစုပေါင်းအရေအတွက်
              </div>
              <div class="col-md-4">
                
              </div>
              <div class="col-md-4" id="tot_qty">
                
              </div>
              <div class="col-md-4 mt-2">
              တာဝန်ခံအမည် <p id="emp"></p>
              </div>
            </div>
						<div class="print">
							<a href="#">
								<i class="fa fa-print"></i>
								Print this receipt
							</a>
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
            </div>
        </div>
        </div>
      </div>
    </div>
<?php 
include_once 'layouts/footer.php'
?>
<!--js file here!-->
<script>
  $(document).ready(function () { 
    var maximum=0;
    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
$('.item1').change(first)
function first(){
console.log('chggg')
var item_id=$('.item1').val();
console.log(item_id)
$.ajax({
  url: 'check_stock.php',
  type: 'post',
  data: {item_name:item_id},
  success:function(response){
    $('.qty1').attr('value',response)
    // $('.qty1').attr('max',response)
    maximum = response;
  }

})
}
$('.qty1').focusout(fout)
/// fout function
function fout(event){
  var item_val=$(this).val();
  var message = $(this).next();
  console.log(message)
  console.log(maximum)
  console.log(item_val)
  if(item_val>maximum){
    // var message = document.getElementById('error_message');
    // message.innerHTML="";
    message.html("Out of maximum")
    $(':input[type="submit"]').prop('disabled',true);
  }
  else{
    // var message = document.getElementById('error_message');
    message.html("")
    $(':input[type="submit"]').prop('disabled',false);
  }
  event.preventDefault();
}
//second function
function second(){
          console.log('chggg')
          var item_id=$(this).val();
          var item=$(this);
          var nextitem=item.parent().next().children();
          console.log(item)
          console.log(nextitem[1])
          console.log(item_id)
          $.ajax({
            url: 'check_stock.php',
            type: 'post',
            data: {item_name:item_id},
            success:function(response){
              console.log(response)
             // var ans=$(this).val().parent().parent()
              nextitem.val(response);
         //   var ans = $('.qty'+index+'').val();
         //   console.log(ans)
              maximum = response;
             // console.log(maximum);

            }

          })         
          }


    var counting =2;
    $('.add').click(function(e){
        console.log('ok');

        // var div=document.createElement('div');
        // $(div).attr('class','container-fluid mt-3');
        var row=document.createElement('div');
        $(row).attr('class','row');
        var col1 = document.createElement('div');
        $(col1).attr('class','col-md-4 mt-3');
        var col2 = document.createElement('div');
        $(col2).attr('class','col-md-3 mt-3');
        var col3 = document.createElement('div');
        $(col3).attr('class','col-md-4 mt-3');
        var col4 = document.createElement('div');
        $(col4).attr('class','col-md-1 mt-3');
        
        var btn = document.createElement('button');
        $(btn).addClass('btn btn-outline-danger mt-4');
        $(btn).html('-');
        $(col4).append(btn);

        var label1= document.createElement('label');
        var label2= document.createElement('label');
        var label3= document.createElement('label');

        $(label1).html('ပစ္စည်းအမျိုးအမည်');
        $(label2).html('အရေအတွက်');
        $(label3).html('တစ်ရက်ငှါးရမ်းနှုန်း');

        $(label1).addClass('form-label');
        $(label2).addClass('form-label');
        $(label3).addClass('form-label');

        var name = document.createElement('select');
        <?php 
          $selectquery="select * from  item "; 
          $select_result = mysqli_query($con,$selectquery);                                                                                                                                                    
          while($select_data=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):; 
          ?> 
          var option="<option value='<?php echo $select_data['id']?>'><?php echo $select_data['item_name']?></option>";
          name.innerHTML+=option;
          <?php endwhile;?>

        // $(name).attr('type','text');
        var message = document.createElement('span');
        message.setAttribute('class','error_message');
        message.setAttribute('style','color:red')
        var qty = document.createElement('input');
        $(qty).attr('type','number');
        var unit_price = document.createElement('input');
        $(unit_price).attr('type','number');

        // $(name).attr('placeholder','ပစ္စည်းအမျိုးအမည်');
        $(qty).attr('placeholder','အရေအတွက်');
        $(unit_price).attr('placeholder','တစ်ရက်ငှါးရမ်းနှုန်း');

        $(name).attr('class','form-control item'+counting+'');
        $(qty).attr('class','form-control qty'+counting+'');
        $(unit_price).attr('class','form-control');

        $(name).attr('name','item_name[]');
        $(qty).attr('name','qty[]');
        $(unit_price).attr('name','unit_price[]')

        col1.appendChild(label1);
        col1.appendChild(name);

        col2.appendChild(label2);
        col2.appendChild(qty);
        col2.appendChild(message);

        col3.appendChild(label3);
        col3.appendChild(unit_price);


        $(btn).click(function(){
            $(this).parent().parent().remove();
        });
        $(row).append(col1,col2,col3,col4);
        // $(div).append(row);
        counting++;
        $('#content2').append(row);
        for(var index = 2;index<=counting;index++){
          $('.item'+index+'').change(second)
       
          $('.qty'+index+'').blur(fout)
          console.log($(this).val())
 

        }

       


        e.preventDefault();
    })
    $('.delete_lent').click(function(event){
      var message = confirm("Are you sure to delete?")
      if(message==true){
        var id = $(this).attr('id')
        var row = $(this).parent().parent()
      $.ajax({
        url:'lent_delete.php',
        type:'post',
        data:{pid:id},
        success:function(response){
          $(row).fadeOut('slow');
          
        }
      })
      }
event.preventDefault();
    })
    $('.detail_lent').click(function(){
      console.log('click')
      var id = this.id
      $.ajax({
                url: 'lent_detail.php',
                type: 'post',
                data: {cid:id},
                success:function(response){
                    if(response == 1){ 

                    }else{ 
                      var split_resp = response.split("_");
                      var tabel =  split_resp[0];
                      var cus_name = split_resp[1];
                      var inv = split_resp[2];
                      var lent_date = split_resp[3];
                      var t_qty = split_resp[4];
                      var depo = split_resp[5];
                      var emp = split_resp[6];
                      var inv_number = document.getElementById('invoice_num')
                      var customer_name = document.getElementById('customer_name')
                      var l_date = document.getElementById('lented_date')
                      var qty = document.getElementById('tot_qty')
                      var dep = document.getElementById('depo')
                      var emp_name = document.getElementById('emp')
                      emp_name.innerHTML=emp
                      inv_number.innerHTML=inv;
                      customer_name.innerHTML=cus_name;
                      l_date.innerHTML=lent_date;
                      qty.innerHTML=t_qty;
                      dep.innerHTML=depo;
                      

                      
                      console.log(response);

                      
                      $('#lent_detail_table').html(tabel)
                        
                    }             
                }
            });
    })
         // Add Class
    $('.edit_lent').click(function(){
      console.log("click")
        $(this).addClass('editMode');
    
    });
    $(".edit_lent").focusout(function(){
        $(this).removeClass("editMode");
 
        var id = this.id;
        var id1= this.id;
        var split_id = id.split("_");
        var split_id1=id1.split("_");
        
        if(split_id.length==2)
        {
            var field_name = split_id[0];
            var edit_id = split_id[1];
            console.log(field_name);

            var value = $(this).text();
        
            $.ajax({
                url: 'lent_update.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    if(response == 1){ 
                        console.log('Save successfully'); 
                        
                    }else{ 
                        console.log(response); 
                        
                    }             
                }
            });
        }
        else{
            
            var remove_last=split_id.pop();
         //   console.log(remove_last); // 3
         //   console.log(split);  // item name
            var one =split_id[0];
            var two = split_id[1];
            var field_name = one.concat('_',two);
            var edit_id = split_id1[2];
            console.log(field_name);
            console.log(edit_id);
            
            var value = $(this).text();
        
            $.ajax({
                url: 'lent_update.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    if(response == 1){ 
                        console.log('Save successfully'); 
                        
                    }else{ 
                        console.log(response); 
                        
                    }             
                }
            });
        }        
    });

    

 })
</script>

