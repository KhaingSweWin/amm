<?php
include_once __DIR__."/controller/lentcontroller.php";
include_once __DIR__."/includes/config.php";
$id=$_POST['pid'];
$lentcontroller= new Lentcontroller();
$result=$lentcontroller->deleteLent($id);
if($result){
    $query = "select customer.cus_name, lent.* from customer join lent on customer.id = lent.customer_id";
    $results = mysqli_query($con,$query);
    $count = 1;
    $data="";
    foreach($results as $row){ 
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
        ?>
        <?php
}
?>