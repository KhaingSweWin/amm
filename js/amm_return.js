var count = 1;
$('#broken_qty').parent().hide();
$('#actual_price').parent().hide();

//setting default values in date and discount
document.getElementById('return_date').valueAsDate = new Date();
$('#discount').val(0);

//display block or none according to ကျိုးပဲ့ရှိ/မရှိ
$('#hasBroken').change(function(){
    console.log($('#hasBroken').val());
    if($('#hasBroken').val() == '0'){
        $('#broken_qty').parent().hide();
        $('#actual_price').parent().hide();
    }
    else{
        $('#broken_qty').parent().show();
        $('#actual_price').parent().show();
    }
})


var cus_id = null;

//setting value in customer and deposit according to invoice number
$('#invoice_no').change(function(e){

    //removing value in qty and unit price if invoice number is not selected
    if($('#invoice_no :selected').text() == "ဘောင်ချာနံပါတ်ကို ရွေးပါ"){
        console.log("inside invoice no is null");
        $('#return_qty').val('');
        $('#unit_price').val('');
        $('#return_form').html('');
    }

    var id = $('#invoice_no').val();
    $.ajax({
        type:"post",
        url:'return_script.php',
        data:{id:id},
        success:function(response){
            var separate_response=response.split('_');
            var cus_name=separate_response[0];
            var deposit=separate_response[1];
            $('#customer').val(cus_name);
            $('#deposit').val(deposit);
            $('#deposit').attr('max',deposit);
        }
    })
    $.ajax({
        type:"Post",
        url: "return_script.php",
        data: {lentdetail:id},
        success:function(result){
            $('#return_item').html(result);
            $('#broken_item').html(result);
        }
    })
    e.preventDefault();
})
$('#addbtn').click(function(e){
    console.log('ok');
    console.log('inside + button '+$('#invoice_no').val());


    //creating row
    var row=document.createElement('div');
    $(row).attr('class','row mt-3');

    //creating columns
    var col1 = document.createElement('div');
    $(col1).attr('class','col-md-4 mt-3');
    var col2 = document.createElement('div');
    $(col2).attr('class','col-md-2 mt-3');
    var col3 = document.createElement('div');
    $(col3).attr('class','col-md-4 mt-3');
    var col4 = document.createElement('div');
    $(col4).attr('class','col-md-2 mt-3');
    var col5 = document.createElement('div');
    $(col5).attr('class','col-md-4 mt-3');
    var col6 = document.createElement('div');
    $(col6).attr('class','col-md-2 mt-3');
    var col7 = document.createElement('div');
    $(col7).attr('class','col-md-4 mt-3');
    
    //creating delete btn
    var btn = document.createElement('button');
    $(btn).addClass('btn btn-outline-danger mt-4');
    $(btn).html('-');
    $(col4).append(btn);

    //creating label for all columns
    var label1= document.createElement('label');
    var label2= document.createElement('label');
    var label3= document.createElement('label');
    var label4= document.createElement('label');
    var label5= document.createElement('label');
    var label6= document.createElement('label');
    
    //html for all labels
    $(label1).html('Return Item');
    $(label2).html('Quantity');
    $(label3).html('Unit Price');
    $(label4).html('Broken/Lost');
    $(label5).html('Broken Quantity');
    $(label6).html('Actual Price');

    //adding class in all labels
    $(label1).addClass('form-label');
    $(label2).addClass('form-label');
    $(label3).addClass('form-label');
    $(label4).addClass('form-label');
    $(label5).addClass('form-label');
    $(label6).addClass('form-label');

    var selectbox = document.createElement('select');
    $(selectbox).attr('name','lentDetail_id[]');
    // var option1 = document.createElement('option');
    // $(option1).html('ငြမ်း');
    // var option2 = document.createElement('option');
    // $(option2).html('အခင်းပြား');
    // $(selectbox).append(option1,option2)


    var qty = document.createElement('input');
    $(qty).attr('type','number');
    $(qty).attr('name','return_qty[]');

    var return_date = document.createElement('input');
    $(return_date).attr('type','number');

    var selectbox2 = document.createElement('select');
    var option1 = document.createElement('option');
    var option2 = document.createElement('option');
    $(option1).html("ရှိ")
    $(option2).html('မရှိ');
    $(option1).attr('value','1');
    $(option2).attr('value','0');
    $(selectbox2).append(option1,option2);
    $(selectbox2).attr('name','has_broken[]');

    var broken_qty = document.createElement('input');
    $(broken_qty).attr('type','number');
    $(broken_qty).attr('name','broken_qty[]');

    var actual_price = document.createElement('input');
    $(actual_price).attr('type','number');
    $(actual_price).attr('name','actual_price[]');

    //adding placeholder except for 2 select box
    $(qty).attr('placeholder','အရေအတွက်');
    $(return_date).attr('placeholder','တစ်ရက်ငှါးနှုန်း');
    $(broken_qty).attr('placeholder','ကျိုးပဲ့အရေအတွက်');
    $(actual_price).attr('placeholder','ကာလပေါက်စျေး');

    $(selectbox).attr('class','form-control');
    $(selectbox).attr('lentdetail',$('#invoice_no').val());
    $(qty).attr('class','form-control');
    $(qty).attr("min",'0');
    $(return_date).attr('class','form-control');
    $(return_date).attr('min','0');
    $(selectbox2).attr('class','form-control');
    $(broken_qty).attr('class','form-control');
    $(broken_qty).attr("min",'0');
    $(actual_price).attr('class','form-control');
    $(actual_price).attr('min','0');


    $.ajax({
        type:"Post",
        url: "return_script.php",
        data: {lentdetail:$('#invoice_no').val()},
        success:function(result){
            $(selectbox).html(result);
        }
    })

    col1.appendChild(label1);
    col1.appendChild(selectbox);

    col2.appendChild(label2);
    col2.appendChild(qty);

    col3.appendChild(label3);
    col3.appendChild(return_date);

    col5.appendChild(label4);
    col5.appendChild(selectbox2);

    col6.appendChild(label5);
    col6.appendChild(broken_qty);

    col7.appendChild(label6);
    col7.appendChild(actual_price);

    

    //delete row
    $(btn).click(function(){
        $(this).parent().parent().remove();
        count--;
    });

    $(row).append(col1,col2,col3,col4,col5,col6,col7);
    $('#return_form').append(row);

    $(selectbox).change(function(e){
        console.log($(this).parent());
        var parent=$(this).parent();
        var qty_parent=$(parent).next();
        var qty_input=$(qty_parent).find('input');
        var price_parent = $(qty_parent).next();
        var price_input = $(price_parent).find('input');
        $.ajax({
            type:'Post',
            url: "return_script.php",
            data:{ld_id:$(this).val(),l_id:$('#invoice_no').val()},
            success:function(result){
                var splitt = result.split("_");
                var r_qty = splitt[0];
                var r_price=splitt[1];
                $(qty_input).val(r_qty);
                $(qty_input).attr('max',r_qty);
                $(price_input).val(r_price);
            }
        })
    })
    
    //switch for broken qty and actual price
    $(selectbox2).change(function(){
        console.log($(selectbox2).val());
        if($(selectbox2).val() == '0'){
            $(col6).hide();
            $(col7).hide();
        }
        else{
            $(col6).show();
            $(col7).show();
        }
    })

    count++;
    hasrow = true;
    console.log(count);
    e.preventDefault();
})

//setting values in return-qty and unit price
$('#return_item').change(function(e){
    $.ajax({
        type:'Post',
        url: "return_script.php",
        data:{ld_id:$('#return_item').val() , l_id:$('#invoice_no').val()},
        success:function(result){
            var splitt = result.split("_");
            var qty = splitt[0];
            var price=splitt[1];
            $("#return_qty").val(qty);
            $("#return_qty").attr('max',qty);
            $("#unit_price").val(price);
        }
    })
})

