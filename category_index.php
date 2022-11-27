<?php
include_once "includes/config.php";
include_once "controller/CategoryController.php";
$cController = new CategoryController();

if(isset($_POST['submit'])){
  if(!empty($_POST['name']))
  {
      $name=$_POST['name'];
  }
  else{
    $error_name="This box can't be empty";
  }
  if(!empty($_POST['pname']))
  {
      $pname=$_POST['pname'];
  }
  else{
    $error_msg="Hey you forgot to select";
  }
  if(empty($error_msg) && empty($error_name)){
  $addCategories = $cController->addCategory($name,$pname);
  if($addCategories){
    header('location:category_index.php');
    //echo "hello";
  }else{
    echo "error";
  }
}
}
include_once "layouts/header.php";
?>
      <!-- partial -->
      <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                     <!-- Form Modal Button -->
            <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b> Add item</b></a>
              </div>
              <!-- Search Button -->
              <div class="input-group col-md-4">
              <input type="text" class="form-control" name="search_name" id="parent_name" placeholder="အမျိုးအစား">
                <div class="input-group-append">
                <button class="btn btn-primary" id="item_search" type="button">
                <i class="mdi mdi-magnify"></i>
                </button>
                </div>
              </div>
             

            <!-- large modal for Customer Registration Form-->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Customer Registration Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action="" method="POST">
                    <div class="modal-body">
                    <h4>Add Items</h4>
                    <p >အမျိုးအစား</p>
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">Items Name</label>
                                                <input type="text" name="name" id="" class="form-control" placeholder="ပစ္စည်းအမျိုးအမည်">
                                                <span class='text-danger'><?php if(isset($error_name)) echo $error_name; ?></span>
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">Item Type</label>
                                                <select class='form-control' name="pname" id="">
                                                    <option value="-1">_</option>
                                                    <?php
                                                    $check_query="Select count(id) from category";
                                                    $cquery_execute=mysqli_query($con,$check_query);
                                                    while($check_result=mysqli_fetch_array($cquery_execute)){
                                                        $checker=$check_result['count(id)'];
                                                    }
                                                    if($checker>0){
                                                        $query="Select * from category where category.parent_name=-1";
                                                        $query_execute=mysqli_query($con,$query);
                                                        while($query_result=mysqli_fetch_array($query_execute)){
                                                            echo "<option value='".$query_result['id']."'>".$query_result['name']."</option>";
                                                        }
                                                    }
                                                    
                                                    ?>
                                                </select>
                                                <span class='text-danger'><?php if(isset($error_msg)) echo $error_msg; ?></span>
                                            </div>
                                        </div>   
                    </div>     
                                      
                                        
    <div class="modal-footer mt-3">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
                </form>
                </div>
                </div>
            </div>
</div>


            <!-- Category Table -->
<div class="container-fluid mt-3">
        <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="data_table" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                    <th>စဥ်</th>
                                                    <th>ပစ္စည်းအမည်</th>
                                                    <th>ပစ္စည်းအမျိုးအစား</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="item_content">
                                                  <?php
                                                  // foreach($categories as $category){
                                                    // echo "<tr>";
                                                    // echo "<td name='id'>".$category['id']."</td>";
                                                    // echo "<td>".$category['name']."</td>";
                                                    // echo "<td>".$category['parent_name']."</td>";
                                                    // echo "<td cid=".$category['id']."><a href='item.php?id='".$category['id']."' name='edit' class='btn btn-primary' data-toggle='modal' data-target='#editModal'><b>Edit</b></a><a class='btn btn-danger m-2 delete'>Delete</a></td>";
                                                    // echo "</tr>";
                                                  //}
                                                  ?>
                                                  <?php 
                                                      $query = "select * from category";
                                                      $result = mysqli_query($con,$query);
                                                      $count = 1;
                                                      while($row = mysqli_fetch_array($result) ){
                                                          $dataid = $row['id'];
                                                          $edit_name = $row['name'];
                                                          $id=$row['parent_name'];
                                                          if($id > 0){
                                                            $parent_query="Select name from category where category.id=".$id;
                                                            $pQuery_execute=mysqli_query($con,$parent_query);
                                                            while($pResult=mysqli_fetch_array($pQuery_execute)){
                                                            $edit_pname = $pResult['name'];
                                                            }
                                                          }else{
                                                            $edit_pname="_";
                                                          }
                                                  ?>
                                                           <tr>
                                                               <td><?php echo $count; ?></td>
                                                               <td> <div contentEditable='true' class='category_edit' id='name_<?php echo $dataid; ?>'> <?php echo $edit_name; ?></div> </td>
                                                               <td> <div contentEditable='false' class='category_edit' id='parent_name_<?php echo $dataid; ?>'><?php echo $edit_pname; ?> </div> </td>
                                                               <td cid="<?php echo $dataid ?>"> <a href="" class="btn btn-danger m-2 category_delete" >Delete</a>
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
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
      </div>
            </div>
      </div>
      <!-- main-panel ends -->

      
<?php
include_once "layouts/footer.php";
?>
<script>
  $(".category_edit").focusout(function(e){
    var id = this.id;
    var id1= this.id;
    var split_id = id.split("_");
    var split_id1=id1.split("_");
    
    if(split_id.length==2)
    {
        var field_name = split_id[0];
        var edit_id = split_id[1];
        console.log(field_name);
    }else{
        var remove_last=split_id.pop();
        //   console.log(remove_last); // 3
        //   console.log(split);  // item name
           var one =split_id[0];
           var two = split_id[1];
           var field_name = one.concat('_',two);
           var edit_id = split_id1[2];
           console.log(field_name);
           console.log(edit_id);
    }
    var value = $(this).text();
    e.preventDefault();
    $.ajax({
        url: 'category_update.php',
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
});

$('.category_delete').click(function(e){
    var status = confirm("Are you sure to delete?");
    e.preventDefault();
    if(status){
        var id=$(this).parents('td').attr('cid');
        var row = $(this).parents('tr');
        console.log(id);
        $.ajax({
            type:'post',
            url:'category_delete.php',
            data:{cid:id},
            success:function(response){
                alert(response);
                row.fadeOut('slow');
                location.reload();
            }
        })
    }
    return false;
})
$('#item_search').click(function(e){
    console.log('inside item search');
    var pname = $('#parent_name').val();
    e.preventDefault();
    $.ajax({
        type:"post",
        url:'category_search.php',
        data:{search_name:pname},
        success:function(response){
            // alert(response);
            $('#item_content').html(response);
        }
    })
    return false;
})





</script>