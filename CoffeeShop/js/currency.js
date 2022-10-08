$(document).ready(function(){

    $("#currency_list").change(function() {
        // get selected currency logo
        var currency_logo = $("#currency_list").val(); 

            // send data to PHP server script (currency.php) using Ajax request.
            $.ajax({
                url: './requests/currency.php',
                method: 'POST',
                data: {currency_logo: currency_logo, action:"check currency"},
                success: function(){
                 
                      //reload page
                       location.reload(true);

                }
            });
    

    });
    
});