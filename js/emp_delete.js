$(document).ready(function () { 
    $('.delete_employee').click(function(){
        console.log('button click')
        
        var message= confirm("Are you sure to delete?")
        if(message==true)
        {
            console.log($(this))
            var id=$(this).parents('td').attr('pid');
            var row=$(this).parents('tr');
            $.ajax({
                type:"post",
                url:"employee_delete.php",
                data:{pid:id},
                success:function(response){
                    row.fadeOut('slow');
              
                //    alert(response)
                //    document.getElementById('emp_table').innerHTML=response;            
                    
                }
                })
        }
       
        return false;
    })
 })