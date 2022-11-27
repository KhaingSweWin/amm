<?php
include_once "includes/config.php";
include_once "controller/ReturnController.php";
$returnController = new ReturnController();
$id=$_GET['id'];
$query="Select customer.cus_name,lent.*,return_tb.* from customer inner join lent on lent.customer_id=customer.id inner
join return_tb on return_tb.lent_id=lent.id where return_tb.id=".$id;
$query_execute=mysqli_query($con,$query);
while($result=mysqli_fetch_array($query_execute)){
    $cus_name=$result['cus_name'];
    $invoice_no = $result['invoice_number'];
    $lent_date = ($result['lent_date']);
    $return_date = ($result['return_date']);
    $initial_date = new DateTime($lent_date);
    $final_date = new DateTime($return_date);
    $duration=$returnController->calDuration($initial_date,$final_date);
    $deposit=intval($result['deposit']);
    $discount=intval($result['discount']);
}

include_once 'layouts/header.php';
?>
    <div class="main-panel">
        <div class="content-wrapper" id="scrollbar">

        <div class="container-fluid">
     <!-- Form Modal Button -->
        <div class="row mb-4">
            <div class="col text-left">
                <a href="" class="btn btn-success"><b>Export Excel File</b></a>
            </div>
        </div>
        <div class="receipt-content">
            <div class="container bootstrap snippets bootdey">
		        <div class="row">
			        <div class="col-md-12">
				        <div class="invoice-wrapper">
					        <div class="intro">
                                အမည်:&nbsp;<strong><p id="customer_name"><?php echo $cus_name; ?></p></strong>
					        </div>

					        <div class="payment-info">
						    <div class="row">
							    <div class="col-md-4">
								    <span>ဘောင်ချာနံပါတ်</span>
								    <strong><p id="invoice_num"><?php echo $invoice_no; ?></p></strong>
							    </div>
							    <div class="col-md-4">
								    <span>ငှားရမ်းသည့်ရက်စွဲ</span>
								    <strong><p id="lented_date"><?php echo $lent_date; ?></p></strong>
							    </div>
                                <div class="col-md-4 text-right">
                                    <span>ပြန်အပ်သည့်ရက်စွဲ</span>
                                    <strong><p><?php echo $return_date; ?></p></strong>
                                </div>
						    </div>
					    </div>

					    <div class="line-items">
						    <div class="headers clearfix">
							    <div class="row">
								    <div class="col-md-3">ပစ္စည်းအမည်</div>
								    <div class="col-md-2 text-right">အရေ <br> အတွက်</div>
                                    <div class="col-md-2 text-right">ကြာချိန်</div>
                                    <div class="col-md-2 text-right">တစ်ရက်ငှားရမ်းနှုန်း/ <br> ပစ္စည်းတန်ဖိုး</div>
								    <div class="col-md-3 text-right">ကုန်ကျငွေ</div>
							    </div>
						    </div>
						    <div class="items" id="return_detail_table">
                                <?php
                                    $total_cost=0;
                                    $query2="Select item.item_name as i,lent_detail.*,return_detail.* from 
                                    item inner join lent_detail on lent_detail.item_id=item.id inner join return_detail
                                    on lent_detail.id=return_detail.LentDetail_id where return_detail.return_id=".$id;
                                    $query2_execute=mysqli_query($con,$query2);
                                    while($result2 = mysqli_fetch_array($query2_execute)){
                                        echo "<div class='row mb-3'>";
                                        echo '<div class="col-md-3">'.$result2['i'].'</div>';
                                        echo '<div class="col-md-2 text-right">'.$result2['return_qty'].'</div>';
                                        echo '<div class="col-md-2 text-right">'.$duration.'</div>';
                                        echo '<div class="col-md-2 text-right">'.$result2['unit_price'].'</div>';
                                        $return_qty=intval($result2['return_qty']);
                                        $unit_price=intval($result2['unit_price']);
                                        $cost=$return_qty*$unit_price*$duration;
                                        echo '<div class="col-md-3 text-right">'.$cost.'</div>';
                                        echo '</div>';
                                        $cost2=0;
                                        if($result2['has_broken']==1){
                                            $broken_qty=intval($result2['broken_qty']);
                                            $price=intval($result2['price']);
                                            $cost2=$broken_qty*$price;
                                            echo "<div class='row mb-3'>";
                                            echo "<div class='col-md-3'>ကျိုးပဲ့/ပျောက်ဆုံး</div>";
                                            echo "<div class='col-md-2 text-right'>".$broken_qty."</div>";
                                            echo "<div class='col-md-2 text-right'>-</div>";
                                            echo "<div class='col-md-2 text-right'>".$price."</div>";
                                            echo "<div class='col-md-3 text-right'>".$cost2."</div>";
                                            echo "</div> <hr>";
                                        }
                                        $total_cost+=($cost+$cost2);
                                    }

                                ?>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-9 text-right">
                                စုစုပေါင်းကျသင့်ငွေ
                            </div>
                            <div class="col-md-3 text-right">
                                  <?php echo $total_cost; ?>  
                            </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9 text-right">
                                    စပေါ်ငွေ
                                </div>
                                <div class="col-md-3 text-right">
                                    <?php echo $deposit; ?>  
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9 text-right">
                                    Discount
                                </div>
                                <div class="col-md-3 text-right">
                                    <?php echo $discount; ?>  
                                </div>
                            </div>
                            <br>
                            <div class="row mb-5">
                                <div class="col-md-9 text-right">
                                   ကျသင့်ငွေ/ပြန်အမ်းငွေ
                                </div>
                                <?php
                                    $final_cost=$total_cost-($deposit+$discount);
                                    if($final_cost>0)
                                        echo "<div class='col-md-3 text-success text-right'>+".$final_cost."</div>";
                                    else
                                        echo "<div class='col-md-3 text-danger text-right'><h4>".$final_cost."</h4></div>";
                                ?>
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
    