<?php 
include_once __DIR__."/controller/empcontroller.php";
include_once "includes/config.php";
$employeecontroller = new EmployeeController();
if(isset($_POST['submit']))
{
  if(!empty($_POST['name']))
  {

      $name=$_POST['name'];
      if($name == 0){
        echo"error";
      }
  }

  if(!empty($_POST['add']))
  {
      $add=$_POST['add'];
  }
  if(!empty($_POST['ph']))
  {
      $ph=$_POST['ph'];
  };

$result=$employeecontroller->addEmployee($name,$add,$ph);
  if($result){
    header('location:employee.php');
  }
  else{
    echo "error";
  }

};

$employees=$employeecontroller->getEmployees();

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
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b>ဝန်ထမ်းမှတ်ပုံတင်ရန်</b></a>
              </div>
              <!-- Search Button -->
              <div class="input-group col-md-4">
              <input type="text" class="form-control" name="name" id="name" placeholder="အမည်">
                <div class="input-group-append">
                <button class="btn btn-primary search" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div>
              

            <!-- large modal for Employee Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">ဝန်ထမ်းမှတ်ပုံတင်ခြင်း</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="" method="POST">
   
      <div class="modal-body">
                       
                        <p >ဝန်ထမ်း</p>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                <label for="">အမည်</label>
                                <input type="text" class="form-control" name="name" id="" placeholder="အမည်" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                <label for="">လိပ်စာ</label>
                                <input type="" class="form-control" name="add" id="" placeholder="နေရပ်လိပ်စာ" required> 
                                </div>
                                <div class="col-md-12 mt-3">
                                <label for="">ဖုန်းနံပတ်</label>
                                <input type="text" class="form-control" name="ph" id="" placeholder="ဖုန်းနံပတ်" required>  
                                </div>
                            </div>
                        </div>
                    
                <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
                </form>
      
      
    </div>
  </div>
</div>     
            </div>

            <!-- Employee Table -->
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
                              <th>အမည်</th>
                              <th>ဖုန်းနံပါတ်</th>
                              <th>နေရပ်လိပ်စာ</th>
                              <th>လုပ်ဆောင်ချက်</th>
                            </tr>
                          </thead>
                          <tbody id="emp_table">
                          <?php 
                          $query = "select * from employee";
                          $result = mysqli_query($con,$query);
                          $count = 1;
                          while($row = mysqli_fetch_array($result) ){
                          $data_id = $row['id'];
                          $data_name = $row['emp_name'];
                          $data_add = $row['address'];
                          $data_ph = $row['phone_number'];
                          ?>
                        <tr>
                        <td><?php echo $count; ?></td>
                        <td> <div contentEditable='true' class='edit' id='name_<?php echo $data_id; ?>'> <?php echo $data_name; ?></div> </td>
                        <td> <div contentEditable='true' class='edit' id='phone_number_<?php echo $data_id; ?>'><?php echo $data_ph; ?> </div> </td>
                        <td> <div contentEditable='true' class='edit' id='address_<?php echo $data_id; ?>'><?php echo $data_add; ?> </div> </td>
                        <td pid='<?php echo $data_id; ?>'><a class="btn btn-danger delete_employee">Delete</a></td>
                        </tr>
                        <?php
                        $count ++;
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
<script>
    $(document).ready(function(){
    
    // Add Class
    $('.edit').click(function(){
        $(this).addClass('editMode');
    
    });

    // Save data
    $(".edit").focusout(function(){
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
                url: 'employee_update.php',
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
                url: 'employee_update.php',
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

});

</script>