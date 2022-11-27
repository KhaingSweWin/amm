<?php
include_once "controller/custcontroller.php";

$id=$_POST['did'];   //did = key

$ccontroller=new CustomerController();
$result=$ccontroller->seeDetail($id);






if($result){
    $output='';
    $count=0;
    foreach($result as $data){
        $count++;
        $output.="<tr detail_id=".$id.">";
        $output.="<td>".$count."</td>";        
        $output.="<td><div contentEditable='true' class='cust_edit' id='work_address_".$data['id']."' >".$data['work_address']."</div></td>";
        $output.="<td  detail=".$data['id']."><a class='btn btn-danger btn-sm ddetail  '> Delete</a></td>";
        $output.="</tr>";
    }
    echo $output;
}


//echo $data; //string or json_encode
?>
<script>
    $(document).ready(function(){
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
        console.log(id1)
        var split_id = id.split("_");
        var split_id1=id1.split("_");
        
        if(split_id.length==2)
        {
            var field_name = split_id[0];
            var edit_id = split_id[1];
            console.log(field_name);

            var value = $(this).text();
        
            $.ajax({
                url: 'cusdetail_update.php',
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
                url: 'cusdetail_update.php',
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


    $(".ddetail").click(function(){
        var id0 = $(this).parents('td').parents('tr').attr('id');
        console.log(id0);
        var status = confirm("Are you sure you want to delete this address?");
        if(status){
            var id =$(this).parents('td').attr('detail');
            console.log(id);
            var row = $(this).parents('tr');
            console.log(row);
            $.ajax({
                type:'post',
                url: 'cusdetail_delete.php',
                data:{did:id,id:id0},
                success:function(response){
                    alert("Successfully deleted");
                   row.fadeOut('slow');
                   location.reload();

                }
            })
        }
    })

    $(".workdetail").click(function(){
        var id = $(this).parents('td').parents('tr').attr('id');
        console.log(id);
    })

});



</script>


