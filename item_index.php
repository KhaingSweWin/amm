<?php
include_once "includes/config.php";
include_once "controller/ItemController.php";
$itemController = new ItemController();

if(isset($_POST['submit'])){
  if(!empty($_POST['item_name']))
  {
      $item_name=$_POST['item_name'];
  }
  if(!empty($_POST['category_id']))
  {
      $category_id=$_POST['category_id'];
  }

  $addItem = $itemController->addItem($item_name,$category_id);
  if($addItem){
    header('location:item_index.php');
  }else{
    echo "error";
  }
}
$items = $itemController->getItems();
include_once "layouts/header.php";
?>
      <!-- partial -->
      <div class="main-panel">
            <div class="content-wrapper">
                <div class="container-fluid">
                     <!-- Form Modal Button -->
            <div class="row mb-4">
              <div class="col text-left">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#largeModal"><b> ပစ္စည်းအမည်ထည့်ခြင်း</b></a>
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
        <h4 class="modal-title" id="myModalLabel">ပစ္စည်းအမည်ထည့်ခြင်း</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                    <form action="" method="POST">
                    <div class="modal-body">
                    
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">ပစ္စည်းအမည်</label>
                                                <input type="text" name="item_name" id="" class="form-control" placeholder="ပစ္စည်းအမျိုးအမည်">
                                            </div>
                                            <div class="col-md-6 mt-3">
                                                <label for="" class="form-label">အမျိုးအစား</label>
                                                <select name="category_id" class="form-control" id="">
                                                    <?php
                                                        $selectquery="select * from  category ";
                                                        $select_result = mysqli_query($con,$selectquery);
                                                        while($outcome=mysqli_fetch_array($select_result,MYSQLI_ASSOC)):;
                                                    ?>
                                                    <option value="<?php echo $outcome['id']; ?>">
                                                        <?php echo $outcome['name']; ?>
                                                    </option>
                                                    <?php endwhile; ?>
                                                </select>
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
                                            <table id="example" class="display expandable-table" style="width:100%">
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
                                                      $query = "select category.name, item. * from category join item on category.id = item.category_id";
                                                      $result = mysqli_query($con,$query);
                                                      
                                                  
                                                      $parent_name = "";
                                                      echo $parent_name;
                                                      $count = 1;
                                                      while($row=mysqli_fetch_array($result)){
                                                        $item_name = $row['item_name'];
                                                        $parent_name = $row['name'];
                                                        $data_id = $row['id'];
                                                        
                                                      
                                                  ?>
                                                           <tr>
                                                               <td><?php echo $count; ?></td>
                                                               <td> <div contentEditable='true' class='item_edit' id='item_name_<?php echo $data_id; ?>'> <?php echo $item_name; ?></div> </td>
                                                               <td> <div contentEditable='false' class='item_edit' id='category_id_<?php echo $data_id; ?>'><?php echo $parent_name; ?> </div> </td>
                                                               <td itemid="<?php echo $data_id ?>"> <a href="" class="btn btn-danger m-2 item_delete" >Delete</a>
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
  $('.item_delete').click(function(event){
    var status = confirm("Are you sure you want to delete?");
    event.preventDefault();
    if(status){
        console.log("hello")
        var id = $(this).parents('td').attr('itemid');
        var row =$(this).parents('tr');
        $.ajax({
            type: 'post',
            url: "item_delete.php",
            data:{itemid:id},
            success:function(response){
                alert(response);
                row.fadeOut('slow');
            }
        })
    }
    return false;    
})

$(document).ready(function(){
    
    // Add Class
    $('.item_edit').click(function(){
        $(this).addClass('editMode');
    
    });

    // Save data
    $(".item_edit").focusout(function(){
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
                url: 'item_update.php',
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
                url: 'item_update.php',
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