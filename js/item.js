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

$('.item_edit').focusout(function(e){
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
        url: 'item_update.php',
        type: 'post',
        data : {field:field_name, value:value, id:edit_id},
        success:function(response){
            if(response == 1){
                console.log('updated successfully');
            }
            else
                console.log('Update failed');
        }
    })
})