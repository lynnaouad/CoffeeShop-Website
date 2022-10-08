$(document).ready(function(){

    $("#check_out").click(function() {

        // send data to PHP server script (calculate_checkout.php) using Ajax request.
        $.ajax({
            url: './requests/calculate_checkout.php',
            method: 'post',
            data: {action: "checkout"},
            success: function() {   
                window.location="checkout.php";
            }
          });

    });



});