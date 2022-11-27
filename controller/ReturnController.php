<?php
include_once __DIR__."/../models/ReturnModel.php";
class ReturnController extends Returnn{
    public function addReturn($lent_id,$return_date,$emp_id,$discount,$deposit)
    {
        $result = $this->createReturn($lent_id,$return_date,$emp_id,$discount,$deposit);
        return $result;
    }
    public function addReturnDetail($return_id,$lent_id,$LentDetail_id,$return_qty,$has_broken,$broken_qty,$price)
    {
        $result = $this->createReturnDetail($return_id,$lent_id,$LentDetail_id,$return_qty,$has_broken,$broken_qty,$price);
        return $result;
    }
    public function updateChecker($id,$val){
        $response = $this->changeChecker($id,$val);
        return $response;
    }
    public function calTotalCost($initial_date,$final_date,$lent_price,$qty,$price,$broken_qty,$discount){
        $totalCost=0;
        $duration =$this->calDuration($initial_date,$final_date);
        $totalCost+=($lent_price*$qty*$duration)+($price*$broken_qty)-$discount;
        return $totalCost;
    }
    public function calDuration($initial_date,$final_date){
        $interval=date_diff($final_date,$initial_date);
        $duration = ($interval->y*365)+($interval->m*30)+($interval->d);
        $duration = intval($duration);
        return $duration;
    }

    //update function for give_back in lent_detail
    public function updateGive_back($id){
        $response = $this->changeGive_back($id);
        return $response;
    }
}
?>