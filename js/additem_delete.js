$(document).ready(function () { 
    $('.delete_item').click(function(){
        console.log('button click')
        
        var message= confirm("Are you sure you want to delete this ?")
        if(message==true)
        {
            console.log($(this))
            var id=$(this).parents('td').attr('pid');
            var row=$(this).parents('tr');
            $.ajax({
                type:"post",
                url:"additem_delete.php",
                data:{pid:id},
                success:function(response){
                    row.fadeOut('slow');
                    location.reload();
                //   alert(response)
                  //  document.getElementById('stock').innerHTML=response;            
                    
                }
                })
        }
       
        return false;
    })
 })