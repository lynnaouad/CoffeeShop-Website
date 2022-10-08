$(document).ready(function(){

    var customer_first_name,
        customer_last_name,
        email_address,
        mobile_number,
        customer_address,
        customer_city,
        customer_state,
        customer_zip,
        customer_country;


$("#place_order").click(function() {

    var result = validate_form();

   
    // if all info are valid then we place the order
    if(result == true){
        
        // send data to PHP server script (Place_Order.php) using Ajax request.     
        $.ajax({
            url: './requests/Place_Order.php',
            method: 'POST',
            data: { customer_first_name:customer_first_name,
                    customer_last_name:customer_last_name,
                    email_address:email_address,
                    mobile_number:mobile_number,
                    customer_address:customer_address,
                    customer_city:customer_city,
                    customer_state:customer_state,
                    customer_zip:customer_zip,
                    customer_country:customer_country,
                    action:"place_order" },
            success: function() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "You're order has been received!",
                    showConfirmButton: false,
                    timer: 2000
                  });

                window.location="index.php";
            }
        });

    }
});



function validate_form()
{
    var valid = true;

    customer_first_name = $('#customer_first_name').val();
    customer_last_name = $('#customer_last_name').val();

    email_address = $('#email_address').val();
    mobile_number = $('#mobile_number').val();

    customer_address = $('#customer_address').val();
    customer_city = $('#customer_city').val();
    customer_state = $('#customer_state').val();
    customer_zip = $('#customer_zip').val();
    customer_country = $('#customer_country').val();

    // var name_expression = /^[a-z ,.'-]+$/i;
    var email_expression = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;


    // if first name is not valid
    if(customer_first_name == '')
    {
        $('#customer_first_name').addClass('require');
        $('#error_customer_first_name').text('Insert a valid First Name');
        valid = false;
    }
    else
    {
        $('#customer_first_name').removeClass('require');
        $('#customer_first_name').addClass('valid');
        $('#error_customer_first_name').text('');
        valid = true;
    }

    
    // if last name is not valid
    if(customer_last_name == '')
    {
        $('#customer_last_name').addClass('require');
        $('#error_customer_last_name').text('Insert a valid Last Name');
        valid = false;
    }
    else
    {
        $('#customer_last_name').removeClass('require');
        $('#customer_last_name').addClass('valid');
        $('#error_customer_last_name').text('');
        valid = true;
    }

    
    //  if email not valid
    if(!email_expression.test(email_address))
    {
    $('#email_address').addClass('require');
    $('#error_email_address').text('Invalid Email Address');
    valid = false;
    }
    else
    {
    $('#email_address').removeClass('require');
    $('#email_address').addClass('valid');
    $('#error_email_address').text('');
    valid = true;
    }
    

    //  if phone number is empty
    if(mobile_number == '')
    {
    $('#mobile_number').addClass('require');
    $('#error_mobile_number').text('Enter Mobile Number');
    valid = false;
    }
    else
    {
    $('#mobile_number').removeClass('require');
    $('#mobile_number').addClass('valid');
    $('#error_mobile_number').text('');
    valid = true;
    }


    //  if address is empty
    if(customer_address == '')
    {
    $('#customer_address').addClass('require');
    $('#error_customer_address').text('Enter Address Details');
    valid = false;
    }
    else
    {
    $('#customer_address').removeClass('require');
    $('#customer_address').addClass('valid');
    $('#error_customer_address').text('');
    valid = true;
    }


    //  if city is empty
    if(customer_city == '')
    {
    $('#customer_city').addClass('require');
    $('#error_customer_city').text('Enter City');
    valid = false;
    }
    else
    {
    $('#customer_city').removeClass('require');
    $('#customer_city').addClass('valid');
    $('#error_customer_city').text('');
    valid = true;
    }

      //  if state is empty
    if(customer_state == '')
      {
      $('#customer_state').addClass('require');
      $('#error_customer_state').text('Enter State');
      valid = false;
      }
      else
      {
      $('#customer_state').removeClass('require');
      $('#customer_state').addClass('valid');
      $('#error_customer_state').text('');
      valid = true;
      }

    //  if zip code is empty
    if(customer_zip == '')
    {
    $('#customer_zip').addClass('require');
    $('#error_customer_zip').text('Enter Zip code');
    valid = false;
    }
    else
    {
    $('#customer_zip').removeClass('require');
    $('#customer_zip').addClass('valid');
    $('#error_customer_zip').text('');
    valid = true;
    }

    //  if country is empty
    if(customer_country == '')
    {
    $('#customer_country').addClass('require');
    $('#error_customer_country').text('Enter Country Detail');
    valid = false;
    }
    else
    {
    $('#customer_country').removeClass('require');
    $('#customer_country').addClass('valid');
    $('#error_customer_country').text('');
    valid = true;
    }

    
    //  if agree is not checked
    if(! $('#agree_checkbox').is(':checked'))
    {
        $('#error_agree_checkbox').text('Please agree on our terms and conditions');
        valid = false;
    }
    else
    {
        $('#error_agree_checkbox').text('');
        valid = true;
    }

 return valid;
}

});
