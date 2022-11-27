<?php 
include_once __DIR__."/controller/custcontroller.php";
include_once __DIR__."/includes/config.php";


$customercontroller = new CustomerController();
$ccontroller= new CustomerController();

if(isset($_POST['detail']))
{
  if(!empty($_POST['name']))
  {
      $name=$_POST['name'];
  }
  if(!empty($_POST['nrc']))
  {
      $nrc=$_POST['nrc'];
  }
  if(!empty($_POST['add']))
  {
      $add=$_POST['add'];
  }
if (!isset($_POST['ph']) || $_POST['ph'] == '' ) {
    $ph = null;
   
}else {
    $ph = $_POST['ph'];
}
//   if(($_POST['ph']) && $_POST['ph'] != 0)
//   {
//       $ph=$_POST['ph'];
//   }
//   else {
//     $ph_error = "Please enter correct phone number!!";
//   }
  if(!empty($_POST['work_add']))
  {
      $a_work_add=$_POST['work_add'];
      $work_add=$a_work_add[0];
  }

if(!empty($_POST['ph'])){
$result=$customercontroller->addCustomer($name,$nrc,$add,$ph);
}
else{
    $ph_error ="Please enter valid phone number!!";
}
$num = $ccontroller->getWorkId();
$id=$num['id'];

//$insert=$customercontroller->addWork($id,$work_add);
foreach($a_work_add as $key=>$values)
{
    $s_work_add=$a_work_add[$key];
   // print_r($s_work_add);
    $query = "insert into workaddress(cus_id,work_address) values('$id','$s_work_add')";
     $query_run = mysqli_query($con, $query);
    if($query_run){
        
        header("Location:customer.php");
    }    
} 

};




?>


<?php 
include_once "layouts/header.php";
?>
      <!-- partial -->
      <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                     <!-- Form Modal Button -->
            <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b> ငှားရမ်းသူဖြည့်ရန်</b></a>
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
             

            <!-- large modal for Customer Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel">ငှားရမ်းသူဖြည့်ခြင်း</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action="" method="post" >
                    <div class="modal-body">
                    <h4>ငှားရမ်းသူ</h4>
                   
                 
                    
                                        <div class="row" id="">
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">အမည်</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="အမည်" required>
                                                <span class="text-danger" id="cus_name"></span>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">မှတ်ပုံတင်နံပါတ်</label>
                                                <input type="text" name="nrc" id="nrc" class="form-control" placeholder="မှတ်ပုံတင်နံပါတ်" required>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">ဖုန်းနံပါတ်</label>
                                                <input type="text" name="ph" id="phone" class="form-control" placeholder="ဖုန်းနံပါတ်" required>
                                                <span class="text-danger" id="here"><?php //if(isset($ph_error)) {echo $ph_error;} ?>  </span>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">နေရပ်လိပ်စာ</label>
                                                <input type="text" name="add" id="address" class="form-control" placeholder="နေရပ်လိပ်စာ" required>
                                            </div>
                                            <div class="col-md-11 mt-3">
                                                <label for="" class="form-label">လုပ်ငန်းခွင်လိပ်စာ</label>
                                                <input type="text" name="work_add[]" id="workplace" class="form-control" placeholder="လုပ်ငန်းခွင်လိပ်စာ" required>
                                            </div>
                                            <div class="col-md-1 mt-5">
                                                <button  class="btn btn-outline-primary new" id="" >+</button>
                                            </div> 
                                            <div class="container-fluid content" ></div>
                                        </div>   
                    </div>     
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="detail" id="cus_form" class="btn btn-primary">Submit</button>
      </div>
                </form>
                </div>
                </div>
            </div>
</div>

<div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="datatable" class="display expandable-table no-footer" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>စဥ်</th>
                                                    <th>အမည်</th>
                                                    <th>မှတ်ပုံတင်နံပါတ်</th>
                                                    <th>နေရပ်လိပ်စာ</th>
                                                    <th>ဖုန်းနံပါတ်</th>
                                                    <th>လုပ်ငန်းခွင်လိပ်စာ</th>
                                                    <th>လုပ်ဆောင်ချက်</th>
                                                    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                          $query = "select * from customer ";
                          $result = mysqli_query($con,$query);
                          $count = 1;
                          while($row = mysqli_fetch_array($result) ){
                          $data_id = $row['id'];
                          $data_name = $row['cus_name'];
                          $data_nrc= $row['NRC'];
                          $data_add = $row['address'];
                          $data_ph = $row['phone_number'];
                          ?>
                        <tr>
                        <td><?php echo $count; ?></td>
                        <td> <div contentEditable='true' class='cust_edit' id='name_<?php echo $data_id; ?>'> <?php echo $data_name; ?></div> </td>
                        <td> <div contentEditable='true' class='cust_edit' id='nrc_<?php echo $data_id; ?>'> <?php echo $data_nrc; ?></div> </td>
                        <td> <div contentEditable='true' class='cust_edit' id='address_<?php echo $data_id; ?>'><?php echo $data_add; ?> </div> </td>
                        <td> <div contentEditable='true' class='cust_edit' id='phone_number_<?php echo $data_id; ?>'><?php echo $data_ph; ?> </div> </td>
                        <td  ><a class="btn btn-outline-primary detail"  id='<?php echo $data_id ?>' data-toggle="modal" data-target="#detail">Detail</a></td>
                        <td  cid='<?php echo $data_id; ?>'><a class='btn btn-danger deleteCustomer '> Delete</a></td>
                        </tr>
                        <?php
                        $count ++;
                        }
                        ?> 
                                                </tbody>
                                            </table>
                                            <p><?php 
                                        //     print_r($a_work_add);
                                        //    echo "<br>";
                                        //         print_r($num['id']);
                                        //         echo "<br>";
                                        //          print_r($s_work_add);
                                            ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
     </div> 
     <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
      <div class="col-md-12">
      <div class="table-responsive">
                        <table id="datatable" class="display expandable-table no-footer" style="width:100%">
                     
                      <form action="#" method="post">
                    <div class="row mb-3">
                    <div class="col-md-5">
                    <label for="" class="form-label"><h4>လုပ်ငန်းခွင်လိပ်စာ</h4></label>
                    <input type="text" name="new_work" id="newwork" placeholder="Work Address" class="form-control" required>                       
                    </div>
                    <div class="col-md-1 offset-md-3" >
                   
                    <button style="margin-top:35px" type="submit" name="work_detail" class="btn btn-primary btn-md " id="workdetail">Submit</button>
                    </div>
                    </div>
                   
                       
                        
                </form>
                  
                <thead>
                <tr>
                <th>စဥ်</th>
                <th>လုပ်ငန်းခွင်လိပ်စာ</th>
                <th>လုပ်ဆောင်ချက်</th>
                </tr>
                </thead>
                <tbody id="cusdetail">                 
               
                
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
                
     </div>
    </div>

     


     </div>  
        
     
    </div>

   
     

<?php 
include_once "layouts/footer.php";
?>
<!-- <script src="js/addcus_detail.js"></script> -->
<script>
 
$(document).ready(function(){

    $(":input").keyup(function(){
     if($(this).val().trim().length===0 || $('#name').val().trim().length===0 || $("#phone").val().trim().length===0 || $("#nrc").val().trim().length===0 || $("#address").val().trim().length===0 || $("#workplace").val().trim().length===0){
        console.log('space')
        $(':input[type="submit"]').prop('disabled', true);

}
else if($(this).val().trim().length!=null){
    $(':input[type="submit"]').prop('disabled',false);
}

    })

    $("#newwork").keyup(function(){
        if($(this).val().trim().length===0){
            $(':input[type="submit"]').prop('disabled', true);

        }
        else{
            $(':input[type="submit"]').prop('disabled', false);

        }
    })
    

    $('#phone').keyup(function(){
        console.log('okay')
        var int  = parseInt($(this).val())
        console.log(int)
        console.log(Number.isInteger(int));
        if(  $(this).val().length<8  )  //check only one || Number.isInteger(int) ==false
        {
            $('#here').html('Please enter valid phone number');
            $(':input[type="submit"]').prop('disabled', true);
        }

       else 
        {
            $('#here').html('');
          
         }
     
    })


        
    

    // Add Class
    $('.cust_edit').click(function(){
        $(this).addClass('editMode');
        console.log('okay');
    
    });

    // Save data
    $(".cust_edit").focusout(function(){
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
                url: 'customer_update.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    if(response == 1){ 
                        console.log('Save successfully'); 
                        
                    }else{ 
                        console.log("Not saved."); 
                        
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
                url: 'customer_update.php',
                type: 'post',
                data: { field:field_name, value:value, id:edit_id },
                success:function(response){
                    if(response == 1){ 
                        console.log('Save successfully'); 
                        
                    }else{ 
                        console.log("Not saved."); 
                        
                    }             
                }
            });
        }        
    });



$('.deleteCustomer').click(function(){
    var status = confirm("Are you sure you want to  delete?");
    if(status){
        var id=$(this).parents('td').attr('cid');
        var row = $(this).parents('tr');
        console.log(id);
        $.ajax({
            type:'post',
            url:'customer_delete.php',
            data:{cid:id},
            success:function(response){
              //  alert(response);
                row.fadeOut('slow');
                location.reload();
            }
        })
    }
    return false;
})




    var index= 2;
    $('.new').click(function (e) { 
        console.log('ok');

        // var div=document.createElement('div');
        // $(div).attr('class','container-fluid mt-3');
        var row=document.createElement('div');
        $(row).attr('class','row');
        var col1 = document.createElement('div');
        $(col1).attr('class','col-md-11 mt-3');
        var col2 = document.createElement('div');
        $(col2).attr('class','col-md-1 mt-3');
        var label= document.createElement('label');
        $(label).html('Work address'+index);
        $(label).attr('class','form-label');
       
        

        var address = document.createElement('input');
        $(address).attr('type','text');
        $(address).attr('class','form-control'); 
        $(address).attr('name','work_add[]');
        $(address).attr('placeholder','လုပ်ငန်းခွင်လိပ်စာ');
        var btn = document.createElement('button');
        $(btn).addClass('btn btn-outline-danger mt-4');
        $(btn).html('-');
        col2.appendChild(btn)
        col1.appendChild(label)
        col1.appendChild(address)
        $(btn).click(function(){
            $(this).parent().parent().remove();
            index--;
        });
        row.append(col1,col2)
        // $(div).append(row);
        $('.content').append(row);
        index++;
        e.preventDefault();

     })

     $('.detail').click(function(){
       
            var id=$(this).attr('id');

            console.log(id);
            $.ajax({
                    type: 'post',
                    url:   'cus_detail.php',
                    data: {did:id},                         // did = key, id= value;
                    success: function (response){
                       // console.log(response);
                    
                    $('#cusdetail').html(response);
                    },
                    error: function (error){
                        console.log(error);
                    }
                })
            //     var id=undefined;
            // delete(id);
        })

$('#workdetail').click(function(){
    var not_id=document.querySelector('[id="cusdetail"]');
    var id = not_id.firstChild.getAttribute('detail_id');
    var newwork = $('#newwork').val();
    console.log(newwork);
    console.log(id);
console.log(not_id);
$.ajax({
    type: 'post',
    url:  'cus.php',
    data:  {newid:id,newwork:newwork},
    success:function(response){
     // alert(response);
      
    }
})
})

  
;





    
});

</script>