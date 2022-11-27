<?php 
include_once __DIR__."/../models/lent_detail_model.php";
class Detail extends LentDetail{
    public function getDetail($id){
        $result=$this->retrieveDetail($id);
        return $result;
    }
}
?>