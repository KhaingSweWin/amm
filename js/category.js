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




