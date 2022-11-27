<?php 
include_once __DIR__."/controller/lent_detail_controller.php";
include_once __DIR__."/includes/config.php";
$id=$_POST['cid'];
$lent_detail_controller = new Detail();
$outcomes=$lent_detail_controller->getDetail($id);
$data="";
if($outcomes){
    $query = "select customer.cus_name, lent.* from customer join lent on customer.id = lent.customer_id WHERE lent.id='$id'";
    $row = mysqli_query($con,$query);
    foreach($row as $result){
        $cus_name=$result['cus_name']; 
                           
        $data_inv = $result['invoice_number']; 
         
        $data_date = $result['lent_date']; 
        $data_qty = $result['total_qty']; 
        $data_dep = $result['deposit']; 
    }
    foreach($outcomes as $outcome){
        $data.="<div class='row item'>";
        $data.="<div class='col-md-4 desc'>".$outcome['item_name']."</div>"; //change this place after query item_qty as item_name
        $data.="<div class='col-md-3 qty'>".$outcome['item_qty']."</div>";
        $data.="<div class='col-md-5 amount text-right'>".$outcome['unit_price']."</div>";
        $data.="</div>";

    }
    echo $data."_".$cus_name."_".$data_inv."_".$data_date."_".$data_qty."_".$data_dep."_".$outcome['emp_name'];
}


?>
<script>
    $('.detail_edit').click(function(){
      console.log("click")
        $(this).addClass('editMode');
    
    });
     $(".detail_edit").focusout(function(){
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
                url: 'lent_detail_update.php',
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
                url: 'lent_detail_update.php',
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

</script>

   