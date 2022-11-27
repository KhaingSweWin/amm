<?php
include_once "controller/CategoryController.php";
$id=$_POST['cid'];
$cController=new CategoryController();
$result=$cController->deleteCategory($id);
if($result){
    $output="";
    $categories = $cController->getCategories();
    foreach($categories as $category){
        $output.="<tr>";
        $output.="<td>".$category['name']."</td>";
        $output.="<td>".$category['parent_name']."</td>";
        $output.="<td cid=".$category['id']."><a class='btn btn-danger m-2 category_delete'>Delete</a></td>";
        $output.="</tr>";
    }
    echo $output;
    //header('location:index.php');
}
include_once 'layouts/header.php';

include_once 'layouts/footer.php';
?>