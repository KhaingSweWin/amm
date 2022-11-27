<?php 
include_once __DIR__."/../models/lentmodel.php";

class Lentcontroller extends Lent
{
    # code...
    public function addLent($inv_number,$lent_date,$cus_name,$deposit,$total_qty){
        $result=$this->createLent($inv_number,$lent_date,$cus_name,$deposit,$total_qty);
        return $result;
    }
    public function deleteLent($id){
        $result=$this->delete($id);
        return $result;
    }
    public function getLent(){
        $results=$this->retrieveLent();
        return $results;
    }
}
?>